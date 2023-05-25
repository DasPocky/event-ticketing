<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatusEnum;
use App\Http\Requests\Purchase\StorePurchaseRequest;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Purchase;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Stripe\StripeClient;

class PurchaseController extends Controller
{
    // Erstellt eine neue Kaufansicht basierend auf dem ausgewählten Event.
    public function create(Event $event)
    {
        $tickets = $event->tickets;
        $groupedTickets = $this->groupTicketsByGroup($tickets);

        return view('purchases.create', compact('event', 'groupedTickets'));
    }

    // Verarbeitet die Kaufanforderung und leitet den Benutzer zur Zahlungsseite weiter.
    public function store(StorePurchaseRequest $request, Event $event)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = Auth::user();
        $customer = $user->customer;

        $organizer = $event->user->organizer;

        if (!$customer || !$customer->address || !$customer->zip || !$customer->city || !$customer->country || !$customer->phone) {
            return redirect()->route('dashboard.profile.edit')->with('error', 'Bitte vervollständigen Sie Ihre Profilinformationen vor dem Kauf.');
        }

        $tickets = $request->input('tickets');
        $groupedTickets = $this->groupTicketsByGroup($event->tickets);

        $purchases = [];
        $line_items = []; // Array to hold the line_items that will be passed to the Stripe session

        foreach ($tickets as $ticket_id => $quantity) {
            if ($quantity == 0) {
                continue;
            }

            $ticket = Ticket::find($ticket_id);
            $ticketGroup = $ticket->ticketGroup;

            if ($ticketGroup->quantity_total - $ticketGroup->quantity_sold < $quantity) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors('Nicht genug Tickets in dieser Gruppe verfügbar!');
            }

            $purchase = new Purchase([
                'user_id' => Auth::id(),
                'ticket_id' => $ticket->id,
                'event_id' => $event->id,
                'quantity' => $quantity,
                'payment_status' => PaymentStatusEnum::Pending
            ]);

            try {
                $purchase->save();
                $ticket->quantity_sold += $quantity;
                $ticket->save();
                $ticketGroup->quantity_sold += $quantity;
                $ticketGroup->save();

                $purchases[] = $purchase;

                // Create a line_item for each ticket
                $line_items[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => $ticket->price * 100,
                        'product_data' => [
                            'name' => $ticket->name,
                            'description' => $ticketGroup->name,
                        ],
                    ],
                    'quantity' => $quantity,
                ];

            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors('Es gab ein Problem beim Kauf des Tickets. Bitte versuchen Sie es später erneut.');
            }
        }

        if (!$customer->stripe_id) {
            $stripe_customer = \Stripe\Customer::create([
                'email' => $user->email,
                'name' => $user->name,
                'address' => [
                    'line1' => $customer->address,
                    'postal_code' => $customer->zip,
                    'city' => $customer->city,
                    'country' => $customer->country,
                ],
                'phone' => $customer->phone,
            ]);

            $customer->stripe_id = $stripe_customer->id;
            $customer->save();
        } else {
            $stripe_customer = \Stripe\Customer::retrieve($customer->stripe_id);
        }

        $checkoutSession = \Stripe\Checkout\Session::create([
            'customer' => $stripe_customer->id,
            'payment_method_types' => ['card', 'sepa_debit', 'customer_balance', 'giropay', 'klarna', 'link', 'paypal', 'sofort'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('purchases.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('purchases.cancel'),
            'payment_intent_data' => [
                'application_fee_amount' => 15, // Gebühr in Cent
                'transfer_data' => [
                    'destination' => $organizer->stripe_account_id,

                ],
            ],
        ]);

        foreach ($purchases as $purchase) {
            $purchase->session_id = $checkoutSession->id;
            $purchase->save();
        }

        return redirect()->away($checkoutSession->url);
    }

    // Zeigt den angeforderten Kauf an.
    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }

    // Gruppiert Tickets nach Gruppen-ID.
    private function groupTicketsByGroup(Collection $tickets)
    {
        return $tickets->groupBy('ticket_group_id');
    }

    // Handhabt den Erfolg der Zahlung.
    public function success(Request $request)
    {
        $session_id = $request->query('session_id');

        // Überprüfen Sie das Vorhandensein der session_id
        if (! $session_id) {
            return redirect()->route('home')->with('warning', 'Die Zahlung wurde nicht erfolgreich abgeschlossen.');
        }

        // Überprüfen Sie, ob die Bestätigungsseite bereits angesehen wurde
        if (session()->has('confirmation_viewed.' . $session_id)) {
            return redirect()->route('home')->with('warning', 'Die Bestätigungsseite wurde bereits angesehen.');
        }

        // Markieren Sie die Bestätigungsseite als angesehen
        session()->put('confirmation_viewed.' . $session_id, true);

        // Holt die getätigten Einkäufe aus der Datenbank anstatt aus der Session
        $purchases = Purchase::where('session_id', $session_id)->get();

        // Berechnet die Gesamtsumme der getätigten Einkäufe
        $totalPrice = $purchases->reduce(function($carry, $purchase) {
            return $carry + ($purchase->quantity * $purchase->ticket->price);
        }, 0);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Lade den Stripe Customer.
        $customer = Customer::where('user_id', Auth::id())->first();
        $stripe_customer = \Stripe\Customer::retrieve($customer->stripe_id);

        // Erstellen Sie eine Rechnung
        $invoice = \Stripe\Invoice::create([
            'customer' => $stripe_customer->id,
            'collection_method' => 'send_invoice',
            'days_until_due' => 14, // Set the number of days until the invoice is due
        ]);

        // Gibt die Bestätigungsseite mit den benötigten Informationen zurück
        return view('purchases.show', compact('purchases', 'totalPrice', 'session_id'));
    }


    // Handhabt den Abbruch der Zahlung.
    public function cancel()
    {
        // Der Benutzer kommt hierher, wenn er den Zahlungsprozess bei Stripe Checkout abbricht.
        // Sie könnten die entsprechenden Käufe löschen oder einen Status "Cancelled" setzen.
        $purchases = session()->pull('purchases');
        foreach ($purchases as $purchase) {
            $purchase->delete(); // oder $purchase->update(['payment_status' => PaymentStatusEnum::Cancelled]);
        }
        return redirect()->route('home')->with('warning', 'Die Zahlung wurde abgebrochen.');
    }

}

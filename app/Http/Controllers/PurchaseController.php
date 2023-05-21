<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\StorePurchaseRequest;
use App\Models\Event;
use App\Models\Purchase;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function create(Event $event)
    {
        $tickets = $event->tickets;

        return view('purchases.create', compact('event', 'tickets'));
    }

    public function store(StorePurchaseRequest $request, Event $event)
    {
        $user = Auth::user();
        $customer = $user->customer;
        if (!$customer || !$customer->address || !$customer->zip || !$customer->city || !$customer->country || !$customer->phone) {
            return redirect()->route('dashboard.profile.edit')->with('error', 'Bitte vervollständigen Sie Ihre Profilinformationen vor dem Kauf.');
        }

        $tickets = $request->tickets;

        $lastPurchase = null;

        foreach ($tickets as $ticket_id => $quantity) {
            if ($quantity == 0) {
                continue;
            }

            $ticket = Ticket::find($ticket_id);

            if ($ticket->quantity == $ticket->quantity_sold) {
                return redirect()->back()->with('error', 'Dieses Ticket ist ausverkauft!');
            }

            $purchase = new Purchase([
                'user_id' => Auth::id(),
                'ticket_id' => $ticket->id,
                'event_id' => $event->id,
                'quantity' => $quantity,
            ]);

            $lastPurchase = $purchase;

            try {
                $purchase->save();
                $ticket->quantity_sold += $quantity;
                $ticket->save();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Es gab ein Problem beim Kauf des Tickets. Bitte versuchen Sie es später erneut.');
            }
        }

        return redirect()->route('purchases.show', [$lastPurchase])->with('success', 'Ticket(s) erfolgreich gekauft.');
    }

    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }

}

<?php

namespace App\Http\Controllers\Organizer\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private \Stripe\StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public function refresh(): RedirectResponse
    {
        return redirect()->route('organizer.profile.edit')->with('warning', 'Es ist ein Fehler aufgetreten. Versuchen Sie es erneut.');
    }

    public function return(): RedirectResponse
    {
        return redirect()->route('organizer.profile.edit')->with('success', 'Sie haben Ihr Konto erfolgreich mit Stripe verbunden.');
    }
    public function create(): RedirectResponse
    {
        $userId = Auth::id();

        // Holen Sie sich die Daten des Organizers aus der Datenbank
        $organizer = \App\Models\Organizer::where('user_id', $userId)->first();

        // Prüfen, ob ein Organizer gefunden wurde
        if (!$organizer) {
            // Organizer wurde nicht gefunden, Fehlermeldung anzeigen.
            return redirect()->route('organizer.profile.edit')->with('warning', 'Es ist ein Fehler aufgetreten. Versuchen Sie es erneut.');
        }

        // Erstellen des Express-Kontos
        $account = $this->stripe->accounts->create([
            'type' => 'express',
            'country' => 'DE',
            'business_type' => 'individual',
            'email' => $organizer->email,
            'company' => [
                'address' => [
                    'city' => $organizer->city,
                    'country' => 'DE',
                    'line1' => $organizer->address,
                    'postal_code' => $organizer->zip
                ],
                'name' => $organizer->name,
                'phone' => $organizer->phone
            ],
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'sepa_debit_payments' => ['requested' => true],
                'sofort_payments' => ['requested' => true],
                'link_payments' => ['requested' => true],
                'giropay_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
                'klarna_payments' => ['requested' => true],
                'bank_transfer_payments' => ['requested' => true],
                'bancontact_payments' => ['requested' => true],
            ],
        ]);

        // Speichern der Account-ID
        $accountId = $account->id;

        // Aktualisieren Sie die Datenbank mit der Stripe Account ID
        $organizer->stripe_account_id = $accountId;
        $organizer->save();

        // Erstellen des Konto-Links
        $accountLink = $this->stripe->accountLinks->create([
            'account' => $accountId,
            'refresh_url' => route('organizer.stripe.refresh'),
            'return_url' => route('organizer.stripe.return'),
            'type' => 'account_onboarding',
        ]);

        return redirect()->away($accountLink->url);

    }

    public function delete(): RedirectResponse
    {
        // Holen Sie sich den authentifizierten Benutzer und dessen Organizer-Daten
        $organizer = Auth::user()->organizer;

        // Hier noch Prüfen, ob das Guthaben auf dem Stripe-Konto 0 ist
        // $this->stripe->balance->retrieve([], ['stripe_account' => $organizer->stripe_account_id]);

        $this->stripe->accounts->delete($organizer->stripe_account_id);

        // Aktualisieren Sie die Datenbank mit der Stripe Account ID
        $organizer->stripe_account_id = null;
        $organizer->save();

        return redirect()->route('organizer.profile.edit')->with('success', 'Ihr Stripe-Konto wurde erfolgreich gelöscht.');
    }

    public function dashboard(): RedirectResponse
    {
        // Holen Sie sich den authentifizierten Benutzer und dessen Organizer-Daten
        $organizer = Auth::user()->organizer;

        // Login-Link erstellen und weiterleiten
        return redirect()->away($this->stripe->accounts->createLoginLink($organizer->stripe_account_id)->url);
    }
}

<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\OrganizerUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('organizer.profile.edit', [
            'user' => $request->user(),
            'organizer' => $request->user()->organizer,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('organizer.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the organizer's information.
     */
    public function updateOrganizer(OrganizerUpdateRequest $request): RedirectResponse
    {
        $organizer = $request->user()->organizer;
        $organizer->fill($request->validated());
        $organizer->save();

        return Redirect::route('organizer.profile.edit')->with('status', 'organizer-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function StripeAccountCreate(): RedirectResponse
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $userId = Auth::id();

        // Holen Sie sich die Daten des Organizers aus der Datenbank
        $organizer = \App\Models\Organizer::where('user_id', $userId)->first();

        // Prüfen, ob ein Organizer gefunden wurde
        if (!$organizer) {
            // Organizer wurde nicht gefunden, Fehlermeldung anzeigen.
            return redirect()->route('organizer.profile.edit')->with('warning', 'Es ist ein Fehler aufgetreten. Versuchen Sie es erneut.');
        }

        // Erstellen des Express-Kontos
        $account = $stripe->accounts->create([
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
                'transfers' => ['requested' => true],
            ],
        ]);

        // Speichern der Account-ID
        $accountId = $account->id;

        // Aktualisieren Sie die Datenbank mit der Stripe Account ID
        $organizer->stripe_account_id = $accountId;
        $organizer->save();

        // Erstellen des Konto-Links
        $accountLink = $stripe->accountLinks->create([
            'account' => $accountId,
            'refresh_url' => route('organizer.profile.stripe.refresh'),
            'return_url' => route('organizer.profile.stripe.return'),
            'type' => 'account_onboarding',
        ]);

        return redirect()->away($accountLink->url);

    }

    public function StripeAccountDelete($user_id): RedirectResponse
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        // Holen Sie sich die Daten des Organizers aus der Datenbank
        $organizer = \App\Models\Organizer::where('user_id', $user_id)->first();

        // Hier noch Prüfen, ob das Guthaben auf dem Stripe-Konto 0 ist
        // $stripe->balance->retrieve([], ['stripe_account' => $organizer->stripe_account_id]);

        $stripe->accounts->delete($organizer->stripe_account_id);

        // Aktualisieren Sie die Datenbank mit der Stripe Account ID
        $organizer->stripe_account_id = null;
        $organizer->save();

        return redirect()->route('organizer.profile.edit')->with('success', 'Ihr Stripe-Konto wurde erfolgreich gelöscht.');
    }

    public function StripeRefresh(): RedirectResponse
    {

        return redirect()->route('organizer.profile.edit')->with('warning', 'Es ist ein Fehler aufgetreten. Versuchen Sie es erneut.');

    }

    public function StripeReturn(): RedirectResponse
    {

        return redirect()->route('organizer.profile.edit')->with('success', 'Sie haben Ihr Konto erfolgreich mit Stripe verbunden.');

    }

    public function StripeAccountDashboard($user_id): RedirectResponse
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        // Holen Sie sich die Daten des Organizers aus der Datenbank
        $organizer = \App\Models\Organizer::where('user_id', $user_id)->first();

        // Login-Link erstellen und weiterleiten
        return redirect()->away($stripe->accounts->createLoginLink($organizer->stripe_account_id)->url);
    }


}

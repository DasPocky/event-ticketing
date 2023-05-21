<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\CustomerUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        if (!$user->customer) {
            // Erstellen Sie ein neues Customer-Objekt und speichern Sie es in der Datenbank
            $customer = new \App\Models\Customer();
            $customer->user_id = $user->id;
            $customer->save();

            // Weisen Sie das neu erstellte Customer-Objekt dem Benutzer zu
            $user->customer = $customer;
        }


        return view('dashboard.profile.edit', [
            'user' => $request->user(),
            'customer' => $request->user()->customer,
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateCustomer(CustomerUpdateRequest $request): RedirectResponse
    {
        $customer = $request->user()->customer;
        $customer->fill($request->validated());
        $customer->save();

        return Redirect::route('home');
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
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckStripeConnected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->organizer && !Auth::user()->organizer->stripe_account_id) {
            // Wenn der eingeloggte Benutzer ein Organisator ist und noch kein Stripe-Konto hat, leiten Sie ihn zur Stripe-Konto-Erstellungsseite weiter
            return redirect()->route('organizer.profile.edit')->with('error', 'Sie müssen zuerst Ihr Konto mit Stripe verbinden, um auf diese Funktion zugreifen zu können.');
        }

        return $next($request);
    }
}

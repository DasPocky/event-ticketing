<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatusEnum;
use App\Models\Customer;
use App\Models\Purchase;
use App\Mail\Payment\PaymentFailed;
use App\Mail\Payment\PaymentSuccess;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Symfony\Component\HttpFoundation\Response;

class WebhookController extends CashierController
{
    /**
     * Behandelt einen Stripe Webhook, der ausgelöst wird, wenn eine Checkout-Session abgeschlossen wurde.
     *
     * @param  array  $payload  Die vom Webhook empfangenen Daten.
     * @return Response  Gibt eine HTTP-Antwort zurück, um zu signalisieren, dass der Webhook korrekt verarbeitet wurde.
     */
    public function handleCheckoutSessionCompleted($payload)
    {
        // Holt die Checkout-Session aus den Webhook-Daten.
        $session = $payload['data']['object'];

        // Findet alle Käufe, die der Session-ID entsprechen.
        $purchases = Purchase::where('session_id', $session['id'])->get();

        // Aktualisiert die Payment-Intent-ID für jeden gefundenen Kauf.
        foreach ($purchases as $purchase) {
            $purchase->update(['payment_intent' => $session['payment_intent']]);
        }

        // Gibt eine Antwort zurück, um zu signalisieren, dass der Webhook korrekt verarbeitet wurde.
        return new Response('Webhook Handled', 200);
    }

    /**
     * Handle a Stripe webhook that is triggered when a payment intent requires a payment method.
     *
     * @param  array  $payload  The data received from the webhook.
     * @return Response  Returns an HTTP response to signal that the webhook was processed correctly.
     */
    public function handlePaymentIntentPaymentFailed($payload)
    {
        // Retrieve the payment intent from the webhook data.
        $paymentIntent = $payload['data']['object'];

        // Find all purchases matching the payment intent ID.
        $purchases = Purchase::where('payment_intent', $paymentIntent['id'])->get();

        // Update the payment status for each found purchase to "requires payment method".
        foreach ($purchases as $purchase) {
            $purchase->update(['payment_status' => PaymentStatusEnum::Failed]);
        }

        // Retrieve the stripe customer ID from the payment intent
        $stripeCustomerId = $paymentIntent['customer'];

        // Find the customer with the stripe customer ID
        $customer = Customer::with('user')->where('stripe_id', $stripeCustomerId)->first();

        if (!$customer || !$customer->user) {
            // Handle case where customer or user is not found, if necessary
            return new Response('Webhook Handled: Customer or User not found', 200);
        }

        $user = $customer->user;
        $email = $user->email;

        Mail::to($email)->send(new PaymentFailed());

        // Return a response to signal that the webhook was processed correctly.
        return new Response('Webhook Handled', 200);
    }


    /**
     * Behandelt einen Stripe Webhook, der ausgelöst wird, wenn eine Zahlungsabsicht erfolgreich war.
     *
     * @param  array  $payload  Die vom Webhook empfangenen Daten.
     * @return Response  Gibt eine HTTP-Antwort zurück, um zu signalisieren, dass der Webhook korrekt verarbeitet wurde.
     */
    public function handlePaymentIntentSucceeded($payload)
    {
        // Holt die Zahlungsabsicht aus den Webhook-Daten.
        $paymentIntent = $payload['data']['object'];

        // Findet alle Käufe, die der Payment-Intent-ID entsprechen.
        $purchases = Purchase::where('payment_intent', $paymentIntent['id'])->get();

        // Setzt den Zahlungsstatus für jeden gefundenen Kauf auf "bestätigt".
        foreach ($purchases as $purchase) {
            $purchase->update(['payment_status' => PaymentStatusEnum::Confirmed]);
        }

        // Retrieve the stripe customer ID from the payment intent
        $stripeCustomerId = $paymentIntent['customer'];

        // Find the customer with the stripe customer ID
        $customer = Customer::with('user')->where('stripe_id', $stripeCustomerId)->first();

        if (!$customer || !$customer->user) {
            // Handle case where customer or user is not found, if necessary
            return new Response('Webhook Handled: Customer or User not found', 200);
        }

        $user = $customer->user;
        $email = $user->email;

        Mail::to($email)->send(new PaymentSuccess());

        // Gibt eine Antwort zurück, um zu signalisieren, dass der Webhook korrekt verarbeitet wurde.
        return new Response('Webhook Handled', 200);
    }
}

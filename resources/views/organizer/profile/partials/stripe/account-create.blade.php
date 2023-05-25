<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Connect Stripe Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Connect your account with the payment service provider Stripe to manage locations, events and tickets.') }}
        </p>
    </header>

    <x-primary-button-link href="{{ route('organizer.stripe.account.create') }}">{{ __('Connect') }}</x-primary-button-link>
</section>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create Stripe Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('XXX') }}
        </p>
    </header>

    <x-primary-button-link href="{{ route('organizer.profile.stripe.account.create') }}">{{ __('Stripe Account Create') }}</x-primary-button-link>
</section>

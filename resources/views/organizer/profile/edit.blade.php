<x-organizer-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold tracking-widest text-gray-500 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Zeige hier Meldungen an -->
            @if ($message = Session::get('success'))
                <div class="p-4 bg-green-500 text-white rounded-lg shadow-md">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="p-4 bg-red-500 text-white rounded-lg shadow-md">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('warning'))
                <div class="p-4 bg-yellow-500 text-white rounded-lg shadow-md">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('info'))
                <div class="p-4 bg-blue-500 text-white rounded-lg shadow-md">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('organizer.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('organizer.profile.partials.update-organizer-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @if(empty($organizer->stripe_account_id))
                        @include('organizer.profile.partials.stripe.account-create')
                    @else
                        <p>Sie haben bereits ein Stripe-Konto verknüpft.</p>
                        <x-primary-button-link href="{{ route('organizer.profile.stripe.account.dashboard', $user) }}">
                            Zum Stripe Dashboard
                        </x-primary-button-link>
                        <x-primary-button-link href="{{ route('organizer.profile.stripe.account.delete', $user) }}">
                            Stripe Konto Löschen
                        </x-primary-button-link>
                    @endif
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('organizer.profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('organizer.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-organizer-layout>

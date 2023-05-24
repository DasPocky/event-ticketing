<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Upgrade to Organizer') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Upgrade your account to an organizer account. Please note, it is not possible to switch back to a user account after the upgrade!') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'upgrade-to-organizer')"
    >{{ __('Upgrade Account') }}</x-danger-button>

    <x-modal name="upgrade-to-organizer" focusable>
        <form method="post" action="{{ route('dashboard.profile.upgradeOrganizer') }}" class="p-6">
            @csrf

            @method('patch')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Upgrade Account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Upgrade your account to an organizer account. Please note, it is not possible to switch back to a user account after the upgrade!') }}
            </p>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('Organizer Name') }}"  />

                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Organizer Name') }}"
                />

            </div>

            <div class="mt-6">
                <x-input-label for="address" value="{{ __('Address') }}"  />

                <x-text-input
                    id="address"
                    name="address"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Address') }}"
                />

            </div>

            <div class="mt-6">
                <x-input-label for="address" value="{{ __('Zip') }}"  />

                <x-text-input
                    id="zip"
                    name="zip"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Zip') }}"
                />

            </div>

            <div class="mt-6">
                <x-input-label for="city" value="{{ __('City') }}"  />

                <x-text-input
                    id="city"
                    name="city"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('City') }}"
                />

            </div>

            <div class="mt-6">
                <x-input-label for="country" value="{{ __('Country') }}"  />

                <x-text-input
                    id="country"
                    name="country"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Country') }}"
                />

            </div>

            <div class="mt-6">
                <x-input-label for="email" value="{{ __('Email') }}"  />

                <x-text-input
                    id="email"
                    name="email"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Email') }}"
                />

            </div>

            <div class="mt-6">
                <x-input-label for="phone" value="{{ __('Phone') }}"  />

                <x-text-input
                    id="phone"
                    name="phone"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Phone') }}"
                />

            </div>

            <div class="mt-6">
                <x-input-label for="website" value="{{ __('Website') }}"  />

                <x-text-input
                    id="website"
                    name="website"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Website') }}"
                />

            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Upgrade Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

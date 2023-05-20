<x-organizer-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold tracking-widest text-gray-500 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
            {{ __('Add Venue') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <div class="max-w-7xl mx-auto">
            <div class="shadow-md sm:rounded-lg">
                <form method="POST" action="{{ route('organizer.venues.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="px-6 py-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div class="px-6 py-4">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <!-- Zip -->
                    <div class="px-6 py-4">
                        <x-input-label for="zip" :value="__('PLZ')" />
                        <x-text-input id="zip" class="block mt-1 w-full" type="text" name="zip" required />
                        <x-input-error :messages="$errors->get('zip')" class="mt-2" />
                    </div>

                    <!-- City -->
                    <div class="px-6 py-4">
                        <x-input-label for="city" :value="__('City')" />
                        <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" required />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>

                    <!-- Country -->
                    <div class="px-6 py-4">
                        <x-input-label for="country" :value="__('Country')" />
                        <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" required />
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>

                    <!-- Image -->
                    <div class="px-6 py-4">
                        <x-input-label for="image" :value="__('Image')" />
                        <input id="image" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm " type="file" name="image" required autofocus />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- contact_name -->
                    <div class="px-6 py-4">
                        <x-input-label for="contact_name" :value="__('Contact Name')" />
                        <x-text-input id="contact_name" class="block mt-1 w-full" type="text" name="contact_name" required />
                        <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
                    </div>

                    <!-- contact_email -->
                    <div class="px-6 py-4">
                        <x-input-label for="contact_email" :value="__('Contact Email')" />
                        <x-text-input id="contact_email" class="block mt-1 w-full" type="text" name="contact_email" required />
                        <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
                    </div>

                    <!-- contact_phone -->
                    <div class="px-6 py-4">
                        <x-input-label for="contact_phone" :value="__('Contact Phone')" />
                        <x-text-input id="contact_phone" class="block mt-1 w-full" type="text" name="contact_phone" required />
                        <x-input-error :messages="$errors->get('contact_phone')" class="mt-2" />
                    </div>

                    <!-- notes -->
                    <div class="px-6 py-4">
                        <x-input-label for="notes" :value="__('Notes')" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:min-h-full" required autofocus></textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>


                    <!-- Submit Button -->
                    <div class="px-6 py-4 bg-gray-50 text-right">
                        <x-primary-button href="{{ route('organizer.venues.create') }}">
                            {{ __('Add Venue') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-organizer-layout>

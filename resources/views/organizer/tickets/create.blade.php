<!-- Liste in einer TailwindCSS Tabelle alle events auf, nimm Bezug auf das Model "event" -->
<x-organizer-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold tracking-widest text-gray-500 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
            {{ __('Add Ticket') }}
        </h2>
    </x-slot>

    <div class="p-10 max-w-7xl mx-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <!-- Zeige alle Errors des Events an -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('organizer.event.tickets.store', $event) }}">
                @csrf
                <!-- Ticket Group -->
                <div class="px-6 py-4">
                    <x-input-label for="ticket_group_id" :value="__('Ticket Group')" />

                    <select id="ticket_group_id" name="ticket_group_id" required class="block mt-1 w-full">
                        @foreach ($ticketGroups as $ticketGroup)
                            <option value="{{ $ticketGroup->id }}">{{ $ticketGroup->name }}</option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('ticket_group_id')" class="mt-2" />
                </div>

                <!-- Name -->
                <div class="px-6 py-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Price -->
                <div class="px-6 py-4">
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" required autofocus />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="px-6 py-4 bg-gray-50 text-right">
                    <x-primary-button>
                        {{ __('Add Ticket') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-organizer-layout>

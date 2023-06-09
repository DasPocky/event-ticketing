<x-organizer-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold tracking-widest text-gray-500 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-10 max-w-7xl mx-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-gray-200 p-5">
            <div class="border-b border-b-gray-500">
                {{ __('Venues') }}
            </div>
            {{ $venues }}
        </div>
    </div>
</x-organizer-layout>

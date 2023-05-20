<!-- Liste in einer TailwindCSS Tabelle alle events auf, nimm Bezug auf das Model "event" -->
<x-organizer-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold tracking-widest text-gray-500 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="p-10 max-w-7xl mx-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            Content ...
        </div>
    </div>
</x-organizer-layout>


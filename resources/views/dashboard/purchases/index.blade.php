<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold tracking-widest text-gray-500 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
            {{ __('Your Purchases') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($purchases->count())
                        @foreach($purchases as $eventTitle => $eventPurchases)
                            <h2 class="text-lg font-semibold tracking-widest text-gray-500 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">{{ $eventTitle }}</h2>
                            <div class="overflow-x-auto">
                                <table class="mt-4 w-full table-auto border-collapse border border-gray-400">
                                    <thead>
                                    <tr class="bg-gray-200">
                                        <th class="px-4 py-2 text-left">Kaufdatum</th>
                                        <th class="px-4 py-2 text-left">Tickettyp</th>
                                        <th class="px-4 py-2 text-left">Preis</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($eventPurchases as $purchase)
                                        <tr class="border-b border-gray-400">
                                            <td class="px-4 py-2">{{ $purchase->created_at }}</td>
                                            <td class="px-4 py-2">{{ $purchase->ticket->name }}</td>
                                            <td class="px-4 py-2">{{ $purchase->ticket->price }} €</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @else
                        <p>You have not purchased any products yet.</p>
                    @endif



                </div>
            </div>
        </div>
    </div>
</x-app-layout>

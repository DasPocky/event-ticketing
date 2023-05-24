<x-guest-layout>
    <div class="container mx-auto px-6 my-auto">
        <div class="flex justify-center w-full">
            <div class="max-w-full w-full flex flex-col md:flex-row mb-5 md:space-y-0 md:space-x-6">
                <div class="relative md:w-3/5">
                    <img class="hover:grow hover:shadow-lg rounded-lg w-full h-full object-cover" src="{{ asset('storage/' . $event->image) }}">
                    <div class="absolute top-0 left-0 bg-white bg-opacity-75 text-black text-xl font-semibold text-center uppercase p-4 w-full rounded-t-lg">{{ $event->title }}</div>
                </div>
                <form class="md:w-2/5 mt-4 md:mt-0" action="{{ route('purchases.store', $event) }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Fehler:</strong>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @foreach($groupedTickets as $ticketGroupId => $ticketsInGroup)
                        <h3 class="text-lg font-semibold text-gray-700 py-1">
                            {{ $ticketsInGroup->first()->ticketGroup ? $ticketsInGroup->first()->ticketGroup->name : 'No Group' }}
                        </h3>
                        @foreach($ticketsInGroup as $ticket)
                            <div class="flex justify-between items-center font-thin py-1">
                                <div class="text-sm text-gray-800 flex-grow">{{ $ticket->name }}</div>
                                <div class="text-sm text-gray-800 text-right w-20 mr-4">{{ $ticket->price }} €</div>
                                <input type="number" id="quantity[{{ $ticket->id }}]" name="tickets[{{ $ticket->id }}]" min="0" max="{{ $ticket->ticketGroup->quantity_total - $ticket->quantity_sold }}" value="0" {{ $ticket->ticketGroup->quantity_sold == $ticket->ticketGroup->quantity_total ? 'disabled' : '' }} class="w-14 appearance-none rounded-none relative px-2 py-1 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                            </div>
                        @endforeach
                    @endforeach
                    <hr class="border-gray-800 my-4">
                    <button type="submit" class="inline-flex items-center px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Ticket(s) kaufen
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>


<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    {{ $event->title }} - Tickets kaufen
                </h2>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('purchases.store', $event) }}" method="POST">
                @csrf
                @foreach($tickets as $ticket)
                    <div>
                        <div class="mt-1">
                            <h2 class="text-lg font-semibold text-gray-700">{{ $ticket->name }}</h2>
                            <label for="quantity[{{ $ticket->id }}]" class="sr-only">Anzahl</label>
                            <input type="number" id="quantity[{{ $ticket->id }}]" name="tickets[{{ $ticket->id }}]" min="0" max="{{ $ticket->quantity - $ticket->quantity_sold }}" value="0" {{ $ticket->quantity_sold == $ticket->quantity ? 'disabled' : '' }} class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                            @if ($ticket->quantity_sold == $ticket->quantity)
                                <span class="text-red-500 text-sm">Ausverkauft</span>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Ticket(s) kaufen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

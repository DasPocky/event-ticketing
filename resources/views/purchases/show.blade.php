<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Kaufbestätigung
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Vielen Dank für den Kauf von {{ $purchase->quantity }} Ticket(s) für das Event "{{ $purchase->event->title }}" ({{ $purchase->ticket->name }}).
                </p>
            </div>
            <div>
                <a href="{{ route('home') }}" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Weitere Events anzeigen
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

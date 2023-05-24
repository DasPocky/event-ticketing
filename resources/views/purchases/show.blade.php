<x-guest-layout>
    <div x-data="paymentStatus()" x-init="checkStatus()" class="container mx-auto px-6 my-auto flex items-center justify-center">
        <div class="max-w-2xl w-full space-y-8">
            <div>
                <div class="flex flex-col justify-center items-center">
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                        Kaufbestätigung
                    </h2>
                    <div class="w-3/5 mt-2">
                        Ihre Bestellung wurde erfolgreich abgeschlossen. Sie erhalten in Kürze eine E-Mail mit den Details zu Ihrer Bestellung.
                    </div>
                </div>
                <div class="overflow-x-auto mt-6">
                    <table class="table-auto border-collapse w-full">
                        <thead>
                        <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
                            <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">Event</th>
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Ticket-Typ</th>
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Anzahl</th>
                            <th class="px-4 py-2 " style="background-color:#f8f8f8">Preis</th>
                        </tr>
                        </thead>
                        <tbody class="text-sm font-normal text-gray-700">
                        @foreach($purchases as $purchase)
                            <tr class="hover:bg-gray-100 py-4">
                                <td class="px-4 py-4">{{ $purchase->event->title }}</td>
                                <td class="px-4 py-4">{{ $purchase->ticket->ticketGroup->name }} > {{ $purchase->ticket->name }}</td>
                                <td class="px-4 py-4">{{ $purchase->quantity }}</td>
                                <td class="px-4 py-4 text-right">{{ number_format($purchase->ticket->price, 2) }} €</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td class="px-4 py-4 text-lg text-right font-bold underline">{{ number_format($totalPrice, 2) }} €</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('home') }}" class="inline-flex items-center px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Fertig
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

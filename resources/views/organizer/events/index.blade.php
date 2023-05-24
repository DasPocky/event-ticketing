<!-- Liste in einer TailwindCSS Tabelle alle events auf, nimm Bezug auf das Model "event" -->
<x-organizer-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold tracking-widest text-gray-500 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
        @foreach($events as $event)
            <div class="bg-white rounded-lg overflow-hidden shadow-md dark:bg-gray-800 h-full flex flex-col">
                <div class="flex-grow">
                    <div class="p-2 bg-gray-300">
                        <h3 class="font-bold text-xl text-center uppercase">{{$event->title}}</h3>
                    </div>
                    <div class="p-2 flex flex-row justify-between ml-2 mr-2 text-gray-700 dark:text-white border-b border-b-gray-400">
                        <div class="flex flex-row items-center">
                            <div>
                                <svg class="w-6 h-6 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M320 32c0-9.9-4.5-19.2-12.3-25.2S289.8-1.4 280.2 1l-179.9 45C79 51.3 64 70.5 64 92.5V448H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H96 288h32V480 32zM256 256c0 17.7-10.7 32-24 32s-24-14.3-24-32s10.7-32 24-32s24 14.3 24 32zm96-128h96V480c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H512V128c0-35.3-28.7-64-64-64H352v64z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col text-center text-xs">
                                <span>{{ \Carbon\Carbon::parse($event->entry_datetime)->format('d.m.Y')}}</span>
                                <span>{{ \Carbon\Carbon::parse($event->entry_datetime)->format('H:i')}} Uhr</span>
                            </div>
                        </div>
                        <div class="flex flex-row items-center">
                            <div>
                                <svg class="w-6 h-6 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9V168c0-8.7 4.7-16.7 12.3-20.9z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col text-center text-xs">
                                <span>{{ \Carbon\Carbon::parse($event->start_datetime)->format('d.m.Y')}}</span>
                                <span>{{ \Carbon\Carbon::parse($event->start_datetime)->format('H:i')}} Uhr</span>
                            </div>
                        </div>
                        <div class="flex flex-row items-center">
                            <div>
                                <svg class="w-6 h-6 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M208 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM123.7 200.5c1-.4 1.9-.8 2.9-1.2l-16.9 63.5c-5.6 21.1-.1 43.6 14.7 59.7l70.7 77.1 22 88.1c4.3 17.1 21.7 27.6 38.8 23.3s27.6-21.7 23.3-38.8l-23-92.1c-1.9-7.8-5.8-14.9-11.2-20.8l-49.5-54 19.3-65.5 9.6 23c4.4 10.6 12.5 19.3 22.8 24.5l26.7 13.3c15.8 7.9 35 1.5 42.9-14.3s1.5-35-14.3-42.9L281 232.7l-15.3-36.8C248.5 154.8 208.3 128 163.7 128c-22.8 0-45.3 4.8-66.1 14l-8 3.5c-32.9 14.6-58.1 42.4-69.4 76.5l-2.6 7.8c-5.6 16.8 3.5 34.9 20.2 40.5s34.9-3.5 40.5-20.2l2.6-7.8c5.7-17.1 18.3-30.9 34.7-38.2l8-3.5zm-30 135.1L68.7 398 9.4 457.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L116.3 441c4.6-4.6 8.2-10.1 10.6-16.1l14.5-36.2-40.7-44.4c-2.5-2.7-4.8-5.6-7-8.6zM550.6 153.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L530.7 224H384c-17.7 0-32 14.3-32 32s14.3 32 32 32H530.7l-25.4 25.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l80-80c12.5-12.5 12.5-32.8 0-45.3l-80-80z"/>
                                </svg>
                            </div>
                            <div class="flex flex-col text-center text-xs">
                                @if(!isset($event->end_datetime))
                                    <span>OPEN<br>END</span>
                                @else
                                    <span>{{ \Carbon\Carbon::parse($event->end_datetime)->format('d.m.Y')}}</span>
                                    <span>{{ \Carbon\Carbon::parse($event->end_datetime)->format('H:i')}} Uhr</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        @php
                            $groupedTickets = $event->tickets->groupBy('ticket_group_id');
                        @endphp
                        @if ($groupedTickets->count() === 0)
                            <p class="font-bold text-lg">Keine Ticket-Groups vorhanden</p>
                            <p><a href="{{ route('organizer.event.ticket-groups.create', $event) }}" class="px-3 py-1 rounded text-blue-600 bg-blue-100 hover:underline dark:text-blue-500">Ticket-Group hinzufügen</a></p>
                        @else
                            @foreach($groupedTickets as $ticketGroupId => $tickets)
                                @if($tickets->first()->ticketGroup)
                                    <h4 class="font-semibold text-sm bg-red-200 pl-2 uppercase">{{$tickets->first()->ticketGroup->name}}</h4>
                                    @foreach($tickets as $ticket)
                                        <div class="flex justify-between items-center font-thin text-xs pl-2 pt-1 pb-1 uppercase grid grid-cols-3">
                                            <span class="font-bold col-span-1">{{$ticket->name}}</span>
                                            <span class="text-sm col-span-1 text-right">{{$ticket->price}} €</span>
                                            <form class="flex flex-row justify-end items-center col-span-1" action="{{route('organizer.event.tickets.destroy', ['event' => $event->id, 'ticket' => $ticket->id])}}" method="POST" onsubmit="return confirm('Wirklich löschen?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{route('organizer.event.tickets.edit', ['event' => $event->id, 'ticket' => $ticket->id])}}">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM325.8 139.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-21.4 21.4-71-71 21.4-21.4c15.6-15.6 40.9-15.6 56.6 0zM119.9 289L225.1 183.8l71 71L190.9 359.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z"/></svg>
                                                </a>
                                                <button>
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm79 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="font-bold text-lg">Keine Tickets für diese Gruppe vorhanden</p>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100 dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex justify-between">
                        <div>
                            <x-primary-button-link href="{{route('organizer.events.show', $event)}}">Details</x-primary-button-link>
                            <x-primary-button-link href="{{route('organizer.events.edit', $event)}}">Edit</x-primary-button-link>
                            <x-primary-button-link href="{{route('organizer.events.show', $event)}}">Add Tickt</x-primary-button-link></div>
                        <form class="inline-block ml-2" action="{{route('organizer.events.destroy', $event)}}" method="POST" onsubmit="return confirm('Wirklich löschen?')">
                            @csrf
                            @method('DELETE')
                            <x-primary-button>Delete</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



</x-organizer-layout>


<!-- Liste in einer TailwindCSS Tabelle alle Venues auf, nimm Bezug auf das Model "Venue" -->
<x-organizer-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold tracking-widest text-gray-500 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
            {{ __('Venues') }}
        </h2>
    </x-slot>

    <div class="p-10 max-w-7xl mx-auto">
        <!-- Card -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <!-- Card Content -->
            <div class="bg-gray-100 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Venue Name -->
                <h2 class="text-lg font-semibold tracking-widest text-gray-800 mb-2">{{$venue->name}}</h2>
                <div class="flex flex-row">
                    <div class="w-1/3">
                        <div class="h-full">
                            <img src="{{url($venue->image)}}" alt="{{$venue->name}}" class="rounded-lg shadow-md">
                        </div>
                    </div>
                    <div class="text-gray-800 text-lg  flex flex-col w-1/3 justify-between ml-5">
                        <div class="text-gray-800 text-lg  flex flex-row">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-7 h-5 mr-3 mt-2">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M302.8 312C334.9 271.9 408 174.6 408 120C408 53.7 354.3 0 288 0S168 53.7 168 120c0 54.6 73.1 151.9 105.2 192c7.7 9.6 22 9.6 29.6 0zM416 503l144.9-58c9.1-3.6 15.1-12.5 15.1-22.3V152c0-17-17.1-28.6-32.9-22.3l-116 46.4c-.5 1.2-1 2.5-1.5 3.7c-2.9 6.8-6.1 13.7-9.6 20.6V503zM15.1 187.3C6 191 0 199.8 0 209.6V480.4c0 17 17.1 28.6 32.9 22.3L160 451.8V200.4c-3.5-6.9-6.7-13.8-9.6-20.6c-5.6-13.2-10.4-27.4-12.8-41.5l-122.6 49zM384 255c-20.5 31.3-42.3 59.6-56.2 77c-20.5 25.6-59.1 25.6-79.6 0c-13.9-17.4-35.7-45.7-56.2-77V449.4l192 54.9V255z"/>
                                </svg>
                            </div>
                            <div>
                                <div>{{$venue->address}}</div>
                                <div>{{$venue->zip}} {{$venue->city}}</div>
                                <div>{{$venue->country}}</div>
                            </div>
                        </div>
                        <div class="text-gray-800 text-lg  flex flex-row">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-7 h-5 mr-3 mt-2">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M96 0C60.7 0 32 28.7 32 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H96zM208 288h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H144c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V80zM496 192c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V336z"/>
                                </svg>
                            </div>
                            <div>
                                <div>{{$venue->contact_name}}</div>
                                <div>{{$venue->contact_phone}}</div>
                                <div>{{$venue->contact_email}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-gray-800 text-lg w-1/3">
                        <div class="flex flex-col justify-between h-full">
                            <div class="text-justify">
                                {{ $venue->notes }}
                            </div>
                            <div class="flex flex-row justify-between">
                                <x-primary-button-link href="{{route('organizer.venues.edit', $venue)}}">
                                    {{ __('Edit') }}
                                </x-primary-button-link>
                                <form class="inline-block" action="{{route('organizer.venues.destroy', $venue)}}" method="POST" onsubmit="return confirm('Wirklich löschen?')">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button>
                                        {{ __('Delete') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-organizer-layout>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased">
<div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
    <div @click.away="open = false" class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-gray-100 md:w-64" x-data="{ open: false }">
        <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4 bg-gray-200 h-16">
            <a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg focus:outline-none focus:shadow-outline">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto mt-5 uppercase">
            <x-organizer-nav-link :href="route('organizer.index')"
                                  :active="request()->routeIs('organizer.index')">
                {{ __('Home') }}
            </x-organizer-nav-link>
            <x-organizer-nav-link :href="route('organizer.venues.index')"
                                  :active="request()->routeIs('organizer.venues.index')">
                {{ __('Venues') }}
            </x-organizer-nav-link>
            <x-organizer-nav-link :href="route('organizer.events.index')"
                                  :active="request()->routeIs('organizer.events.index')">
                {{ __('Events') }}
            </x-organizer-nav-link>
        </nav>
    </div>
    <div class="w-full">
        <!-- Page Heading -->
        <header class="flex flex-col w-full text-gray-700 bg-gray-200">
            <div class="flex flex-row items-center justify-between px-8 py-4 h-16">
                {{ $header }}
                <div>
                    <div class="flex items-center">
                        <!-- Benutzer Icon und Name -->
                        <a href="{{ route('organizer.profile.edit') }}" class="flex flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 mr-2 mt-1">
                                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M224 256A128 128 0 1 1 224 0a128 128 0 1 1 0 256zM209.1 359.2l-18.6-31c-6.4-10.7 1.3-24.2 13.7-24.2H224h19.7c12.4 0 20.1 13.6 13.7 24.2l-18.6 31 33.4 123.9 36-146.9c2-8.1 9.8-13.4 17.9-11.3c70.1 17.6 121.9 81 121.9 156.4c0 17-13.8 30.7-30.7 30.7H285.5c-2.1 0-4-.4-5.8-1.1l.3 1.1H168l.3-1.1c-1.8 .7-3.8 1.1-5.8 1.1H30.7C13.8 512 0 498.2 0 481.3c0-75.5 51.9-138.9 121.9-156.4c8.1-2 15.9 3.3 17.9 11.3l36 146.9 33.4-123.9z"/>
                            </svg>
                            <!-- Benutzer Name -->
                            <p class="whitespace-nowrap overflow-ellipsis overflow-hidden mr-2 border-b border-gray-800 pb-1 md:block hidden">{{ auth()->user()->name}}</p>
                        </a>

                        <!-- Senkrechte Linie -->
                        <div class="border-r-2 border-gray-800 h-7 mr-2"></div>

                        <a href="{{ route('home') }}" class="flex flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-4 mr-2 mt-1">
                                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                            </svg>
                            <p class="whitespace-nowrap overflow-ellipsis overflow-hidden mr-2 border-b border-gray-800 pb-1 md:block hidden">Home</p>
                        </a>

                        <!-- Senkrechte Linie -->
                        <div class="border-r-2 border-gray-800 h-7 mr-2"></div>

                        <!-- Logout Icon -->
                        <!-- Erstelle ein Logout-Form das mit Laravel Breeze funktioniert -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex flex-row">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-2 mt-1">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/>
                                </svg>
                                <p class="whitespace-nowrap overflow-ellipsis overflow-hidden mr-2 border-b border-gray-800 pb-1 md:block hidden">Logout</p>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </header>

        <main>
            <div>
                {{ $slot }}
            </div>
        </main>
    </div>
</div>

</body>
</html>

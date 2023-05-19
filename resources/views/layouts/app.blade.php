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
    <div @click.away="open = false"
         class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-slate-100 md:w-64 dark:text-gray-200 dark:bg-gray-800"
         x-data="{ open: false }">
        <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
            <a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
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
        <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
            <x-app-nav-link :href="route('dashboard.index')"
                                  :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-app-nav-link>
        </nav>
    </div>
    <div class="w-full">
        <!-- Page Heading -->
        <header class="flex flex-col w-full text-gray-700 bg-slate-100 dark:text-gray-200 dark:bg-gray-800">
            <div class="flex flex-row items-center justify-between px-8 py-4">
                {{ $header }}
                <div>
                    <div class="flex items-center">
                            <!-- Benutzer Icon und Name -->
                            <a href="{{ route('dashboard.profile.edit') }}" class="flex flex-row">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 mr-2 mt-1">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/>
                                </svg>
                                <!-- Benutzer Name -->
                                <p class="whitespace-nowrap overflow-ellipsis overflow-hidden mr-2 border-b border-gray-800 pb-1">{{ auth()->user()->name}}</p>
                            </a>

                            <!-- Senkrechte Linie -->
                            <div class="border-r-2 border-gray-800 h-7 mr-2"></div>

                            <a href="{{ route('home') }}" class="flex flex-row">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-4 mr-2 mt-1">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                                </svg>
                                <p class="whitespace-nowrap overflow-ellipsis overflow-hidden mr-2 border-b border-gray-800 pb-1">Home</p>
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
                                    <p class="whitespace-nowrap overflow-ellipsis overflow-hidden mr-2 border-b border-gray-800 pb-1">Logout</p>
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

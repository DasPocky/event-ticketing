<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>{{ config('app.name', 'Laravel') }}</title>

    </head>
    <body class="bg-gray-100 py-6">
        <main class="w-full h-full px-8 py-12">
            {{ $slot }}
        </main>
    </body>
</html>

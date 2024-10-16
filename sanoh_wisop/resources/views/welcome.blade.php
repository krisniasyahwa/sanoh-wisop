<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcoming Page</title>
        @vite('resources/css/app.css')

    </head>
    <body class="font-sans antialiased bg-white dark:text-white/50">
        <header class="flex p-4 bg-gray-800 text-white">
            <div class="ml-auto">
                <a href="/login" class="px-4 py-2 bg-blue-500 rounded hover:bg-blue-700 transition">Login</a>
            </div>
        </header>

        <!-- Rest of the content goes here -->

    </body>
</html>

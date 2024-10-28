<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @viteReactRefresh
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
    body {
        font-family: 'Satoshi', sans-serif;
    }
</style>

<body>
    <div id="app">

        <div class="flex h-screen overflow-hidden">
            <!-- Include Sidebar -->
            @include('layouts.partials.sidebar')

            <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
                @include('layouts.partials.header')

            </div>
        </div>
</body>

</html>

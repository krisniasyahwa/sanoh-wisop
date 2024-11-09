@extends('layouts.app')

@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

<style>
    body {
        font-family: 'Satoshi', sans-serif;
    }
</style>

@section('content')
    <div class="flex h-screen overflow-hidden">
        <!-- Include Sidebar -->
        @include('layouts.partials.sidebar')

        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- Include Header -->
            @include('layouts.partials.header')

            <!-- Main Content -->
            <main>
                <div class="">

                </div>
            </main>
        </div>
    </div>
@endsection

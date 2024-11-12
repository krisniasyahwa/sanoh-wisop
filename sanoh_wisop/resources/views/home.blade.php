@extends('layouts.app')

@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

@section('content')
<div class="flex h-screen">
    <!-- Sidebar: posisi tetap di samping kiri -->
    <aside class="fixed top-0 left-0 h-full w-64 z-20">
        @include('layouts.partials.sidebar')
    </aside>

    <!-- Main Content -->
    <div class="flex flex-col ml-64">
        <!-- Header -->
        <header class="w-full fixed top-0 left-0 right-0">
            @include('layouts.partials.header')
        </header>

        <!-- Tabel dan Form Upload -->
        <main class="flex-1 mt-16 flex justify-center bg-gray-100">
            <div class="w-full max-w-6xl px-4 py-4 space-y-4">  <!-- space-y-4 ensures consistent spacing -->

                <!-- Include Upload File Section -->
                @include('layouts.partials.upload_file')

                <!-- Tabel -->
                @include('layouts.partials.table', ['documents' => $documents])
            </div>
        </main>
    </div>
</div>
@endsection

@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
    <!-- Include Header -->
    {{-- @include('layouts.partials.header') <!-- Pastikan path sesuai dengan struktur folder -->
 --}}

    <body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">

        <!-- Main Content -->
        <div class="container flex-grow ml-4">
            <!-- Dashboard Header -->
            <div class="flex justify-between items-center my-4">
                <h1 class="text-2xl font-bold">Dashboard Admin</h1>
                <img src="{{ asset('images/logo/logo-sanoh.png') }}" alt="Logo" class="h-12 w-auto">
                <!-- Tambahkan logo -->
            </div>

            <!-- Overview / Statistik -->
            <div class="bg-blue-200 p-4 rounded-lg mb-6">
                <h2 class="text-lg font-semibold">Overview / Statistik</h2>
                <p class="mt-2">Total Documents: 120 | Active Users: 50 | Expired Documents: 10</p>
                <!-- Contoh overview -->
            </div>

            <!-- List Document -->
            <div class="bg-blue-200 p-4 rounded-lg mb-6">
                <h2 class="text-lg font-semibold">List Document</h2>
                <ul class="mt-2 list-disc pl-5">
                    <li>Document A</li>
                    <li>Document B</li>
                    <li>Document C</li>
                    <!-- Tambahkan daftar dokumen sesuai kebutuhan -->
                </ul>
            </div>

            <!-- Searchbar -->
            <div class="mb-6">
                <input type="text" placeholder="Search documents..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <!-- Logout Button -->
            <div class="flex justify-end">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700 transition">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
        </div>
    @endsection

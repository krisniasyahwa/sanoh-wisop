@extends('layouts.app')

@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

@section('content')
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Container for header and content -->
        <div class="flex flex-col flex-1 h-full">
            <!-- Header -->
            <div>
                @include('layouts.partials.header')
            </div>

            <!-- Content with table below the header -->
            <div class="flex-1 mt-4 px-4 overflow-y-auto">
                <main>
                    <!-- Table Section -->
                    @include('layouts.partials.table', ['documents' => $documents])
                </main>
            </div>
        </div>
    </div>
@endsection

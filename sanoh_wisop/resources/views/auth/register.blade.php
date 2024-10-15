@extends('layouts.app')
@vite('resources/css/app.css')
@section('content')

<div class="min-h-screen flex items-center justify-center px-5 lg:px-0 bg-gray-100">
    <div class="max-w-screen-xl bg-white border shadow-lg sm:rounded-lg flex justify-center flex-1">
        <div class="flex-1 bg-blue-900 text-center hidden md:flex items-center justify-center">
            <div
                class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
                style="background-image: url('{{ asset('images/bg_sanoh.png') }}');">
            </div>
        </div>
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
            <div class="flex flex-col items-center">
                <div class="text-center mb-6">
                    <h1 class="text-3xl xl:text-4xl font-extrabold text-blue-900">
                        Sign up
                    </h1>
                    <p class="text-sm text-gray-500 mt-2">
                        Hey, enter your details to create your account
                    </p>
                </div>
                <div class="w-full flex-1">
                    <form method="POST" action="{{ route('register') }}" class="mx-auto max-w-xs flex flex-col gap-4">
                        @csrf
                        <input
                            class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            type="text"
                            name="name"
                            placeholder="Enter your name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                        />
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                        <input
                            class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            type="email"
                            name="email"
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            required
                        />
                        @error('email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                        <input
                            class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            type="password"
                            name="password"
                            placeholder="Password"
                            required
                        />
                        @error('password')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                        <input
                            class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            type="password"
                            name="password_confirmation"
                            placeholder="Confirm Password"
                            required
                        />
                        <button type="submit" class="mt-5 tracking-wide font-semibold bg-blue-900 text-white w-full py-4 rounded-lg hover:bg-blue-800 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                            <svg
                                class="w-6 h-6 -ml-2"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="8.5" cy="7" r="4" />
                                <path d="M20 8v6M23 11h-6" />
                            </svg>
                            <span class="ml-3">Sign Up</span>
                        </button>
                        <p class="mt-6 text-xs text-gray-600 text-center">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-blue-900 font-semibold hover:underline">
                                Sign in
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

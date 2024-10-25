@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar placeholder (if any, can be removed if not needed) -->
        <div class="hidden w-full xl:block xl:w-1/2">
            <div class="px-26 py-20 text-center flex flex-col items-center">
                <!-- Logo -->
                <a class="mb-5.5 inline-block" href="index.html">
                    <img class="hidden dark:block" src="{{ asset('images/logo/logo-sanoh.png') }}" alt="Logo"
                        style="width: 150px; height: auto; transform: translateX(-20px);" />
                </a>

                <!-- Illustration -->
                <span class="mt-5 inline-block">
                    <img src="{{ asset('images/sign-in/illustration-03.svg') }}" alt="illustration" />
                </span>
            </div>
        </div>

        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- Main Content Start -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <!-- Breadcrumb Start -->
                    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="text-title-md2 font-bold text-black dark:text-white">
                            Sign In
                        </h2>
                    </div>
                    <!-- Breadcrumb End -->

                    <!-- Form Section Start -->
                    <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                        <div class="flex flex-wrap items-center">
                            <!-- Sign-in Form -->
                            <div class="w-full xl:w-1/2 xl:border-l-2">
                                <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                                    <span class="mb-1.5 block font-medium"> Welcome to our platform, please sign in to continue.</span>
                                    <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                                        Sign In to Your Account
                                    </h2>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="mb-4">
                                            <label class="mb-2.5 block font-medium text-black dark:text-white">Email</label>
                                            <div class="relative">
                                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus
                                                    class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                                    placeholder="Enter your email" />
                                                @error('email')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-6">
                                            <label class="mb-2.5 block font-medium text-black dark:text-white">Password</label>
                                            <div class="relative">
                                                <input id="password" type="password" name="password" required autocomplete="current-password"
                                                    class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                                    placeholder="Enter your password" />
                                                @error('password')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="flex items-center mb-5">
                                            <input class="form-check-input mr-2" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="text-sm text-gray-600" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>

                                        <button type="submit"
                                            class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
                                            Sign In
                                        </button>

                                        @if (Route::has('password.request'))
                                            <p class="mt-6 text-xs text-gray-600 text-center">
                                                <a class="text-blue-900 font-semibold hover:underline"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            </p>
                                        @endif
                                    </form>

                                    <div class="mt-6 text-center">
                                        <p class="font-medium">
                                            Don’t have an account?
                                            <a href="{{ route('register') }}" class="text-primary">Sign Up</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form Section End -->
                </div>
            </main>
        </div>
    </div>
@endsection

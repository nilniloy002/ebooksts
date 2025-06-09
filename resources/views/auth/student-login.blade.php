@extends('layouts.auth')

@section('content')
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
                <img
                    aria-hidden="true"
                    class="object-contain w-full h-auto dark:hidden"
                    src="https://sts.institute/wp-content/uploads/2025/05/web-v4-01-scaled.jpg"
                    alt="Office"
                />
                <img
                    aria-hidden="true"
                    class="hidden object-cover w-full h-full dark:block"
                    src="{{ asset('assets/img/login-office-dark.jpeg') }}"
                    alt="Office"
                />
            </div>

            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                <div class="w-full">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                        Student Login
                    </h1>

                    <form method="POST" action="{{ route('student.login') }}">
                        @csrf
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Student ID</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-input"
                                type="text"
                                name="std_id"
                                value="{{ old('std_id') }}"
                                required
                                autofocus
                                placeholder="Enter your Student ID"
                            />
                        </label>

                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Password</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-input"
                                type="password"
                                name="password"
                                required
                                placeholder="Enter your password"
                            />
                        </label>

                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                       class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                                       name="remember">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                            </label>
                        </div>

                        <button
                            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            type="submit"
                        >
                            Log in
                        </button>
                    </form>

                    <!-- @if (Route::has('password.request'))
                        <p class="mt-4">
                            <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        </p>
                    @endif -->
                </div>
            </div>
        </div>
    </div>
@endsection

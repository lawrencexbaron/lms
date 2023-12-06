<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/uploads/favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-gray-50 text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:flex-row sm:justify-between items-center pt-6 sm:pt-0 bg-gray-100 w-full">
            <div class="hidden sm:w-1/2 sm:flex items-center justify-center min-h-screen relative">
                <img src="{{ asset('storage/uploads/background.png') }}" alt="background" class="absolute inset-0 w-full h-full object-cover filter brightness-50" />
                <img src="{{ asset('storage/uploads/logo.png') }}" alt="logo" class="relative w-1/4 bg-transparent" />
            </div>
            <div class="sm:w-1/2 sm:shadow-lg border-left min-h-screen flex items-center justify-center flex-col">
                <img src="{{ asset('storage/uploads/logo.png') }}" alt="logo" class="w-24 bg-transparent" />
                <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white border overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
                <x-input-label for="email" class="mt-2 w-full sm:max-w-lg text-center">
                    {{ __('Online Enrollment') }}
                </x-input-label>
                <x-primary-link href="{{ route('enroll.index') }}" class="mt-2 w-full sm:max-w-lg bg-red-700 hover:bg-red-600 focus:bg-red-800 text-white active:bg-red-900 focus:ring-red-500">
                    {{ __("Enroll now") }}
                </x-primary-link>
            </div>
        </div>
    </body>
</html>

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
            <div class="w-1/2 flex items-center justify-center min-h-screen">
                {{-- <x-primary-link href="{{ route('enroll.index') }}">
                    {{ __("Enroll now") }}
                </x-primary-link> --}}
                <img src="{{ asset('storage/uploads/logo.png') }}" alt="logo" class="w-1/2 bg-transparent" />
            </div>
            <div class="w-1/2 shadow-lg border-left min-h-screen flex items-center justify-center sm:flex-col">
                <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white border overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
                <x-primary-link href="{{ route('enroll.index') }}" class="mt-2 w-full sm:max-w-lg bg-green-500 hover:bg-green-600 text-white">
                    {{ __("Enroll now") }}
                </x-primary-link>
                
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" data-theme="winter">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-sky-50 via-white to-blue-100">
            <div class="w-full sm:max-w-md px-6 py-8">
                <div class="text-center mb-8">
                    <a href="/" class="inline-block">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-sky-500 to-blue-600 rounded-2xl shadow-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                            </svg>
                        </div>
                    </a>
                    <h2 class="mt-4 text-3xl font-bold text-gray-900">{{ config('app.name', 'Laravel') }}</h2>
                    <p class="mt-1 text-sm text-gray-500">Manage your tasks with ease and efficiency.</p>
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-sky-200/50 border border-white/50 p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>

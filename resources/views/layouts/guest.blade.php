<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sandana TrackFlow') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">

        <div class="absolute inset-0 bg-cover bg-center blur-sm scale-105"
             style="background-image: url('{{ asset('images/login-bg.jpg') }}');">
        </div>

        <div class="absolute inset-0 bg-blue-950/65"></div>

        <div class="relative z-10 w-full sm:max-w-md bg-white shadow-xl overflow-hidden rounded-2xl p-8">

    <div class="flex items-center justify-center mb-6">
        <img src="{{ asset('images/samator.png') }}"
             class="h-10 mr-3">

        <div>
            <h2 class="text-xl font-bold text-blue-900">
                Sandana TrackFlow
            </h2>

            <p class="text-sm text-gray-500">
                Document Approval System
            </p>
        </div>
    </div>

    {{ $slot }}

</div>
    </div>
</body>
</html>
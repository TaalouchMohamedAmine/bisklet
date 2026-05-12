<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f6f2ea] text-[#1e2a26] antialiased">
    <main class="grid min-h-screen lg:grid-cols-[1fr_520px]">
        <section class="hidden bg-[#194236] px-12 py-10 text-white lg:flex lg:flex-col lg:justify-between">
            <a href="{{ url('/') }}" class="text-2xl font-black tracking-tight">Biskilti</a>
            <div class="max-w-xl">
                <p class="mb-4 text-sm font-semibold uppercase tracking-[0.24em] text-[#f2c66d]">Ride smarter</p>
                <h1 class="text-5xl font-black leading-tight">Your bike account, ready when you are.</h1>
                <p class="mt-5 text-lg leading-8 text-white/75">Sign in, create an account, or recover access using Laravel's built-in authentication tools.</p>
            </div>
            <p class="text-sm text-white/60">&copy; {{ date('Y') }} Biskilti</p>
        </section>

        <section class="flex items-center justify-center px-5 py-10 sm:px-8">
            <div class="w-full max-w-md">
                <div class="mb-8 lg:hidden">
                    <a href="{{ url('/') }}" class="text-2xl font-black tracking-tight">Biskilti</a>
                </div>

                {{ $slot }}
            </div>
        </section>
    </main>
</body>
</html>

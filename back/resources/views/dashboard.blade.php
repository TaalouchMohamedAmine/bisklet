<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f6f2ea] text-[#1e2a26]">
    <main class="mx-auto flex min-h-screen max-w-5xl flex-col px-5 py-8">
        <header class="flex items-center justify-between border-b border-[#d7d0c2] pb-5">
            <a href="{{ route('dashboard') }}" class="text-2xl font-black tracking-tight">Biskilti</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-md bg-[#194236] px-4 py-2 text-sm font-black text-white transition hover:bg-[#2f6f58]">
                    Logout
                </button>
            </form>
        </header>

        <section class="flex flex-1 items-center py-16">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.22em] text-[#2f6f58]">Dashboard</p>
                <h1 class="mt-2 text-4xl font-black">Welcome, {{ auth()->user()->name }}.</h1>
                <p class="mt-4 max-w-2xl text-lg leading-8 text-[#5a625d]">You are logged in. This protected page is ready for the rest of your Biskilti features.</p>
            </div>
        </section>
    </main>
</body>
</html>

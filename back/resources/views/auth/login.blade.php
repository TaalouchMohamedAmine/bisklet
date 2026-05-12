<x-auth-layout title="Login">
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-[#2f6f58]">Welcome back</p>
        <h1 class="mt-2 text-3xl font-black">Login to your account</h1>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-bold">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="mt-2 w-full rounded-md border border-[#d7d0c2] bg-white px-4 py-3 outline-none transition focus:border-[#2f6f58] focus:ring-4 focus:ring-[#2f6f58]/15">
            @error('email')
                <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-bold">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password" class="mt-2 w-full rounded-md border border-[#d7d0c2] bg-white px-4 py-3 outline-none transition focus:border-[#2f6f58] focus:ring-4 focus:ring-[#2f6f58]/15">
            @error('password')
                <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between gap-4 text-sm">
            <label class="flex items-center gap-2 font-semibold">
                <input name="remember" type="checkbox" class="h-4 w-4 rounded border-[#d7d0c2] text-[#2f6f58] focus:ring-[#2f6f58]">
                Remember me
            </label>
            <a href="{{ route('password.request') }}" class="font-bold text-[#2f6f58] hover:text-[#194236]">Forgot password?</a>
        </div>

        <button type="submit" class="w-full rounded-md bg-[#194236] px-5 py-3 font-black text-white transition hover:bg-[#2f6f58] focus:outline-none focus:ring-4 focus:ring-[#2f6f58]/25">
            Login
        </button>
    </form>

    <p class="mt-7 text-center text-sm text-[#5a625d]">
        Need an account?
        <a href="{{ route('register') }}" class="font-black text-[#2f6f58] hover:text-[#194236]">Sign up</a>
    </p>
</x-auth-layout>

<x-auth-layout title="Forgot Password">
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-[#2f6f58]">Account help</p>
        <h1 class="mt-2 text-3xl font-black">Reset your password</h1>
        <p class="mt-3 text-sm leading-6 text-[#5a625d]">Enter your email and Laravel will send a secure password reset link.</p>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-bold">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="mt-2 w-full rounded-md border border-[#d7d0c2] bg-white px-4 py-3 outline-none transition focus:border-[#2f6f58] focus:ring-4 focus:ring-[#2f6f58]/15">
            @error('email')
                <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full rounded-md bg-[#194236] px-5 py-3 font-black text-white transition hover:bg-[#2f6f58] focus:outline-none focus:ring-4 focus:ring-[#2f6f58]/25">
            Send reset link
        </button>
    </form>

    <p class="mt-7 text-center text-sm text-[#5a625d]">
        Remembered it?
        <a href="{{ route('login') }}" class="font-black text-[#2f6f58] hover:text-[#194236]">Back to login</a>
    </p>
</x-auth-layout>

<x-auth-layout title="Sign Up">
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-[#2f6f58]">Start riding</p>
        <h1 class="mt-2 text-3xl font-black">Create your account</h1>
    </div>

    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-bold">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" class="mt-2 w-full rounded-md border border-[#d7d0c2] bg-white px-4 py-3 outline-none transition focus:border-[#2f6f58] focus:ring-4 focus:ring-[#2f6f58]/15">
            @error('name')
                <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-bold">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="mt-2 w-full rounded-md border border-[#d7d0c2] bg-white px-4 py-3 outline-none transition focus:border-[#2f6f58] focus:ring-4 focus:ring-[#2f6f58]/15">
            @error('email')
                <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-bold">Password</label>
            <input id="password" name="password" type="password" required autocomplete="new-password" class="mt-2 w-full rounded-md border border-[#d7d0c2] bg-white px-4 py-3 outline-none transition focus:border-[#2f6f58] focus:ring-4 focus:ring-[#2f6f58]/15">
            @error('password')
                <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-bold">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="mt-2 w-full rounded-md border border-[#d7d0c2] bg-white px-4 py-3 outline-none transition focus:border-[#2f6f58] focus:ring-4 focus:ring-[#2f6f58]/15">
        </div>

        <button type="submit" class="w-full rounded-md bg-[#194236] px-5 py-3 font-black text-white transition hover:bg-[#2f6f58] focus:outline-none focus:ring-4 focus:ring-[#2f6f58]/25">
            Sign up
        </button>
    </form>

    <p class="mt-7 text-center text-sm text-[#5a625d]">
        Already have an account?
        <a href="{{ route('login') }}" class="font-black text-[#2f6f58] hover:text-[#194236]">Login</a>
    </p>
</x-auth-layout>

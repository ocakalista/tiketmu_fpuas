<x-guest-layout>
    <h1 class="text-xl font-bold text-center text-gray-700 dark:text-white">Login</h1>

    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Login Form --}}
    <form method="POST" action="{{ route('login') }}" class="w-full max-w-md space-y-6">
        @csrf

        {{-- Email --}}
        <div class="w-full">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-200" />
            <x-text-input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="block mt-1 w-full bg-gray-100 border border-gray-300 text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-200" />
            <x-text-input id="password" name="password" type="password" required autocomplete="current-password" class="block mt-1 w-full bg-gray-100 border border-gray-300 text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember Me --}}
        <div>
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-700 dark:text-gray-200">Remember me</span>
            </label>
        </div>

        {{-- Submit & Forgot --}}
        <div class="flex items-center justify-between pt-4">
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm underline text-gray-700 hover:text-indigo-600 dark:text-gray-200 dark:hover:text-indigo-400">
                Forgot your password?
            </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<x-guest-layout>
    <x-auth.authentication-card>
        <x-slot name="logo">
            <x-auth.authentication-card-logo />
        </x-slot>
    
        <x-auth.validation-errors class="mb-4" />
    
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
    
        <form method="POST" action="{{ route('login') }}">
            @csrf
    
            <div>
                <x-auth.label for="email" value="{{ __('Email') }}" />
                <x-auth.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
    
            <div class="mt-4">
                <x-auth.label for="password" value="{{ __('Password') }}" />
                <x-auth.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>
    
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-auth.checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
    
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
    
                <x-auth.button class="ms-4">
                    {{ __('Log in') }}
                </x-auth.button>
            </div>
        </form>
    </x-auth.authentication-card>
    
</x-guest-layout>

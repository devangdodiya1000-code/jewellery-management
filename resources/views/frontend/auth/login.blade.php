<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('customer.login') }}" class="mt-2">
        @csrf

        <div class="mb-6">
            <h2 class="text-center font-medium" style="color:#EDE3CE;">{{ __('Welcome back') }}</h2>
            <p class="text-center text-[11px]" style="color:rgba(255,255,255,0.55); letter-spacing:2.5px; text-transform:uppercase;">{{ __('Customer Login') }}</p>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="block font-medium text-[12px]" style="color:rgba(255,255,255,0.62);" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="background:rgba(0,0,0,0.26); border-color:rgba(212,175,55,0.18); color:#FDFDFC;" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="block font-medium text-[12px]" style="color:rgba(255,255,255,0.62);" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" style="background:rgba(0,0,0,0.26); border-color:rgba(212,175,55,0.18); color:#FDFDFC;" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-[rgba(212,175,55,0.35)] text-[#D4AF37] shadow-sm focus:ring-[rgba(212,175,55,0.35)]" name="remember">
                <span class="ms-2 text-sm" style="color:rgba(255,255,255,0.62);">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-5 gap-4">
            @if (Route::has('customer.password.request'))
                <a class="text-[12px] underline underline-offset-4 rounded-md" style="color:rgba(255,255,255,0.62);" href="{{ route('customer.password.request') }}">{{ __('Forgot your password?') }}</a>
            @endif

            <x-primary-button>{{ __('Log in') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>


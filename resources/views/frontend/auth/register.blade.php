<x-guest-layout>
    <form method="POST" action="{{ route('customer.register') }}" class="mt-2">
        @csrf

        <div class="mb-6">
            <h2 class="text-center font-medium" style="color:#EDE3CE;">{{ __('Create your account') }}</h2>
            <p class="text-center text-[11px]" style="color:rgba(255,255,255,0.55); letter-spacing:2.5px; text-transform:uppercase;">{{ __('Join the Aurum collection') }}</p>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" class="block font-medium text-[12px]" style="color:rgba(255,255,255,0.62);" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" style="background:rgba(0,0,0,0.26); border-color:rgba(212,175,55,0.18); color:#FDFDFC;" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="block font-medium text-[12px]" style="color:rgba(255,255,255,0.62);" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" style="background:rgba(0,0,0,0.26); border-color:rgba(212,175,55,0.18); color:#FDFDFC;" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="block font-medium text-[12px]" style="color:rgba(255,255,255,0.62);" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" style="background:rgba(0,0,0,0.26); border-color:rgba(212,175,55,0.18); color:#FDFDFC;" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block font-medium text-[12px]" style="color:rgba(255,255,255,0.62);" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" style="background:rgba(0,0,0,0.26); border-color:rgba(212,175,55,0.18); color:#FDFDFC;" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-5 gap-4">
            <a class="text-[12px] underline underline-offset-4 rounded-md" style="color:rgba(255,255,255,0.62);" href="{{ route('customer.login') }}">{{ __('Already registered?') }}</a>
            <x-primary-button>{{ __('Register') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>


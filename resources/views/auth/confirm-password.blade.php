<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center" style="gap: 4px;">
                <img src="{{ asset('photo/LOGO.png') }}" alt="Votre Logo" style="width: 2cm; height: 2cm;" />
                <h1 style="font-size: 25px; margin: 0; font-weight: bold; line-height: 1;">
                    <span style="color: #111;">Stage</span><span style="color: rgb(196, 110, 236);">Connect</span>
                </h1>
            </div>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

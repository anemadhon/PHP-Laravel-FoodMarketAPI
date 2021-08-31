<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="flex flex-col space-y-5">
            <div class="flex flex-col space-y-4">

                <a
                    href="{{ route('sso.microsoft') }}"
                    class="flex items-center justify-center px-4 py-2 space-x-2 transition-colors duration-300 border border-red-800 rounded-md group hover:bg-red-800 focus:outline-none"
                >
                    <span>
                        <img class="w-5 h-5 text-red-800 fill-current group-hover:text-white" src="{{ asset('storage/office-365.svg') }}" alt="userss avatar" loading="lazy" />
                    </span>
                    <span class="text-sm font-medium text-red-800 group-hover:text-white">Office 365</span>
                </a>

                <a
                    href="{{ route('sso.google') }}"
                    class="flex items-center justify-center px-4 py-2 space-x-2 transition-colors duration-300 border border-red-500 rounded-md group hover:bg-red-500 focus:outline-none"
                >
                    <span>
                        <svg class="text-red-500 group-hover:text-white" width="24" height="24" fill="currentColor">
                            <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2.917 16.083c-2.258 0-4.083-1.825-4.083-4.083s1.825-4.083 4.083-4.083c1.103 0 2.024.402 2.735 1.067l-1.107 1.068c-.304-.292-.834-.63-1.628-.63-1.394 0-2.531 1.155-2.531 2.579 0 1.424 1.138 2.579 2.531 2.579 1.616 0 2.224-1.162 2.316-1.762h-2.316v-1.4h3.855c.036.204.064.408.064.677.001 2.332-1.563 3.988-3.919 3.988zm9.917-3.5h-1.75v1.75h-1.167v-1.75h-1.75v-1.166h1.75v-1.75h1.167v1.75h1.75v1.166z"/>
                        </svg>
                    </span>
                    <span class="text-sm font-medium text-red-500 group-hover:text-white">Google</span>
                </a>

                <a
                    href="{{ route('sso.github') }}"
                    class="flex items-center justify-center px-4 py-2 space-x-2 transition-colors duration-300 border border-gray-800 rounded-md group hover:bg-gray-800 focus:outline-none"
                >
                    <span>
                        <svg
                            class="w-5 h-5 text-gray-800 fill-current group-hover:text-white"
                            viewBox="0 0 16 16"
                            version="1.1"
                            aria-hidden="true"
                        >
                        <path
                            fill-rule="evenodd"
                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"
                            >
                        </path>
                        </svg>
                    </span>
                    <span class="text-sm font-medium text-gray-800 group-hover:text-white">Github</span>
                </a>

            </div>
        </div>

        <span class="flex items-center justify-center space-x-2 py-3">
            <span class="h-px bg-gray-400 w-14"></span>
            <span class="font-normal text-gray-500">or login with</span>
            <span class="h-px bg-gray-400 w-14"></span>
        </span>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="username" value="{{ __('Email or Username') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

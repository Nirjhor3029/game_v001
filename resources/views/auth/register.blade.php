<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo/>--}}
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('register') }}" x-data="{type: 3}">
            @csrf

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}"/>
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                             autofocus autocomplete="name"/>
            </div>

            <div class="mt-4" x-show="type == 3">
                <x-jet-label for="student_uid" value="{{ __('University ID') }}"/>
                <x-jet-input id="student_uid" class="block mt-1 w-full" type="text" name="student_uid"
                             :value="old('student_uid')"
                             autocomplete="student_uid"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}"/>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required/>
            </div>

            <div class="mt-4">
                <x-jet-label for="mobile_no" value="{{ __('Mobile No') }}"/>
                <x-jet-input id="mobile_no" class="block mt-1 w-full" type="mobile_no" name="mobile_no" :value="old('mobile_no')"
                             required/>
            </div>

            <div class="mt-4">
                <x-jet-label for="type" value="{{ __('Type') }}"/>
                <select id="type" class="form-select block mt-1 w-full" name="type" required="required" x-model="type">
                    @foreach ( Config::get('game.type') as $val)
                        <option value="{{ $val['id'] }}">{{ Str::ucfirst($val['name']) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}"/>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                             autocomplete="new-password"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                             name="password_confirmation" required autocomplete="new-password"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

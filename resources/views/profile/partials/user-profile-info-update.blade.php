<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Personal Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's personal information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <input type="hidden" name="billing_address" value="1">
        <div>
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $user_record->country)" required autofocus autocomplete="country" />
            <x-input-error class="mt-2" :messages="$errors->get('country')" />
        </div>
        <div>
            <x-input-label for="primary_address" :value="__('Address')" />
            <x-text-input id="primary_address" name="primary_address" type="text" class="mt-1 block w-full" :value="old('primary_address', $user_record->primary_address)" placeholder="Street Address" required autofocus autocomplete="primary_address" />
            <x-text-input id="secondary_address" name="secondary_address" type="text" class="mt-1 block w-full" :value="old('secondary_address', $user_record->secondary_address)" placeholder="Apartment, suite, unite ect (optinal)"/>
            <x-input-error class="mt-2" :messages="$errors->get('primary_address')" />
        </div>
        <div>
            <x-input-label for="town_or_city" :value="__('Town/City')" />
            <x-text-input id="town_or_city" name="town_or_city" type="text" class="mt-1 block w-full" :value="old('town_or_city', $user_record->town_or_city)" required autofocus autocomplete="town_or_city" />
            <x-input-error class="mt-2" :messages="$errors->get('town_or_city')" />
        </div>
        <div>
            <x-input-label for="country_or_state" :value="__('Country/State')" />
            <x-text-input id="country_or_state" name="country_or_state" type="text" class="mt-1 block w-full" :value="old('country_or_state', $user_record->country_or_state)" required autofocus autocomplete="country_or_state" />
            <x-input-error class="mt-2" :messages="$errors->get('country_or_state')" />
        </div>
        <div>
            <x-input-label for="postcode_or_zip" :value="__('Postcode/ZIP')" />
            <x-text-input id="postcode_or_zip" name="postcode_or_zip" type="text" class="mt-1 block w-full" :value="old('postcode_or_zip', $user_record->postcode_or_zip)" required autofocus autocomplete="postcode_or_zip" />
            <x-input-error class="mt-2" :messages="$errors->get('postcode_or_zip')" />
        </div>
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user_record->phone)" required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change Password') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Current Password -->
                        <div>
                            <x-label for="current_password" :value="__('Current Password')" />

                            <x-input id="current_password" class="block mt-1 w-full" type="password" name="current_password"
                                required autofocus />
                        </div>

                        <!-- New Password -->
                        <div class="mt-4">
                            <x-label for="new_password" :value="__('New Password')" />

                            <x-input id="new_password" class="block mt-1 w-full" type="password" name="new_password"
                                :value="old('new_password')" required autofocus />
                        </div>

                        <!-- New Password Confirmation -->
                        <div class="mt-4">
                            <x-label for="new_password_confirmation" :value="__('New Password Confirmation')" />

                            <x-input id="new_password_confirmation" class="block mt-1 w-full" type="password" name="new_password_confirmation"
                                :value="old('new_password_confirmation')" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

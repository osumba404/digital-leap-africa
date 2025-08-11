<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- THIS IS THE NEW GAMIFICATION SECTION --}}
            <div class="p-4 sm:p-8 bg-secondary-dark shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-white">Gamification Stats</h3>
                <div class="mt-4 text-5xl font-bold text-accent">
                    {{ Auth::user()->getTotalPoints() }}
                    <span class="text-xl font-medium text-gray-300 ml-2">Points</span>
                </div>
                <p class="mt-2 text-sm text-gray-400">Keep participating to earn more points and unlock badges!</p>
            </div>

            {{-- Existing Profile Information Section --}}
            <div class="p-4 sm:p-8 bg-primary-light shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Existing Update Password Section --}}
            <div class="p-4 sm:p-8 bg-primary-light shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Existing Delete Account Section --}}
            <div class="p-4 sm:p-8 bg-primary-light shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
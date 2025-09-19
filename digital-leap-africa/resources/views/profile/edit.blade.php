<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container d-flex flex-column gap-3">

            {{-- THIS IS THE NEW GAMIFICATION SECTION --}}
            <div class="p-3 bg-primary-light shadow rounded">
                <h3 class="h5 fw-medium text-white mb-2">Gamification Stats</h3>
                <div class="mt-1 display-5 fw-bold" style="color: var(--bs-info);">
                    {{ Auth::user()->getTotalPoints() }}
                    <span class="fs-6 fw-medium text-gray-300 ms-2">Points</span>
                </div>
                <p class="mt-2 small text-gray-400 mb-0">Keep participating to earn more points and unlock badges!</p>
            </div>

            {{-- Existing Profile Information Section --}}
            <div class="p-3 bg-primary-light shadow rounded">
                <div style="max-width: 40rem;">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Existing Update Password Section --}}
            <div class="p-3 bg-primary-light shadow rounded">
                <div style="max-width: 40rem;">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Existing Delete Account Section --}}
            <div class="p-3 bg-primary-light shadow rounded">
                <div style="max-width: 40rem;">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
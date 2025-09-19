<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="bg-primary-light shadow-sm rounded">
                <div class="p-4 text-gray-200">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">{{ __('Site Settings') }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container" style="max-width: 48rem;">
            @if(session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif
            <div class="bg-primary-light shadow-sm rounded">
                <div class="p-4 text-gray-200">
                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-column gap-3">
                            <!-- Site Name -->
                            <div>
                                <x-input-label for="site_name" value="Site Name" />
                                <x-text-input id="site_name" name="site_name" type="text" class="mt-1" :value="old('site_name', $settings['site_name'] ?? '')" required />
                            </div>
                            <!-- Footer Text -->
                            <div>
                                <x-input-label for="footer_text" value="Footer Text" />
                                <x-text-input id="footer_text" name="footer_text" type="text" class="mt-1" :value="old('footer_text', $settings['footer_text'] ?? '')" required />
                            </div>
                            <!-- Privacy Policy URL -->
                            <div>
                                <x-input-label for="privacy_policy_url" value="Privacy Policy URL" />
                                <x-text-input id="privacy_policy_url" name="privacy_policy_url" type="url" class="mt-1" :value="old('privacy_policy_url', $settings['privacy_policy_url'] ?? '')" required />
                            </div>
                            <!-- Terms of Service URL -->
                            <div>
                                <x-input-label for="terms_of_service_url" value="Terms of Service URL" />
                                <x-text-input id="terms_of_service_url" name="terms_of_service_url" type="url" class="mt-1" :value="old('terms_of_service_url', $settings['terms_of_service_url'] ?? '')" required />
                            </div>
                            <!-- Logo Upload -->
                            <div>
                                <x-input-label for="logo_url" value="Site Logo" />
                                <input id="logo_url" name="logo_url" type="file" class="form-control bg-primary-light text-gray-200 border-0 mt-1">
                                @if (!empty($settings['logo_url']))
                                    <div class="mt-3"><img src="{{ $settings['logo_url'] }}" alt="Current Logo" class="bg-white p-2 rounded" style="height: 48px; width: auto;"></div>
                                @endif
                            </div>
                            <div>
                                <x-primary-button>Save Settings</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
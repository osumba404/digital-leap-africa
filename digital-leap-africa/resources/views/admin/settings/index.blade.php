<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">{{ __('Site Settings') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6">{{ session('success') }}</div>
            @endif
            <div class="bg-primary-light shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <!-- Site Name -->
                            <div>
                                <x-input-label for="site_name" value="Site Name" />
                                <x-text-input id="site_name" name="site_name" type="text" class="mt-1 block w-full" :value="old('site_name', $settings['site_name'] ?? '')" required />
                            </div>
                            <!-- Footer Text -->
                            <div>
                                <x-input-label for="footer_text" value="Footer Text" />
                                <x-text-input id="footer_text" name="footer_text" type="text" class="mt-1 block w-full" :value="old('footer_text', $settings['footer_text'] ?? '')" required />
                            </div>
                            <!-- Privacy Policy URL -->
                            <div>
                                <x-input-label for="privacy_policy_url" value="Privacy Policy URL" />
                                <x-text-input id="privacy_policy_url" name="privacy_policy_url" type="url" class="mt-1 block w-full" :value="old('privacy_policy_url', $settings['privacy_policy_url'] ?? '')" required />
                            </div>
                            <!-- Terms of Service URL -->
                            <div>
                                <x-input-label for="terms_of_service_url" value="Terms of Service URL" />
                                <x-text-input id="terms_of_service_url" name="terms_of_service_url" type="url" class="mt-1 block w-full" :value="old('terms_of_service_url', $settings['terms_of_service_url'] ?? '')" required />
                            </div>
                            <!-- Logo Upload -->
                            <div>
                                <x-input-label for="logo_url" value="Site Logo" />
                                <input id="logo_url" name="logo_url" type="file" class="mt-1 block w-full text-gray-300">
                                @if (!empty($settings['logo_url']))
                                    <div class="mt-4"><img src="{{ $settings['logo_url'] }}" alt="Current Logo" class="h-12 w-auto bg-white p-2 rounded-md"></div>
                                @endif
                            </div>
                            <x-primary-button>Save Settings</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
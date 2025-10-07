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
                            <div>
                                <x-input-label for="site_name" value="Site Name" />
                                <x-text-input id="site_name" name="site_name" type="text" class="mt-1" :value="old('site_name', $settings['site_name'] ?? '')" required />
                            </div>
                            <div>
                                <x-input-label for="footer_text" value="Footer Text" />
                                <x-text-input id="footer_text" name="footer_text" type="text" class="mt-1" :value="old('footer_text', $settings['footer_text'] ?? '')" required />
                            </div>
                            <div>
                                <x-input-label for="privacy_policy_url" value="Privacy Policy URL" />
                                <x-text-input id="privacy_policy_url" name="privacy_policy_url" type="url" class="mt-1" :value="old('privacy_policy_url', $settings['privacy_policy_url'] ?? '')" required />
                            </div>
                            <div>
                                <x-input-label for="terms_of_service_url" value="Terms of Service URL" />
                                <x-text-input id="terms_of_service_url" name="terms_of_service_url" type="url" class="mt-1" :value="old('terms_of_service_url', $settings['terms_of_service_url'] ?? '')" required />
                            </div>
                            
                            <div class="form-group">
                                <x-input-label for="logo_url" value="Site Logo" />
                                <input id="logo_url" name="logo_url" type="file" class="form-control bg-primary-light text-gray-200 border-0 mt-1">
                                <x-input-error :messages="$errors->get('logo_url')" class="mt-1" />
                                
                                <div class="mt-3 border-top pt-3 border-secondary-subtle">
                                    {{-- Current Logo Display with Cache Busting --}}
                                    @if (!empty($settings['logo_url']))
                                        <p class="small text-muted mb-2">Current Logo:</p>
                                        <img 
                                            src="{{ $settings['logo_url'] }}?v={{ time() }}" 
                                            alt="Current Site Logo" 
                                            id="current_logo_display" 
                                            class="bg-white p-2 rounded shadow-sm" 
                                            style="height: 48px; width: auto; max-width: 100%;"
                                        >
                                    @else
                                        <p class="small text-muted mb-0">No logo currently uploaded. Select a file above to upload one.</p>
                                    @endif
                                    
                                    {{-- Live Preview for New File Selection (Hidden by default) --}}
                                    <div class="mt-3" id="new_logo_preview_container" style="display: none;">
                                        <p class="small text-warning mb-2">New Logo Preview (will be saved upon update):</p>
                                        <img src="#" alt="New Logo Preview" id="new_logo_preview" class="bg-dark p-2 rounded" style="height: 48px; width: auto; max-width: 100%;">
                                    </div>
                                </div>
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
    
    {{-- JavaScript for Live Image Preview --}}
    @push('scripts')
    <script>
        document.getElementById('logo_url').onchange = function (evt) {
            const [file] = evt.target.files;
            const newPreviewContainer = document.getElementById('new_logo_preview_container');
            const newPreviewImg = document.getElementById('new_logo_preview');
            
            if (file) {
                // Show the preview of the newly selected file
                newPreviewImg.src = URL.createObjectURL(file);
                newPreviewContainer.style.display = 'block';
                
                // Optionally hide the existing logo preview while a new one is selected
                document.getElementById('current_logo_display')?.style.opacity = '0.5';
            } else {
                // Hide the preview if the selection is cleared
                newPreviewContainer.style.display = 'none';
                document.getElementById('current_logo_display')?.style.opacity = '1';
            }
        }
    </script>
    @endpush
</x-app-layout>
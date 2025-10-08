@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Site Settings</h1>
    <p style="color: var(--cool-gray); margin-top: 0.5rem;">Configure your site's appearance, functionality, and integrations</p>
</div>

<div class="admin-form">
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        
        <!-- Basic Information -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('basic')">
                <h3><i class="fas fa-info-circle me-2"></i>Basic Information</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="basic">
                <div class="form-row">
                    <div class="form-group">
                        <label for="site_name" class="form-label">Site Name</label>
                        <input type="text" id="site_name" name="site_name" class="form-control" 
                               value="{{ old('site_name', $settings['site_name'] ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tagline" class="form-label">Tagline / Short Description</label>
                        <input type="text" id="tagline" name="tagline" class="form-control" 
                               value="{{ old('tagline', $settings['tagline'] ?? '') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact_email" class="form-label">Primary Contact Email</label>
                        <input type="email" id="contact_email" name="contact_email" class="form-control" 
                               value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" class="form-control" 
                               value="{{ old('phone_number', $settings['phone_number'] ?? '') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="address" class="form-label">Address / Location</label>
                        <textarea id="address" name="address" class="form-control" rows="2">{{ old('address', $settings['address'] ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="language" class="form-label">Language / Locale</label>
                        <select id="language" name="language" class="form-control">
                            <option value="en" {{ ($settings['language'] ?? 'en') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="sw" {{ ($settings['language'] ?? '') == 'sw' ? 'selected' : '' }}>Swahili</option>
                            <option value="fr" {{ ($settings['language'] ?? '') == 'fr' ? 'selected' : '' }}>French</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="footer_text" class="form-label">Footer Text</label>
                    <input type="text" id="footer_text" name="footer_text" class="form-control" 
                           value="{{ old('footer_text', $settings['footer_text'] ?? '') }}">
                </div>
            </div>
        </div>

        <!-- General Information -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('general')">
                <h3><i class="fas fa-cog me-2"></i>General Information</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="general">
                <div class="form-row">
                    <div class="form-group">
                        <label for="logo_url" class="form-label">Site Logo</label>
                        <input type="file" id="logo_url" name="logo_url" class="form-control" accept="image/*">
                        @if(!empty($settings['logo_url']))
                            <div style="margin-top: 0.5rem;">
                                <img src="{{ $settings['logo_url'] }}" alt="Current Logo" style="height: 40px; border-radius: 4px;">
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="favicon" class="form-label">Favicon</label>
                        <input type="file" id="favicon" name="favicon" class="form-control" accept="image/x-icon,image/png">
                    </div>
                </div>
            </div>
        </div>

        <!-- Homepage Hero (Carousel) -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('hero')">
                <h3><i class="fas fa-images me-2"></i>Homepage Hero (Carousel)</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="hero">
                @php
                    $existingSlides = [];
                    if (!empty($settings['hero_slides'])) {
                        $decoded = json_decode($settings['hero_slides'], true);
                        if (is_array($decoded)) { $existingSlides = $decoded; }
                    }
                    if (empty($existingSlides)) {
                        $existingSlides = [[
                            'enabled' => 1,
                            'image' => null,
                            'mini' => '', 'title' => '', 'sub' => '',
                            'cta1_label' => '', 'cta1_route' => '',
                            'cta2_label' => '', 'cta2_route' => '',
                        ]];
                    }
                @endphp

                <div id="hero-slides-list">
                    @foreach($existingSlides as $i => $s)
                        <div class="border rounded p-3 mb-3 hero-slide-item" data-index="{{ $i }}" style="border-color: rgba(255,255,255,0.1);">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="h6 m-0">Slide <span class="hero-slide-number">{{ $i + 1 }}</span></h4>
                                <button type="button" class="btn-outline btn-sm" onclick="removeHeroSlide(this)">Remove</button>
                            </div>

                            <div class="form-row">
                                <div class="form-group" style="align-self:center;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hero_slides[{{ $i }}][enabled]" value="1" {{ !empty($s['enabled']) ? 'checked' : '' }}>
                                        <label class="form-check-label">Enable this slide</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Slide Image</label>
                                    <input type="file" name="hero_slides[{{ $i }}][image]" class="form-control" accept="image/*">
                                    @if(!empty($s['image']))
                                        <input type="hidden" name="hero_slides[{{ $i }}][existing_image]" value="{{ $s['image'] }}">
                                        <div class="mt-2">
                                            <img src="{{ $s['image'] }}" alt="Slide {{ $i+1 }}" style="max-height:120px;border-radius:8px;background:#fff;">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mini Title</label>
                                    <input type="text" name="hero_slides[{{ $i }}][mini]" class="form-control" value="{{ $s['mini'] ?? '' }}" placeholder="e.g., New">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Main Title</label>
                                    <input type="text" name="hero_slides[{{ $i }}][title]" class="form-control" value="{{ $s['title'] ?? '' }}" placeholder="Main headline">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Sub Text</label>
                                <textarea name="hero_slides[{{ $i }}][sub]" class="form-control" rows="2" placeholder="Short supporting text">{{ $s['sub'] ?? '' }}</textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Primary CTA Label</label>
                                    <input type="text" name="hero_slides[{{ $i }}][cta1_label]" class="form-control" value="{{ $s['cta1_label'] ?? '' }}" placeholder="e.g., Get Started">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Primary CTA Route Name</label>
                                    <input type="text" name="hero_slides[{{ $i }}][cta1_route]" class="form-control" value="{{ $s['cta1_route'] ?? '' }}" placeholder="e.g., courses.index">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Secondary CTA Label</label>
                                    <input type="text" name="hero_slides[{{ $i }}][cta2_label]" class="form-control" value="{{ $s['cta2_label'] ?? '' }}" placeholder="e.g., Learn More">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Secondary CTA Route Name</label>
                                    <input type="text" name="hero_slides[{{ $i }}][cta2_route]" class="form-control" value="{{ $s['cta2_route'] ?? '' }}" placeholder="e.g., projects.index">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn-primary" onclick="addHeroSlide()"><i class="fas fa-plus me-1"></i>Add Slide</button>
                <div class="text-muted mt-2">
                    Enter Laravel route names for CTAs (e.g., <code>courses.index</code>). Leave CTA fields empty to hide buttons.
                </div>

                <template id="hero-slide-template">
                    <div class="border rounded p-3 mb-3 hero-slide-item" data-index="__IDX__" style="border-color: rgba(255,255,255,0.1);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="h6 m-0">Slide <span class="hero-slide-number"></span></h4>
                            <button type="button" class="btn-outline btn-sm" onclick="removeHeroSlide(this)">Remove</button>
                        </div>
                        <div class="form-row">
                            <div class="form-group" style="align-self:center;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hero_slides[__IDX__][enabled]" value="1" checked>
                                    <label class="form-check-label">Enable this slide</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Slide Image</label>
                                <input type="file" name="hero_slides[__IDX__][image]" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Mini Title</label>
                                <input type="text" name="hero_slides[__IDX__][mini]" class="form-control" placeholder="e.g., New">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Main Title</label>
                                <input type="text" name="hero_slides[__IDX__][title]" class="form-control" placeholder="Main headline">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sub Text</label>
                            <textarea name="hero_slides[__IDX__][sub]" class="form-control" rows="2" placeholder="Short supporting text"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Primary CTA Label</label>
                                <input type="text" name="hero_slides[__IDX__][cta1_label]" class="form-control" placeholder="e.g., Get Started">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Primary CTA Route Name</label>
                                <input type="text" name="hero_slides[__IDX__][cta1_route]" class="form-control" placeholder="e.g., courses.index">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Secondary CTA Label</label>
                                <input type="text" name="hero_slides[__IDX__][cta2_label]" class="form-control" placeholder="e.g., Learn More">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Secondary CTA Route Name</label>
                                <input type="text" name="hero_slides[__IDX__][cta2_route]" class="form-control" placeholder="e.g., projects.index">
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Appearance -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('appearance')">
                <h3><i class="fas fa-palette me-2"></i>Appearance</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="appearance">
                <div class="form-row">
                    <div class="form-group">
                        <label for="primary_color" class="form-label">Primary Theme Color</label>
                        <input type="color" id="primary_color" name="primary_color" class="form-control" 
                               value="{{ old('primary_color', $settings['primary_color'] ?? '#2E78C5') }}">
                    </div>
                    <div class="form-group">
                        <label for="secondary_color" class="form-label">Secondary Color</label>
                        <input type="color" id="secondary_color" name="secondary_color" class="form-control" 
                               value="{{ old('secondary_color', $settings['secondary_color'] ?? '#00C9FF') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="font_family" class="form-label">Font Family</label>
                        <select id="font_family" name="font_family" class="form-control">
                            <option value="Inter" {{ ($settings['font_family'] ?? 'Inter') == 'Inter' ? 'selected' : '' }}>Inter</option>
                            <option value="Roboto" {{ ($settings['font_family'] ?? '') == 'Roboto' ? 'selected' : '' }}>Roboto</option>
                            <option value="Open Sans" {{ ($settings['font_family'] ?? '') == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                            <option value="Poppins" {{ ($settings['font_family'] ?? '') == 'Poppins' ? 'selected' : '' }}>Poppins</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="background_mode" class="form-label">Background Mode</label>
                        <select id="background_mode" name="background_mode" class="form-control">
                            <option value="dark" {{ ($settings['background_mode'] ?? 'dark') == 'dark' ? 'selected' : '' }}>Dark</option>
                            <option value="light" {{ ($settings['background_mode'] ?? '') == 'light' ? 'selected' : '' }}>Light</option>
                            <option value="auto" {{ ($settings['background_mode'] ?? '') == 'auto' ? 'selected' : '' }}>Auto</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="hero_banner" class="form-label">Hero Banner / Header Image</label>
                    <input type="file" id="hero_banner" name="hero_banner" class="form-control" accept="image/*">
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('social')">
                <h3><i class="fas fa-share-alt me-2"></i>Social Media Links</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="social">
                <div class="form-row">
                    <div class="form-group">
                        <label for="facebook_url" class="form-label"><i class="fab fa-facebook me-1"></i>Facebook</label>
                        <input type="url" id="facebook_url" name="facebook_url" class="form-control" 
                               value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="instagram_url" class="form-label"><i class="fab fa-instagram me-1"></i>Instagram</label>
                        <input type="url" id="instagram_url" name="instagram_url" class="form-control" 
                               value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="linkedin_url" class="form-label"><i class="fab fa-linkedin me-1"></i>LinkedIn</label>
                        <input type="url" id="linkedin_url" name="linkedin_url" class="form-control" 
                               value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="youtube_url" class="form-label"><i class="fab fa-youtube me-1"></i>YouTube</label>
                        <input type="url" id="youtube_url" name="youtube_url" class="form-control" 
                               value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="twitter_url" class="form-label"><i class="fab fa-twitter me-1"></i>Twitter/X</label>
                        <input type="url" id="twitter_url" name="twitter_url" class="form-control" 
                               value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="tiktok_url" class="form-label"><i class="fab fa-tiktok me-1"></i>TikTok</label>
                        <input type="url" id="tiktok_url" name="tiktok_url" class="form-control" 
                               value="{{ old('tiktok_url', $settings['tiktok_url'] ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO & Metadata -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('seo')">
                <h3><i class="fas fa-search me-2"></i>SEO & Metadata</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="seo">
                <div class="form-group">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" class="form-control" 
                           value="{{ old('meta_title', $settings['meta_title'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" class="form-control" rows="3">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="keywords" class="form-label">Keywords (comma-separated)</label>
                    <input type="text" id="keywords" name="keywords" class="form-control" 
                           value="{{ old('keywords', $settings['keywords'] ?? '') }}">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="opengraph_image" class="form-label">OpenGraph Image</label>
                        <input type="file" id="opengraph_image" name="opengraph_image" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="google_analytics_id" class="form-label">Google Analytics ID</label>
                        <input type="text" id="google_analytics_id" name="google_analytics_id" class="form-control" 
                               value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Security & Access -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('security')">
                <h3><i class="fas fa-shield-alt me-2"></i>Security & Access</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="security">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Maintenance Mode</label>
                        <div class="toggle-switch">
                            <input type="checkbox" id="maintenance_mode" name="maintenance_mode" value="1" 
                                   {{ ($settings['maintenance_mode'] ?? false) ? 'checked' : '' }}>
                            <label for="maintenance_mode" class="toggle-label">Enable Maintenance Mode</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Public Registration</label>
                        <div class="toggle-switch">
                            <input type="checkbox" id="allow_registration" name="allow_registration" value="1" 
                                   {{ ($settings['allow_registration'] ?? true) ? 'checked' : '' }}>
                            <label for="allow_registration" class="toggle-label">Allow Public Registration</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="admin_notification_email" class="form-label">Admin Notification Email</label>
                        <input type="email" id="admin_notification_email" name="admin_notification_email" class="form-control" 
                               value="{{ old('admin_notification_email', $settings['admin_notification_email'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="cookie_consent_message" class="form-label">Cookie Consent Message</label>
                        <textarea id="cookie_consent_message" name="cookie_consent_message" class="form-control" rows="2">{{ old('cookie_consent_message', $settings['cookie_consent_message'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Legal Pages -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('legal')">
                <h3><i class="fas fa-gavel me-2"></i>Legal Pages</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="legal">
                <div class="form-row">
                    <div class="form-group">
                        <label for="privacy_policy_url" class="form-label">Privacy Policy URL</label>
                        <input type="url" id="privacy_policy_url" name="privacy_policy_url" class="form-control" 
                               value="{{ old('privacy_policy_url', $settings['privacy_policy_url'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="terms_of_service_url" class="form-label">Terms of Service URL</label>
                        <input type="url" id="terms_of_service_url" name="terms_of_service_url" class="form-control" 
                               value="{{ old('terms_of_service_url', $settings['terms_of_service_url'] ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Integrations & APIs -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('integrations')">
                <h3><i class="fas fa-plug me-2"></i>Integrations & APIs</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="integrations">
                <div class="form-row">
                    <div class="form-group">
                        <label for="smtp_host" class="form-label">SMTP Host</label>
                        <input type="text" id="smtp_host" name="smtp_host" class="form-control" 
                               value="{{ old('smtp_host', $settings['smtp_host'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="smtp_port" class="form-label">SMTP Port</label>
                        <input type="number" id="smtp_port" name="smtp_port" class="form-control" 
                               value="{{ old('smtp_port', $settings['smtp_port'] ?? '') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="mpesa_consumer_key" class="form-label">M-Pesa Consumer Key</label>
                        <input type="text" id="mpesa_consumer_key" name="mpesa_consumer_key" class="form-control" 
                               value="{{ old('mpesa_consumer_key', $settings['mpesa_consumer_key'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="mpesa_consumer_secret" class="form-label">M-Pesa Consumer Secret</label>
                        <input type="password" id="mpesa_consumer_secret" name="mpesa_consumer_secret" class="form-control" 
                               value="{{ old('mpesa_consumer_secret', $settings['mpesa_consumer_secret'] ?? '') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Social Login Options</label>
                        <div class="toggle-switch">
                            <input type="checkbox" id="google_login" name="google_login" value="1" 
                                   {{ ($settings['google_login'] ?? false) ? 'checked' : '' }}>
                            <label for="google_login" class="toggle-label">Enable Google Login</label>
                        </div>
                        <div class="toggle-switch">
                            <input type="checkbox" id="github_login" name="github_login" value="1" 
                                   {{ ($settings['github_login'] ?? false) ? 'checked' : '' }}>
                            <label for="github_login" class="toggle-label">Enable GitHub Login</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="webhook_url" class="form-label">Webhook / API Endpoint URL</label>
                        <input type="url" id="webhook_url" name="webhook_url" class="form-control" 
                               value="{{ old('webhook_url', $settings['webhook_url'] ?? '') }}">
                    </div>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 2rem; text-align: center;">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save me-2"></i>Save All Settings
            </button>
        </div>
    </form>
</div>

@push('styles')
<style>
.settings-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.settings-card-header {
    padding: 1.25rem 1.5rem;
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
}

.settings-card-header:hover {
    background: rgba(255, 255, 255, 0.08);
}

.settings-card-header h3 {
    margin: 0;
    color: var(--diamond-white);
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.toggle-icon {
    color: var(--cyan-accent);
    transition: transform 0.3s ease;
}

.settings-card-header.active .toggle-icon {
    transform: rotate(180deg);
}

.settings-card-content {
    padding: 1.5rem;
    display: none;
}

.settings-card-content.active {
    display: block;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.toggle-switch {
    margin-bottom: 0.75rem;
}

.toggle-switch input[type="checkbox"] {
    display: none;
}

.toggle-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    color: var(--diamond-white);
    font-weight: 500;
    position: relative;
    padding-left: 3rem;
}

.toggle-label::before {
    content: '';
    position: absolute;
    left: 0;
    width: 2.5rem;
    height: 1.25rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 1rem;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.toggle-label::after {
    content: '';
    position: absolute;
    left: 0.125rem;
    top: 0.125rem;
    width: 1rem;
    height: 1rem;
    background: var(--diamond-white);
    border-radius: 50%;
    transition: all 0.3s ease;
}

input[type="checkbox"]:checked + .toggle-label::before {
    background: var(--cyan-accent);
}

input[type="checkbox"]:checked + .toggle-label::after {
    transform: translateX(1.25rem);
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .settings-card-header {
        padding: 1rem;
    }
    
    .settings-card-content {
        padding: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function toggleSection(sectionId) {
    const content = document.getElementById(sectionId);
    const header = content.previousElementSibling;
    
    if (content.classList.contains('active')) {
        content.classList.remove('active');
        header.classList.remove('active');
    } else {
        content.classList.add('active');
        header.classList.add('active');
    }
}

// Open first section by default
document.addEventListener('DOMContentLoaded', function() {
    toggleSection('basic');
});



function addHeroSlide() {
    const list = document.getElementById('hero-slides-list');
    const tmpl = document.getElementById('hero-slide-template').innerHTML;
    const idx = list.querySelectorAll('.hero-slide-item').length;
    const html = tmpl.replaceAll('__IDX__', idx);
    const wrapper = document.createElement('div');
    wrapper.innerHTML = html.trim();
    const node = wrapper.firstChild;
    list.appendChild(node);
    renumberHeroSlides();
}

function removeHeroSlide(btn) {
    const item = btn.closest('.hero-slide-item');
    if (!item) return;
    item.parentNode.removeChild(item);
    renumberHeroSlides();
}

function renumberHeroSlides() {
    const items = document.querySelectorAll('#hero-slides-list .hero-slide-item');
    items.forEach((el, i) => {
        el.dataset.index = i;
        const num = el.querySelector('.hero-slide-number');
        if (num) num.textContent = (i + 1);
        el.querySelectorAll('[name]').forEach(inp => {
            inp.name = inp.name.replace(/hero_slides\[[0-9]+\]/, `hero_slides[${i}]`);
        });
    });
}
</script>
@endpush
@endsection
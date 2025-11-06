<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\SettingsHelper;

class SiteSettingController extends Controller
{
    public function index()
    {
        // Fetch all settings and turn them into a simple key => value array
        $settings = SiteSetting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        
        $validated = $request->validate([
            // Basic Information
            'site_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'language' => 'nullable|string|max:10',
            'footer_text' => 'nullable|string',
            
            // Files
            'logo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg|max:5120',
            'hero_banner' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'opengraph_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            // Unlimited Hero Slides (array)
            'hero_slides' => 'required|array|min:1',
            'hero_slides.*.enabled' => 'nullable|boolean',
            'hero_slides.*.mini' => 'nullable|string|max:120',
            'hero_slides.*.title' => 'nullable|string|max:180',
            'hero_slides.*.sub' => 'nullable|string|max:500',
            'hero_slides.*.cta1_label' => 'nullable|string|max:60',
            'hero_slides.*.cta1_route' => 'nullable|string|max:120',
            'hero_slides.*.cta2_label' => 'nullable|string|max:60',
            'hero_slides.*.cta2_route' => 'nullable|string|max:120',
            'hero_slides.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'hero_slides.*.existing_image' => 'nullable|string',
            
            // Appearance
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'font_family' => 'nullable|string|max:50',
            'background_mode' => 'nullable|string|in:light,dark,auto',
            
            // Social Media
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            
            // SEO
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'keywords' => 'nullable|string|max:500',
            'google_analytics_id' => 'nullable|string|max:50',
            
            // Security
            'maintenance_mode' => 'nullable|boolean',
            'allow_registration' => 'nullable|boolean',
            'admin_notification_email' => 'nullable|email',
            'cookie_consent_message' => 'nullable|string|max:500',
            
            // Legal
            'privacy_policy_url' => 'nullable|string',
            'terms_of_service_url' => 'nullable|string',
            
            // Integrations
            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|integer|min:1|max:65535',
            'mpesa_consumer_key' => 'nullable|string|max:255',
            'mpesa_consumer_secret' => 'nullable|string|max:255',
            'google_login' => 'nullable|boolean',
            'github_login' => 'nullable|boolean',
            'webhook_url' => 'nullable|url',
        ]);

        // Handle single-file settings uploads
        $fileFields = ['logo_url', 'favicon', 'hero_banner', 'opengraph_image'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $setting = SiteSetting::where('key', $field)->first();
                if ($setting && $setting->value) {
                    Storage::delete(str_replace('/storage', 'public', $setting->value));
                }
                $path = $request->file($field)->store('public/site');
                SiteSetting::updateOrCreate(['key' => $field], ['value' => Storage::url($path)]);
                unset($validated[$field]);
            }
        }

        // Handle Hero Slides (array + per-slide file uploads)
        $incomingSlides = $request->input('hero_slides', []);
        $normalizedSlides = [];
        foreach ($incomingSlides as $idx => $slide) {
            $enabled = isset($slide['enabled']) && (int)$slide['enabled'] === 1 ? 1 : 0;

            // carry existing image if any, can be replaced by new upload
            $imageUrl = $slide['existing_image'] ?? null;
            if ($request->hasFile("hero_slides.$idx.image")) {
                if (!empty($imageUrl)) {
                    Storage::delete(str_replace('/storage', 'public', $imageUrl));
                }
                $stored = $request->file("hero_slides.$idx.image")->store('public/site');
                $imageUrl = Storage::url($stored);
            }

            $normalizedSlides[] = [
                'enabled' => $enabled,
                'image' => $imageUrl,
                'mini' => $slide['mini'] ?? '',
                'title' => $slide['title'] ?? '',
                'sub' => $slide['sub'] ?? '',
                'cta1_label' => $slide['cta1_label'] ?? '',
                'cta1_route' => $slide['cta1_route'] ?? '',
                'cta2_label' => $slide['cta2_label'] ?? '',
                'cta2_route' => $slide['cta2_route'] ?? '',
            ];
        }
        if (empty($normalizedSlides)) {
            $normalizedSlides = [[
                'enabled' => 1, 'image' => null, 'mini' => '', 'title' => '', 'sub' => '',
                'cta1_label' => '', 'cta1_route' => '', 'cta2_label' => '', 'cta2_route' => '',
            ]];
        }
        SiteSetting::updateOrCreate(['key' => 'hero_slides'], ['value' => json_encode($normalizedSlides)]);
        unset($validated['hero_slides']);
 
        // Handle boolean fields
        $booleanFields = ['maintenance_mode', 'allow_registration', 'google_login', 'github_login'];
        foreach ($booleanFields as $field) {
            $validated[$field] = $request->has($field) ? 1 : 0;
        }
 
        // Update all other (scalar) settings
        foreach ($validated as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Clear settings cache
        SettingsHelper::clearCache();

        return redirect()->route('admin.settings.index')->with('success', 'Site settings updated successfully.');
    }
}

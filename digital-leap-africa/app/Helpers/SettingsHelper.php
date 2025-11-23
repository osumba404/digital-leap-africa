<?php

namespace App\Helpers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingsHelper
{
    // Image fields that need URL conversion
    private static $imageFields = [
        'logo_url',
        'favicon',
        'hero_banner',
        'opengraph_image',
    ];

    public static function get($key, $default = null)
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = SiteSetting::where('key', $key)->first();
            $value = $setting ? $setting->value : $default;
            
            // Convert storage paths to full URLs for image fields
            if (in_array($key, self::$imageFields) && $value && !preg_match('/^https?:\/\//i', $value)) {
                return Storage::disk('public')->url($value);
            }
            
            return $value;
        });
    }

    public static function all()
    {
        return Cache::remember('all_settings', 3600, function () {
            $settings = SiteSetting::pluck('value', 'key')->all();
            
            // Convert storage paths to full URLs for image fields
            foreach (self::$imageFields as $field) {
                if (isset($settings[$field]) && $settings[$field] && !preg_match('/^https?:\/\//i', $settings[$field])) {
                    $settings[$field] = Storage::disk('public')->url($settings[$field]);
                }
            }
            
            // Handle hero_slides array
            if (isset($settings['hero_slides'])) {
                $slides = is_string($settings['hero_slides']) ? json_decode($settings['hero_slides'], true) : $settings['hero_slides'];
                if (is_array($slides)) {
                    foreach ($slides as &$slide) {
                        if (!empty($slide['image']) && !preg_match('/^https?:\/\//i', $slide['image'])) {
                            $slide['image'] = Storage::disk('public')->url($slide['image']);
                        }
                    }
                    $settings['hero_slides'] = $slides;
                }
            }
            
            return $settings;
        });
    }

    public static function clearCache()
    {
        Cache::forget('all_settings');
        $keys = SiteSetting::pluck('key');
        foreach ($keys as $key) {
            Cache::forget("setting_{$key}");
        }
    }
}
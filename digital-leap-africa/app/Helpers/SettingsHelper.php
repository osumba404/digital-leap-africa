<?php

namespace App\Helpers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SettingsHelper
{
    public static function get($key, $default = null)
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = SiteSetting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function all()
    {
        return Cache::remember('all_settings', 3600, function () {
            return SiteSetting::pluck('value', 'key')->all();
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
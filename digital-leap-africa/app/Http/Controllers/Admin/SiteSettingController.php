<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'site_name' => 'required|string|max:255',
            'logo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'footer_text' => 'required|string',
            'privacy_policy_url' => 'required|url',
            'terms_of_service_url' => 'required|url',
        ]);

        // Loop through all validated data and update or create the setting
        foreach ($validated as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Handle the file upload for the logo
        if ($request->hasFile('logo_url')) {
            $logoSetting = SiteSetting::where('key', 'logo_url')->first();
            // Delete the old logo if it exists
            if ($logoSetting && $logoSetting->value) {
                Storage::delete(str_replace('/storage', 'public', $logoSetting->value));
            }
            $path = $request->file('logo_url')->store('public/logos');
            // Update the database record with the new public URL
            SiteSetting::updateOrCreate(['key' => 'logo_url'], ['value' => Storage::url($path)]);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Site settings updated successfully.');
    }
}
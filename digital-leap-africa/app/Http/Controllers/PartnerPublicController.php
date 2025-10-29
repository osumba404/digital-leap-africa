<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PartnerPublicController extends Controller
{
    public function apply(): View
    {
        return view('partners.apply');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'website_url' => ['nullable','url','max:255'],
            'logo' => ['required','image','mimes:jpg,jpeg,png,webp,svg','max:2048'],
        ]);

        $path = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = Str::random(16).'_'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('partners', $filename, 'public');
        }

        Partner::create([
            'name' => $data['name'],
            'website_url' => $data['website_url'] ?? null,
            'logo_path' => $path,
            'order' => 0,
            'is_active' => 0,
        ]);

        return redirect()->route('home')->with('success', 'Thank you. Your partner application has been submitted and is pending approval.');
    }
}

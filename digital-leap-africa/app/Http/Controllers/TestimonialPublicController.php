<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TestimonialPublicController extends Controller
{
    public function create(): View
    {
        return view('testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'quote' => ['required','string','min:20','max:1500'],
            'avatar' => ['nullable','image','mimes:jpg,jpeg,png,webp,svg','max:2048'],
        ]);

        $path = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = Str::random(16).'_'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('testimonials', $filename, 'public');
        }

        $user = Auth::user();

        Testimonial::create([
            'user_id' => $user?->id,
            'name' => $user?->name,
            'avatar_path' => $path,
            'quote' => $data['quote'],
            'is_active' => false,
        ]);

        return redirect()->route('profile.testimonials')
            ->with('success', 'Thank you! Your testimonial was submitted and is pending review.');
    }

    public function myTestimonials(): View
    {
        $user = Auth::user();
        $testimonials = Testimonial::where('user_id', $user->id)
            ->latest()->get();
        return view('profile.testimonials', compact('testimonials'));
    }
}

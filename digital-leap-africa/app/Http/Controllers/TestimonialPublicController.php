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
    public function index(Request $request): View
    {
        $sort = $request->get('sort', 'latest');
        $filter = $request->get('filter', 'all');
        
        $query = Testimonial::query()->with('user');
        
        // Filter by user's own testimonials
        if ($filter === 'mine' && Auth::check()) {
            $query->where('user_id', Auth::id());
        } else {
            // Show only approved testimonials for 'all' view
            $query->where('is_active', true);
        }
        
        // Sort options
        if ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }
        
        $testimonials = $query->paginate(12)->appends(['sort' => $sort, 'filter' => $filter]);
        
        return view('testimonials.index', compact('testimonials', 'sort', 'filter'));
    }

    public function create(): View
    {
        return view('testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'quote' => ['required','string','min:20','max:1500'],
        ]);

        $user = Auth::user();

        Testimonial::create([
            'user_id' => $user?->id,
            'name' => $user?->name,
            'avatar_path' => $user?->profile_photo ?? null,
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

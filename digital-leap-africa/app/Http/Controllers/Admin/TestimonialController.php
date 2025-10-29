<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->get('status', 'pending');
        $query = Testimonial::query()->latest();
        if ($status === 'approved') {
            $query->where('is_active', true);
        } elseif ($status === 'pending') {
            $query->where('is_active', false);
        }
        $testimonials = $query->paginate(20)->appends(['status' => $status]);
        return view('admin.testimonials.index', compact('testimonials', 'status'));
    }

    public function approve(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_active' => true]);
        return back()->with('success', 'Testimonial approved.');
    }

    public function unpublish(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_active' => false]);
        return back()->with('success', 'Testimonial unpublished.');
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->validate([
            'quote' => ['required', 'string', 'min:10', 'max:1500'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);
        $testimonial->update($data);
        return back()->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted.');
    }
}

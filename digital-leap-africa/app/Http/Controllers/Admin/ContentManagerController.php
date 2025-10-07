<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\TeamMember;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentManagerController extends Controller
{
    // About Sections Management
    public function aboutSections()
    {
        $sections = AboutSection::ordered()->get();
        return view('admin.content.about-sections', compact('sections'));
    }

    public function updateAboutSection(Request $request, $id)
    {
        $section = AboutSection::findOrFail($id);
        
        $validated = $request->validate([
            'mini_title' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($section->image_path) {
                Storage::delete('public/' . $section->image_path);
            }
            $path = $request->file('image')->store('about', 'public');
            $validated['image_path'] = $path;
        }

        $section->update($validated);
        
        return back()->with('success', 'Section updated successfully!');
    }

    // Team Members Management
    public function teamMembers()
    {
        $teamMembers = TeamMember::ordered()->get();
        return view('admin.content.team-members', compact('teamMembers'));
    }

    public function storeTeamMember(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:team_members,email',
            'role' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
            $validated['image_path'] = $path;
        }

        TeamMember::create($validated);
        
        return back()->with('success', 'Team member added successfully!');
    }

    public function updateTeamMember(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:team_members,email,' . $id,
            'role' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($member->image_path) {
                Storage::delete('public/' . $member->image_path);
            }
            $path = $request->file('image')->store('team', 'public');
            $validated['image_path'] = $path;
        }

        $member->update($validated);
        
        return back()->with('success', 'Team member updated successfully!');
    }

    public function deleteTeamMember($id)
    {
        $member = TeamMember::findOrFail($id);
        
        // Delete image if exists
        if ($member->image_path) {
            Storage::delete('public/' . $member->image_path);
        }
        
        $member->delete();
        
        return back()->with('success', 'Team member deleted successfully!');
    }

    // Partners Management
    public function partners()
    {
        $partners = Partner::ordered()->get();
        return view('admin.content.partners', compact('partners'));
    }

    public function storePartner(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website_url' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partners', 'public');
            $validated['logo_path'] = $path;
        }

        Partner::create($validated);
        
        return back()->with('success', 'Partner added successfully!');
    }

    public function updatePartner(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website_url' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($partner->logo_path) {
                Storage::delete('public/' . $partner->logo_path);
            }
            $path = $request->file('logo')->store('partners', 'public');
            $validated['logo_path'] = $path;
        }

        $partner->update($validated);
        
        return back()->with('success', 'Partner updated successfully!');
    }

    public function deletePartner($id)
    {
        $partner = Partner::findOrFail($id);
        
        // Delete logo if exists
        if ($partner->logo_path) {
            Storage::delete('public/' . $partner->logo_path);
        }
        
        $partner->delete();
        
        return back()->with('success', 'Partner deleted successfully!');
    }
}

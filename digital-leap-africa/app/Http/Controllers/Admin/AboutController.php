<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\TeamMember;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    // About Sections Management
    public function index()
    {
        $sections = AboutSection::ordered()->get();
        $teamMembers = TeamMember::ordered()->get();
        $partners = Partner::ordered()->get();

        return view('admin.about.index', compact('sections', 'teamMembers', 'partners'));
    }

    // About Sections
    public function createSection()
    {
        return view('admin.about.sections.create');
    }

    public function storeSection(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'section_type' => 'required|in:about,mission,vision,values',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        AboutSection::create($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'Section created successfully.');
    }

    public function editSection(AboutSection $section)
    {
        return view('admin.about.sections.edit', compact('section'));
    }

    public function updateSection(Request $request, AboutSection $section)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'section_type' => 'required|in:about,mission,vision,values',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $section->update($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'Section updated successfully.');
    }

    public function destroySection(AboutSection $section)
    {
        $section->delete();
        return back()->with('success', 'Section deleted successfully.');
    }

    // Team Members
    public function createTeamMember()
    {
        return view('admin.about.team.create');
    }

    public function storeTeamMember(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/team');
            $validated['photo_path'] = $path;
        }

        TeamMember::create($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'Team member added successfully.');
    }

    public function editTeamMember(TeamMember $teamMember)
    {
        return view('admin.about.team.edit', compact('teamMember'));
    }

    public function updateTeamMember(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($teamMember->photo_path) {
                Storage::delete($teamMember->photo_path);
            }
            $path = $request->file('photo')->store('public/team');
            $validated['photo_path'] = $path;
        }

        $teamMember->update($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroyTeamMember(TeamMember $teamMember)
    {
        if ($teamMember->photo_path) {
            Storage::delete($teamMember->photo_path);
        }
        $teamMember->delete();
        return back()->with('success', 'Team member deleted successfully.');
    }

    // Partners
    public function createPartner()
    {
        return view('admin.about.partners.create');
    }

    public function storePartner(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website_url' => 'nullable|url',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $path = $request->file('logo')->store('public/partners');
        $validated['logo_path'] = $path;

        Partner::create($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'Partner added successfully.');
    }

    public function editPartner(Partner $partner)
    {
        return view('admin.about.partners.edit', compact('partner'));
    }

    public function updatePartner(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website_url' => 'nullable|url',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($partner->logo_path) {
                Storage::delete($partner->logo_path);
            }
            $path = $request->file('logo')->store('public/partners');
            $validated['logo_path'] = $path;
        }

        $partner->update($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'Partner updated successfully.');
    }

    public function destroyPartner(Partner $partner)
    {
        if ($partner->logo_path) {
            Storage::delete($partner->logo_path);
        }
        $partner->delete();
        return back()->with('success', 'Partner deleted successfully.');
    }
}
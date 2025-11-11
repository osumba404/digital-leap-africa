<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointRule;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PointRuleController extends Controller
{
    public function index(): View
    {
        $rules = PointRule::latest()->paginate(10);
        return view('admin.point-rules.index', compact('rules'));
    }

    public function create(): View
    {
        return view('admin.point-rules.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'action' => 'required|string|max:255',
            'points' => 'required|integer',
            'description' => 'nullable|string',
            'active' => 'boolean'
        ]);

        PointRule::create($validated);

        return redirect()->route('admin.point-rules.index')
            ->with('success', 'Point rule created successfully.');
    }

    public function edit(PointRule $pointRule): View
    {
        return view('admin.point-rules.edit', compact('pointRule'));
    }

    public function update(Request $request, PointRule $pointRule): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'action' => 'required|string|max:255',
            'points' => 'required|integer',
            'description' => 'nullable|string',
            'active' => 'boolean'
        ]);

        $pointRule->update($validated);

        return redirect()->route('admin.point-rules.index')
            ->with('success', 'Point rule updated successfully.');
    }

    public function destroy(PointRule $pointRule): RedirectResponse
    {
        $pointRule->delete();

        return redirect()->route('admin.point-rules.index')
            ->with('success', 'Point rule deleted successfully.');
    }
}
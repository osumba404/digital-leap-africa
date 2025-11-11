<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertificateTemplate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CertificateTemplateController extends Controller
{
    public function index(): View
    {
        $templates = CertificateTemplate::latest()->paginate(10);
        return view('admin.certificate-templates.index', compact('templates'));
    }

    public function create(): View
    {
        return view('admin.certificate-templates.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'background_color' => 'required|string|max:7',
            'text_color' => 'required|string|max:7',
            'signature_image' => 'nullable|image|max:2048',
            'logo_image' => 'nullable|image|max:2048',
            'active' => 'boolean'
        ]);

        if ($request->hasFile('signature_image')) {
            $validated['signature_image'] = $request->file('signature_image')->store('certificates', 'public');
        }

        if ($request->hasFile('logo_image')) {
            $validated['logo_image'] = $request->file('logo_image')->store('certificates', 'public');
        }

        CertificateTemplate::create($validated);

        return redirect()->route('admin.certificate-templates.index')
            ->with('success', 'Certificate template created successfully.');
    }

    public function show(CertificateTemplate $certificateTemplate): View
    {
        return view('admin.certificate-templates.show', compact('certificateTemplate'));
    }

    public function edit(CertificateTemplate $certificateTemplate): View
    {
        return view('admin.certificate-templates.edit', compact('certificateTemplate'));
    }

    public function update(Request $request, CertificateTemplate $certificateTemplate): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'background_color' => 'required|string|max:7',
            'text_color' => 'required|string|max:7',
            'signature_image' => 'nullable|image|max:2048',
            'logo_image' => 'nullable|image|max:2048',
            'active' => 'boolean'
        ]);

        if ($request->hasFile('signature_image')) {
            if ($certificateTemplate->signature_image) {
                Storage::disk('public')->delete($certificateTemplate->signature_image);
            }
            $validated['signature_image'] = $request->file('signature_image')->store('certificates', 'public');
        }

        if ($request->hasFile('logo_image')) {
            if ($certificateTemplate->logo_image) {
                Storage::disk('public')->delete($certificateTemplate->logo_image);
            }
            $validated['logo_image'] = $request->file('logo_image')->store('certificates', 'public');
        }

        $certificateTemplate->update($validated);

        return redirect()->route('admin.certificate-templates.index')
            ->with('success', 'Certificate template updated successfully.');
    }

    public function destroy(CertificateTemplate $certificateTemplate): RedirectResponse
    {
        if ($certificateTemplate->signature_image) {
            Storage::disk('public')->delete($certificateTemplate->signature_image);
        }

        if ($certificateTemplate->logo_image) {
            Storage::disk('public')->delete($certificateTemplate->logo_image);
        }

        $certificateTemplate->delete();

        return redirect()->route('admin.certificate-templates.index')
            ->with('success', 'Certificate template deleted successfully.');
    }
}
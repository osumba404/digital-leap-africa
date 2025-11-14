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
            $file = $request->file('signature_image');
            $filename = time() . '_signature_' . $file->getClientOriginalName();
            $file->move(public_path('storage/certificates'), $filename);
            $validated['signature_image'] = '/storage/certificates/' . $filename;
        }

        if ($request->hasFile('logo_image')) {
            $file = $request->file('logo_image');
            $filename = time() . '_logo_' . $file->getClientOriginalName();
            $file->move(public_path('storage/certificates'), $filename);
            $validated['logo_image'] = '/storage/certificates/' . $filename;
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
                $oldFile = public_path($certificateTemplate->signature_image);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
            $file = $request->file('signature_image');
            $filename = time() . '_signature_' . $file->getClientOriginalName();
            $file->move(public_path('storage/certificates'), $filename);
            $validated['signature_image'] = '/storage/certificates/' . $filename;
        }

        if ($request->hasFile('logo_image')) {
            if ($certificateTemplate->logo_image) {
                $oldFile = public_path($certificateTemplate->logo_image);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
            $file = $request->file('logo_image');
            $filename = time() . '_logo_' . $file->getClientOriginalName();
            $file->move(public_path('storage/certificates'), $filename);
            $validated['logo_image'] = '/storage/certificates/' . $filename;
        }

        $certificateTemplate->update($validated);

        return redirect()->route('admin.certificate-templates.index')
            ->with('success', 'Certificate template updated successfully.');
    }

    public function destroy(CertificateTemplate $certificateTemplate): RedirectResponse
    {
        if ($certificateTemplate->signature_image) {
            $oldFile = public_path($certificateTemplate->signature_image);
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        if ($certificateTemplate->logo_image) {
            $oldFile = public_path($certificateTemplate->logo_image);
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $certificateTemplate->delete();

        return redirect()->route('admin.certificate-templates.index')
            ->with('success', 'Certificate template deleted successfully.');
    }
}
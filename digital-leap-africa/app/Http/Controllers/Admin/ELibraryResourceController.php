<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ELibraryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Traits\HasWebPImages;

class ELibraryResourceController extends Controller
{
use HasWebPImages;
public function index()
{
$resources = ELibraryResource::latest()->get();
return view('admin.elibrary.index', ['elibraryItems' => $resources]);
}

public function create()
{
return view('admin.elibrary.create', ['item' => new ELibraryResource()]);
}

public function store(Request $request)
{
$validated = $request->validate([
'title' => 'required|string|max:255',
'description' => 'required|string',
'type' => 'required|string|max:100',
'file_url' => 'required|url',
'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);

$validated['slug'] = Str::slug($validated['title']);

if ($request->hasFile('image_url')) {
$validated['image_url'] = $this->storeWebPImage($request->file('image_url'), 'elibrary');
}

ELibraryResource::create($validated);
return redirect()->route('admin.elibrary-resources.index')->with('success', 'eLibrary item created successfully.');
}

public function show(ELibraryResource $elibraryResource)
{
// Not used in this CMS, redirect to index
return redirect()->route('admin.elibrary-resources.index');
}

public function edit(ELibraryResource $elibraryResource)
{
return view('admin.elibrary.edit', ['item' => $elibraryResource]);
}

public function update(Request $request, ELibraryResource $elibraryResource)
{
$validated = $request->validate([
'title' => 'required|string|max:255',
'description' => 'required|string',
'type' => 'required|string|max:100',
'file_url' => 'required|url',
'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);

$validated['slug'] = Str::slug($validated['title']);

if ($request->hasFile('image_url')) {
if ($elibraryResource->image_url) {
Storage::disk('public')->delete($elibraryResource->image_url);
}
$validated['image_url'] = $this->storeWebPImage($request->file('image_url'), 'elibrary');
}

$elibraryResource->update($validated);
return redirect()->route('admin.elibrary-resources.index')->with('success', 'eLibrary item updated successfully.');
}

public function destroy(ELibraryResource $elibraryResource)
{
if ($elibraryResource->image_url) {
Storage::disk('public')->delete($elibraryResource->image_url);
}
$elibraryResource->delete();
return redirect()->route('admin.elibrary-resources.index')->with('success', 'eLibrary item deleted successfully.');
}
}
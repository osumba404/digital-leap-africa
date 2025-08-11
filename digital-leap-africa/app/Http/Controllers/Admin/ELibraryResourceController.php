<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ELibraryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ELibraryResourceController extends Controller
{
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
$path = $request->file('image_url')->store('public/elibrary');
$validated['image_url'] = Storage::url($path);
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
Storage::delete(str_replace('/storage', 'public', $elibraryResource->image_url));
}
$path = $request->file('image_url')->store('public/elibrary');
$validated['image_url'] = Storage::url($path);
}

$elibraryResource->update($validated);
return redirect()->route('admin.elibrary-resources.index')->with('success', 'eLibrary item updated successfully.');
}

public function destroy(ELibraryResource $elibraryResource)
{
if ($elibraryResource->image_url) {
Storage::delete(str_replace('/storage', 'public', $elibraryResource->image_url));
}
$elibraryResource->delete();
return redirect()->route('admin.elibrary-resources.index')->with('success', 'eLibrary item deleted successfully.');
}
}
<?php

namespace App\Http\Controllers;

// Use the new model
use App\Models\ELibraryResource;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ELibraryController extends Controller
{
    public function index(): View
    {
        // Use the new model
        $elibraryItems = ELibraryResource::latest()->get();
        // The view name is still fine, but we pass the renamed variable
        return view('pages.elibrary.index', ['elibraryItems' => $elibraryItems]);
    }
}
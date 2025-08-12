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
        
        $elibraryItems = ELibraryResource::latest()->get();
        return view('pages.elibrary.index', ['elibraryItems' => $elibraryItems]);
    }
}
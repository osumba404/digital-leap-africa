<?php

namespace App\Http\Controllers;

use App\Models\ELibraryResource;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ELibraryController extends Controller
{
    public function index(Request $request): View
    {
        $query = ELibraryResource::query();
        
        // Filter by type if specified
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }
        
        $elibraryItems = $query->latest()->get();
        
        return view('pages.elibrary.index', compact('elibraryItems'));
    }
}
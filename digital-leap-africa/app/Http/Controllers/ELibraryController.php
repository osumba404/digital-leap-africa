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
        
        // Search functionality
        $search = $request->get('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%');
            });
        }
        
        // Filter by type if specified
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }
        
        $elibraryItems = $query->latest()->paginate(9);
        
        return view('pages.elibrary.index', compact('elibraryItems', 'search'));
    }
}
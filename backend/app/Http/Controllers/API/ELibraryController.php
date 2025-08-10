<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\ELibraryItem;

class ELibraryController extends Controller
{
    public function index()
    {
        return response()->json(ELibraryItem::latest()->get());
    }
}
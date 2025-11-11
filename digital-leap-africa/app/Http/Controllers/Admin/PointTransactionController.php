<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PointTransactionController extends Controller
{
    public function index(Request $request): View
    {
        $query = PointTransaction::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->latest()->paginate(20);
        $users = User::select('id', 'name', 'email')->get();
        
        return view('admin.point-transactions.index', compact('transactions', 'users'));
    }

    public function create(): View
    {
        $users = User::select('id', 'name', 'email')->get();
        return view('admin.point-transactions.create', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'points' => 'required|integer',
            'type' => 'required|in:earned,spent,bonus',
            'description' => 'required|string|max:255',
            'active' => 'boolean'
        ]);

        PointTransaction::create($validated);

        // Update user points
        $user = User::find($validated['user_id']);
        $user->increment('points', $validated['points']);

        return redirect()->route('admin.point-transactions.index')
            ->with('success', 'Point transaction created successfully.');
    }

    public function show(PointTransaction $pointTransaction): View
    {
        return view('admin.point-transactions.show', compact('pointTransaction'));
    }
}
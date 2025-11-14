<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailLogController extends Controller
{
    public function index(Request $request): View
    {
        $query = EmailLog::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('to_email', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }

        $logs = $query->latest()->paginate(20);
        
        return view('admin.email-logs.index', compact('logs'));
    }

    public function show(EmailLog $emailLog): View
    {
        return view('admin.email-logs.show', compact('emailLog'));
    }

    public function destroy(EmailLog $emailLog)
    {
        $emailLog->delete();
        return redirect()->route('admin.email-logs.index')
            ->with('success', 'Email log deleted successfully.');
    }
}
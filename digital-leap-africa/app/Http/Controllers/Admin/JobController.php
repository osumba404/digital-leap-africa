<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Display a listing of the jobs for the admin.
    public function index()
    {
        $jobs = Job::latest('posted_at')->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    // Show the form for creating a new job.
    public function create()
    {
        return view('admin.jobs.create');
    }

    // Store a newly created job in the database.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'application_url' => 'required|url',
        ]);

        Job::create($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'Job listing created successfully.');
    }

    // Show the form for editing the specified job.
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    // Update the specified job in the database.
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'application_url' => 'required|url',
        ]);

        $job->update($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'Job listing updated successfully.');
    }

    // Remove the specified job from the database.
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job listing deleted successfully.');
    }
}
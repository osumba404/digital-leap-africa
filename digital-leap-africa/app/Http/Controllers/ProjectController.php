<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::latest()->get();
        return view('pages.projects.index', ['projects' => $projects]);
    }

    public function show(Project $project): View
    {
        return view('pages.projects.show', ['project' => $project]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(): View
    {
        $jobs = Job::latest('posted_at')->get();
        return view('pages.jobs.index', ['jobs' => $jobs]);
    }
}
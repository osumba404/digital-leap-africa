<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index() { return view('admin.assignments.index'); }
    public function create() { return view('admin.assignments.create'); }
    public function store(Request $request) { return redirect()->back(); }
    public function edit($id) { return view('admin.assignments.edit'); }
    public function update(Request $request, $id) { return redirect()->back(); }
    public function destroy($id) { return redirect()->back(); }
}

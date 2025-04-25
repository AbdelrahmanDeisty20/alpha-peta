<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function project()
    {
        $projects = Project::all();
        // dd($projects);
        return view('web.project', compact('projects'));
    }
    public function projectDetails($id)
    {
        $project = Project::findOrFail($id);
        return view('web.projectdetails', compact('project'));
    }
}

<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;



class ProjectController extends Controller
{
    public function index() {
        $projects = Project::all();
        return view('guest.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
       return view('guest.projects.show', compact('project'));
    }

}
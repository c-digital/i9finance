<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectContractController extends Controller
{
    public function index(Project $project)
    {
        $id = $project->id;
        return view('project-contract.index', compact('project', 'id'));
    }
}

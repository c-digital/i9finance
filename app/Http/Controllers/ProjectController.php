<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projectsWidget = Project::get();
        $projects = Project::status(request()->status)->get();

        return view('projects.index', compact('projects', 'projectsWidget'));
    }

    public function create()
    {
        $customers = Customer::get()->pluck('name', 'id');
        $customers->prepend(__(''), '');

        $billing_type = [
            '' => '',
            'Fixed price'    => __('Fixed price'),
            'Project hours'  => __('Project hours'),
            'Homework hours' => __('Homework hours')
        ];

        $status = [
            '' => '',
            'Not started' => __('Not started'),
            'Developing'  => __('Developing'),
            'On holding'  => __('On holding'),
            'Finalized'   => __('Finalized'),
            'Cancelled'   => __('Cancelled')
        ];

        $members = User::get()->pluck('name', 'id');

        return view('projects.create', compact('billing_type', 'customers', 'members', 'status'));
    }

    public function store(Request $request)
    {
        Project::create([
            'name'            => $request->name,
            'customer_id'     => $request->customer_id,
            'billing_type'    => $request->billing_type,
            'status'          => $request->status,
            'total_cost'      => $request->total_cost,
            'estimated_hours' => $request->estimated_hours,
            'date_start'      => $request->date_start,
            'date_end'        => $request->date_end,
            'description'     => $request->description,
            'project_members' => $request->project_members
        ]);

        return redirect('/projects');
    }

    public function show($id)
    {
        $project = Project::find($id);
        return view('projects.show', compact('id', 'project'));
    }

    public function edit($id)
    {
        $project = Project::find($id);

        $customers = Customer::get()->pluck('name', 'id');
        $customers->prepend(__(''), '');

        $billing_type = [
            '' => '',
            'Fixed price'    => __('Fixed price'),
            'Project hours'  => __('Project hours'),
            'Homework hours' => __('Homework hours')
        ];

        $status = [
            '' => '',
            'Not started' => __('Not started'),
            'Developing'  => __('Developing'),
            'On holding'  => __('On holding'),
            'Finalized'   => __('Finalized'),
            'Cancelled'   => __('Cancelled')
        ];

        $members = User::get()->pluck('name', 'id');

        return view('projects.edit', compact('project', 'billing_type', 'customers', 'members', 'status'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->update([
            'name'            => $request->name,
            'customer_id'     => $request->customer_id,
            'billing_type'    => $request->billing_type,
            'status'          => $request->status,
            'total_cost'      => $request->total_cost,
            'estimated_hours' => $request->estimated_hours,
            'date_start'      => $request->date_start,
            'date_end'        => $request->date_end,
            'description'     => $request->description,
            'project_members' => $request->project_members
        ]);

        return redirect('/projects/' . $project->id);
    }

    public function destroy($id)
    {
        Project::find($id)->delete();
        return redirect('/projects');
    }

    public function tasks($id)
    {
        $project = Project::find($id);
        return view('tasks.index', compact('project', 'id'));
    }
}

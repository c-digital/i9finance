<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($id)
    {
        $project = Project::find($id);

        $statuses = [
            'To start'       => __('To start'),
            'In progress'    => __('In progress'),
            'On trial'       => __('On trial'),
            'Wait for reply' => __('Wait for reply'),
            'Complete'       => __('Complete'),
        ];

        $priorities = [
            ''       => '',
            'Short'  => __('Short'),
            'Medium' => __('Medium'),
            'Large'  => __('Large'),
            'Urgent' => __('Urgent'),
        ];

        if (request()->view == 'kanban') {
            return view('tasks.kanban', compact('project', 'id', 'priorities', 'statuses'));
        }

        return view('tasks.index', compact('project', 'id', 'priorities', 'statuses'));
    }

    public function create($id)
    {
        $members = User::get()->pluck('name', 'id');

        $priorities = [
            ''       => '',
            'Short'  => __('Short'),
            'Medium' => __('Medium'),
            'Large'  => __('Large'),
            'Urgent' => __('Urgent'),
        ];

        return view('tasks.create', compact('members', 'id', 'priorities'));
    }

    public function store(Request $request)
    {
        Task::create([
            'project_id'      => $request->project_id,
            'theme'           => $request->theme,
            'price_per_hours' => $request->price_per_hours,
            'date_start'      => $request->date_start,
            'date_end'        => $request->date_end,
            'assign_to'       => $request->assign_to,
            'description'     => $request->description,
            'priority'        => $request->priority,
            'status'          => 'To start',
            'cost'            => $request->cost,
        ]);

        $id = $request->project_id;

        return redirect("/projects/$id/tasks");
    }

    public function show($id)
    {

    }

    public function edit($project_id, $task_id)
    {
        $members = User::get()->pluck('name', 'id');

        $priorities = [
            ''       => '',
            'Short'  => __('Short'),
            'Medium' => __('Medium'),
            'Large'  => __('Large'),
            'Urgent' => __('Urgent'),
        ];

        $project = Project::find($project_id);

        $task = Task::find($task_id);

        return view('tasks.edit', compact('task', 'project', 'members', 'priorities'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($request->task_id);
        $task->update([
            'project_id'      => $request->project_id,
            'theme'           => $request->theme,
            'price_per_hours' => $request->price_per_hours,
            'date_start'      => $request->date_start,
            'date_end'        => $request->date_end,
            'assign_to'       => $request->assign_to,
            'description'     => $request->description,
            'priority'        => $request->priority,
            'cost'            => $request->cost,
        ]);

        $id = $request->project_id;

        return redirect("/projects/$id/tasks");
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $project_id = $task->project_id;
        $task->delete();

        return redirect("/projects/$project_id/tasks");
    }

    public function status()
    {
        $task = Task::find(request()->id);
        $task->update(['status' => request()->status]);
    }

    public function priority()
    {
        $task = Task::find(request()->id);
        $task->update(['priority' => request()->priority]);
    }
}

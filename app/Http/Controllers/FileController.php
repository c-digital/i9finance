<?php

namespace App\Http\Controllers;

use App\Project;
use App\File;
use App\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index($id)
    {
        $project = Project::find($id);
        return view('files.index', compact('project', 'id'));
    }

    public function create($id)
    {
        $project = Project::find($id);
        return view('files.create', compact('project'));
    }

    public function store(Request $request)
    {
        foreach ($request->file('files') as $file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->extension();

            $file->move(public_path() . '/uploads', $filename);

            File::create([
                'project_id'  => $request->project_id,
                'name'        => $filename,
                'type'        => $extension,
                'upload_by'   => auth()->user()->id,
                'date_upload' => date('Y-m-d h:i:s')
            ]);
        }

        return redirect("/projects/{$request->project_id}/files");

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function download($project_id, $file_id)
    {
        $file = File::find($file_id);
        $path = public_path() . '/uploads/' . $file->name;
        return response()->download($path, $file->name);
    }
}


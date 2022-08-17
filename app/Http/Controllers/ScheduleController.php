<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::get();
        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedule.create');
    }

    public function store(Request $request)
    {
        Schedule::create([
            'name'        => $request->name,
            'description' => $request->description,
        ]);
        
        return redirect('/schedule');
    }

    public function show(Schedule $schedule)
    {
        return view('schedule.show', compact('schedule'));
    }

    public function edit($id)
    {
        $schedule = Schedule::find($id);
        return view('schedule.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $schedule->update([
            'name'        => $request->name,
            'description' => $request->description,
        ]);
        
        return redirect('/schedule');
    }

    public function destroy($id)
    {

    }
}

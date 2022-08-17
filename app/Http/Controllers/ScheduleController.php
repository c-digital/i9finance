<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Schedule;
use App\ProductService;
use Carbon\Carbon;
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
        $carbon = Carbon::now();

        $hours = [
            '8:00', '8:15', '8:30', '8:45',
            '9:00', '9:15', '9:30', '9:45',
            '10:00', '10:15', '10:30', '10:45',
            '11:00', '11:15', '11:30', '11:45',
            '12:00', '12:15', '12:30', '12:45',
            '13:00', '13:15', '13:30', '13:45',
            '14:00', '14:15', '14:30', '14:45',
            '15:00', '15:15', '15:30', '15:45',
            '16:00', '16:15', '16:30', '16:45',
            '17:00', '17:15', '17:30', '17:45',
            '18:00', '18:15', '18:30', '18:45',
            '19:00', '19:15', '19:30', '19:45',
            '20:00', '20:15', '20:30', '20:45'
        ];

        $schedules = Schedule::get();

        $customers = Customer::get();

        $services = ProductService::get();

        return view('schedule.show', compact('carbon', 'schedules', 'schedule', 'hours', 'customers', 'services'));
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

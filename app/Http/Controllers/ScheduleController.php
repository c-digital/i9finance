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
        $hours = [
            '08:00', '08:15', '08:30', '08:45',
            '09:00', '09:15', '09:30', '09:45',
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

        $carbon = Carbon::now();

        $weeks[0]['date'] = $carbon->startOfWeek()->format('Y-m-d');
        $weeks[0]['showDate'] = $carbon->startOfWeek()->format('d/m/Y');
        $weeks[0]['day']  = __($carbon->startOfWeek()->format('l'));

        for ($i = 1; $i < 7; $i++) {
            $date = $carbon->addDay(1);

            $weeks[$i]['date'] = $date->format('Y-m-d');
            $weeks[$i]['showDate'] = $date->format('d/m/Y');
            $weeks[$i]['day']  = __($date->format('l'));
        }

        return view('schedule.show', compact('weeks', 'schedules', 'schedule', 'hours', 'customers', 'services'));
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
        Schedule::find($id)->delete();
        return redirect('/schedule');
    }

    public function getDateEnd(Request $request)
    {
        $hours = [
            '08:00', '08:15', '08:30', '08:45',
            '09:00', '09:15', '09:30', '09:45',
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

        $date = explode('T', $request->date_start);

        $i = array_search($date[1], $hours);
        $i = $i + 1;

        $result = $date[0] . 'T' . $hours[$i];

        return $result;
    }
}

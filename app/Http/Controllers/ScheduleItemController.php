<?php

namespace App\Http\Controllers;

use App\ScheduleItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleItemController extends Controller
{
    public function __construct()
    {
        $this->hours = [
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
    }

    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $date_start = explode('T', $request->date_start);
        $date_start = $date_start[1];

        $date_end = explode('T', $request->date_end);
        $date_end = $date_end[1];

        $start_index = array_search($date_start, $this->hours);
        $end_index = array_search($date_end, $this->hours);

        $schedule_id = $request->schedule_id;

        $timestamp = time();

        for ($i = $start_index; $i <= $end_index - 1; $i++) {
            $date = Carbon::parse($request->date_start)->format('Y-m-d');
            $date = $date . ' ' . $this->hours[$i] . ':00';

            ScheduleItem::create([
                'timestamp'   => $timestamp,
                'schedule_id' => $schedule_id,
                'customer_id' => $request->customer_id,
                'service_id'  => $request->service_id,
                'user_id'     => $request->user_id,
                'date_start'  => $date,
                'date_end'    => $date,
                'status'      => 'open',
                'comment'     => $request->comment,
                'obs'         => $request->obs,
            ]);
        }

        return redirect("/schedule/{$schedule_id}");
    }

    public function show(ScheduleItem $item)
    {

    }

    public function edit($timestamp)
    {
        $first = ScheduleItem::where('timestamp', $timestamp)
            ->first();

        $last = ScheduleItem::where('timestamp', $timestamp)
            ->orderByDesc('id')
            ->first();

        $date_end = $last->date_end;
        $date_end = explode(' ', $date_end);
        $date_end = $date_end[1];
        $date_end = str_replace(':00', '', $date_end);

        $i = array_search($date_end, $this->hours);
        $date_end = $this->hours[$i+1];

        $date_end = explode(' ', $first->date_start)[0] . ' ' . $date_end;

        $result['timestamp']   = $timestamp;
        $result['schedule_id'] = $first->schedule_id;
        $result['customer_id'] = $first->customer_id;
        $result['service_id']  = $first->service_id;
        $result['user_id']     = $first->user_id;
        $result['date_start']  = $first->date_start;
        $result['date_end']    = $date_end;
        $result['status']      = $first->status;
        $result['comment']     = $first->comment;
        $result['obs']         = $first->obs;

        return $result;
    }

    public function update(Request $request, $timestamp)
    {
        ScheduleItem::where('timestamp', $timestamp)->delete();

        $date_start = explode('T', $request->date_start);
        $date_start = $date_start[1];

        $date_end = explode('T', $request->date_end);
        $date_end = $date_end[1];

        $start_index = array_search($date_start, $this->hours);
        $end_index = array_search($date_end, $this->hours);

        $schedule_id = $request->schedule_id;

        $timestamp = time();

        for ($i = $start_index; $i <= $end_index - 1; $i++) {
            $date = Carbon::parse($request->date_start)->format('Y-m-d');
            $date = $date . ' ' . $this->hours[$i] . ':00';

            ScheduleItem::create([
                'timestamp'   => $timestamp,
                'schedule_id' => $schedule_id,
                'customer_id' => $request->customer_id,
                'service_id'  => $request->service_id,
                'user_id'     => $request->user_id,
                'date_start'  => $date,
                'date_end'    => $date,
                'status'      => $request->status,
                'comment'     => $request->comment,
                'obs'         => $request->obs,
            ]);
        }

        return redirect("/schedule/{$schedule_id}");
    }

    public function destroy($timestamp)
    {
        $schedule_id = ScheduleItem::where('timestamp', $timestamp)
            ->first()
            ->schedule_id;

        ScheduleItem::where('timestamp', $timestamp)
            ->delete();

        return redirect("/schedule/{$schedule_id}");
    }
}

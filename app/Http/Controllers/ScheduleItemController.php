<?php

namespace App\Http\Controllers;

use App\ScheduleItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleItemController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $schedule_id = $request->schedule_id;

        $date_start = Carbon::parse($request->date_start)->format('Y-m-d h:i:s');
        $date_end = Carbon::parse($request->date_end)->format('Y-m-d h:i:s');

        ScheduleItem::create([
            'schedule_id' => $schedule_id,
            'customer_id' => $request->customer_id,
            'product_id'  => $request->product_id,
            'date_start'  => $date_start,
            'date_end'    => $date_end,
            'status'      => 'open'
        ]);

        return redirect("/schedule/{$schedule_id}");
    }

    public function show(ScheduleItem $schedule)
    {

    }

    public function edit(ScheduleItem $item)
    {

    }

    public function update(Request $request, ScheduleItem $item)
    {

    }

    public function destroy($id)
    {

    }
}

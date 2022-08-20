<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{
    protected $fillable = ['timestamp', 'schedule_id', 'customer_id', 'service_id', 'user_id', 'date_start', 'date_end', 'status', 'obs', 'comment'];

    public $timestamps = false;

    public function schedule()
    {
        return $this->belongsTo('App\Schedule');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function service()
    {
        return $this->belongsTo('App\ProductService');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getEndAttribute()
    {
        $item = ScheduleItem::where('timestamp', $this->timestamp)
            ->orderByDesc('id')
            ->first();
            
        return $item->date_end;
    }

    public function getColorAttribute()
    {
        if ($this->status == 'open') {
            return 'alert alert-info';
        }

        if ($this->status == 'in progress') {
            return 'alert alert-primary';
        }

        if ($this->status == 'finished') {
            return 'alert alert-success';
        }

        if ($this->status == 'cancelled') {
            return 'alert alert-danger';
        }
    }
}

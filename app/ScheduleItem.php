<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{
    protected $fillable = ['timestamp', 'schedule_id', 'customer_id', 'product_id', 'date_start', 'date_end', 'status'];

    public $timestamps = false;

    public function schedule()
    {
        return $this->belongsTo('App\Schedule');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function product()
    {
        return $this->belongsTo('App\ProductService');
    }

    public function getColorAttribute()
    {
        if ($this->status == 'open') {
            return 'alert alert-secondary';
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

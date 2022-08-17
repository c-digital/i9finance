<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['name', 'description'];

    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('App\ScheduleItem');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['project_id', 'theme', 'price_per_hours', 'date_start', 'date_end', 'priority', 'assign_to', 'description', 'status', 'cost'];

    public $timestamps = false;

    protected $casts = ['assign_to' => 'array'];
}

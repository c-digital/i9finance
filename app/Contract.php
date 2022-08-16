<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = ['customer_id', 'project_id', 'theme', 'amount', 'type', 'date_start', 'date_end', 'description'];

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}

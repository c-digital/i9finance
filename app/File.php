<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'type',
        'upload_by',
        'date_upload',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'upload_by');
    }

    public function comments()
    {
        return $this->hasMany('App\FileProjectComment');
    }
}

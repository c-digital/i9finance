<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileProjectComment extends Model
{
    protected $fillable = [
        'id_file',
        'id_user',
        'comment',
        'date'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

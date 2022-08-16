<?php

namespace App;

use App\Customer;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['customer_id', 'name', 'calculate_progress_through_tasks', 'billing_type', 'status', 'total_cost', 'description', 'date_start', 'date_end', 'estimated_hours', 'project_members'];

    protected $casts = ['project_members' => 'array'];

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            $query->where('status', $status);
        }
    }
}

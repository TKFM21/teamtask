<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taskhistory extends Model
{
    protected $fillable = ['task_id', 'crud', 'title', 'status', 'in_charge_id', 'detail'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'in_charge_id');
    }
    
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}

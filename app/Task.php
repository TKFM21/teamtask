<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'status', 'in_charge_id', 'detail'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'in_charge_id');
    }
    
    public function taskhistories()
     {
         return $this->hasMany(Taskhistory::class);
     }
}

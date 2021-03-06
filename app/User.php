<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PasswordResetNotification;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * パスワードリセット通知の送信をオーバーライド
     * 
     * @param string $token
     * @return void
     */
     public function sendPasswordResetNotification($token)
     {
         $this->notify(new PasswordResetNotification($token));
     }
     
     public function tasks()
     {
         return $this->hasMany(Task::class, 'in_charge_id');
     }
     
     public function taskhistories()
     {
         return $this->hasMany(Taskhistory::class, 'in_charge_id');
     }
}

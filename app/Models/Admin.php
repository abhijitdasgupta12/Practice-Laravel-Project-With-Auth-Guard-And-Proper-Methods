<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Notifications\AdminResetPassword;

class Admin extends Authenticatable
{
    use Notifiable; 
    protected $table = 'admin';
    protected $fillable = ['name', 'email', 'password', 'remember_token'];

    protected $hidden = ['password', 'remember_token'];

    public $timestamps = true;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }
}

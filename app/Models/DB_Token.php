<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DB_Token extends Model
{
    protected $table = 'db_tokens';
    protected $fillable = ['email', 'token'];

    public $timestamps = true;
}

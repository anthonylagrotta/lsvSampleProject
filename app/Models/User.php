<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    public function tasks()
    {
        return $this->hasMany('App\Task', 'id', 'user_id');
    }
}

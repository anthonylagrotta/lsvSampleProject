<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    public function tasks()
    {
        return $this->hasMany('App\Task', 'id', 'project_id');
    }
}
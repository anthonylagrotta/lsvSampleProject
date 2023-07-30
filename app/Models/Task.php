<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'assignedTo');
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'id', 'projectID');
    }
}
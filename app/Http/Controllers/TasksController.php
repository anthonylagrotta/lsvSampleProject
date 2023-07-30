<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;


class TasksController extends Controller
{
    public function getTasks(Request $request_data, $id)
    {
        // get all of the tasks

        Log::info('reuest data '.json_encode($request_data));
        $data = $request_data;
        Log::info('data '.json_encode($data));
        $project = Project::select('project_name')->where('id',$id)->pluck('project_name');


        $tasks = Task::join('users', 'tasks.user_id', '=', 'users.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('tasks.project_id', $id)
            ->select('tasks.*', 'users.user_name as user_name', 'users.id as user_id', 'projects.project_name as project_id')
            ->get();
        Log::info('tasks '.json_encode($tasks));


        return response()->json($tasks, 200);
    }


}
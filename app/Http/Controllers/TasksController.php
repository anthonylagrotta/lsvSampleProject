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
        $project = Project::select('projectname')->where('id',$id)->pluck('projectname');


        $tasks = Task::join('users', 'tasks.assignedTo', '=', 'users.id')
            ->join('projects', 'tasks.projectID', '=', 'projects.id')
            ->where('tasks.projectID', $id)
            ->select('tasks.*', 'users.username as assignedTo', 'users.id as userID', 'projects.projectname as projectID')
            ->get();
        Log::info('tasks '.json_encode($tasks));


        return response()->json($tasks, 200);
    }


}
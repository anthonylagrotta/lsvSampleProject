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

class ProjectsController extends Controller
{
    public function getProjects(Request $request_data){
        // get all of the projects

        $projects = DB::table('projects')->get();
        $data_array = json_decode($projects, true);
        $project_details = [];

        foreach ($data_array as $item) {
            $id = $item['id'];
            $project_detail = [];
            $hours = [];


            $user_info = Task::where('project_id', $id)
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->select('user_id','users.user_name')
            ->distinct()
            ->get();
            $user_array = [];
            $user_id_array = [];
            $members = json_decode($user_info, true);
            
            foreach($members as $thing){
                $user_array [] = $thing['user_name'];
                $user_id_array [] = $thing['user_id'];
            }

            $hours [] = Task::where('project_id', $id)
            ->select('estimated_hours')
            ->pluck('estimated_hours')->sum();

            $project_detail['id'] = $id;
            $project_detail['project'] = $item['project_name'];
            $project_detail['members'] = $user_array;
            $project_detail['user_id'] = $user_id_array;
            $project_detail['estimated_hours'] = $hours;

            $project_details[] = $project_detail;

        
        }

        Log::info('projectDetails '.json_encode($project_details));

        return response()->json($project_details, 200);
        
    }

    public function getProject(Request $request_data, $id) {
        $data = $request_data;
        $project = DB::table('projects')->get($id);
        return response()->json($project, 200);
        // get the specific project by id, need to accept id
    }

    public function create(Request $request_data) {
        // do someting
    }

    public function update(Request $request_data) {
        // do something
    }

    public function delete(Request $request_data) {
        // do something
    }




}
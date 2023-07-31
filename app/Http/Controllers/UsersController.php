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


class UsersController extends Controller
{
    public function getUsers(Request $request_data)
    {
        // get all of the users

        Log::info('reuest data '.json_encode($request_data));
        $data = $request_data;
        Log::info('data '.json_encode($data));

        $users = DB::table('users')->get();
        Log::info('users '.json_encode($users));
        return response()->json($users, 200);
    }

    public function getProjects(Request $request_data, $id) {
        $project_ids = Task::select('project_id')->where('user_id', $id)->distinct()->pluck('project_id');

        $user = User::select('user_name')->where('id',$id)->pluck('user_name');
        
        $project_details = [];
        foreach($project_ids as $project_id){
            $project_detail = [];
            $hours = [];

            $user_info = Task::where('project_id', $project_id)
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->select('user_id','users.user_name')
            ->distinct()
            ->get();
            $user_array = [];
            $user_id_array = [];
            $members = json_decode($user_info, true);
            Log::info('members '.json_encode($members));
            
            foreach($members as $thing){
                $user_array [] = $thing['user_name'];
                $user_id_array [] = $thing['user_id'];
            }

            $hours [] = Task::where('project_id', $project_id)
            ->select('estimated_hours')
            ->pluck('estimated_hours')->sum();

            $project_detail['project'] = Project::find($project_id);
            $project_detail['members'] = $user_array;
            $project_detail['user_id'] = $user_id_array;
            $project_detail['estimated_hours'] = $hours;
            if(sizeof($project_details)<1){
                $project_detail['user'] = $user;
            }
            $project_details[] = $project_detail;
        }

        Log::info('project_details '.json_encode($project_details));

        return response()->json($project_details, 200);

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
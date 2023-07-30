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
        $projectIDs = Task::select('projectID')->where('assignedTo', $id)->distinct()->pluck('projectID');

        $user = User::select('username')->where('id',$id)->pluck('username');
        
        $projectDetails = [];
        foreach($projectIDs as $projectID){
            $projectDetail = [];
            $hours = [];

            $userInfo = Task::where('projectID', $projectID)
            ->join('users', 'tasks.assignedTo', '=', 'users.id')
            ->select('assignedTo','users.username')
            ->distinct()
            ->get();
            $userArray = [];
            $userIDArray = [];
            $members = json_decode($userInfo, true);
            Log::info('members '.json_encode($members));
            
            foreach($members as $thing){
                $userArray [] = $thing['username'];
                $userIDArray [] = $thing['assignedTo'];
            }

            $hours [] = Task::where('projectID', $projectID)
            ->select('estimatedHours')
            ->pluck('estimatedHours')->sum();

            $projectDetail['project'] = Project::find($projectID);
            $projectDetail['members'] = $userArray;
            $projectDetail['userID'] = $userIDArray;
            $projectDetail['estimatedHours'] = $hours;
            if(sizeof($projectDetails)<1){
                $projectDetail['user'] = $user;
            }
            $projectDetails[] = $projectDetail;
        }

        Log::info('projectDetails '.json_encode($projectDetails));

        return response()->json($projectDetails, 200);

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
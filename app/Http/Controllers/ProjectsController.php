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
        $dataArray = json_decode($projects, true);
        $projectDetails = [];

        foreach ($dataArray as $item) {
            $id = $item['id'];
            $projectDetail = [];
            $hours = [];


            $userInfo = Task::where('projectID', $id)
            ->join('users', 'tasks.assignedTo', '=', 'users.id')
            ->select('assignedTo','users.username')
            ->distinct()
            ->get();
            $userArray = [];
            $userIDArray = [];
            $members = json_decode($userInfo, true);
            
            foreach($members as $thing){
                $userArray [] = $thing['username'];
                $userIDArray [] = $thing['assignedTo'];
            }

            $hours [] = Task::where('projectID', $id)
            ->select('estimatedHours')
            ->pluck('estimatedHours')->sum();

            $projectDetail['id'] = $id;
            $projectDetail['project'] = $item['projectname'];
            $projectDetail['members'] = $userArray;
            $projectDetail['userID'] = $userIDArray;
            $projectDetail['estimatedHours'] = $hours;

            $projectDetails[] = $projectDetail;

            $test = Task::where('projectID', $id)
            ->join('users', 'tasks.assignedTo', '=', 'users.id')
            ->select('assignedTo','users.username')
            ->distinct()
            ->get();
        
        }

        Log::info('projectDetails '.json_encode($projectDetails));

        return response()->json($projectDetails, 200);
        
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
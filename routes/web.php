<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;

Route::redirect('/', '/projects');

// Route anything thats not /api to the LaravelController->index()
Route::any('/{any}', [AngularController::class, 'index'])->where('any', '^(?!api).*$');


Route::group(['prefix' => 'api',  'middleware' => 'api'], function()
{
    // Projects
    Route::get('/projects', [ ProjectsController::class, 'getProjects']);
    Route::get('/projects/{id}', [ ProjectsController::class, 'getProject']); // Also pass ID to the function
    Route::put('/projects', [ ProjectsController::class, 'create']);
    Route::post('/projects', [ ProjectsController::class, 'update']);
    Route::delete('/projects', [ ProjectsController::class, 'delete']);

    Route::get('/tasks/{id}', [TasksController::class, 'getTasks']);

    Route::get('/users/{id}', [UsersController::class, 'getProjects']);

});





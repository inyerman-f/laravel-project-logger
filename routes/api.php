<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);



Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('projects',[ProjectController::class, 'index']);
    Route::post('projects/add',[ProjectController::class, 'store']);
    Route::get('projects/{project}',[ProjectController::class, 'show']);
    Route::post('projects/{project}/edit',[ProjectController::class, 'update']);
    Route::post('projects/{project}/delete', [ProjectController::class, 'obliterate']);

    Route::post('projects/{project}/tasks',[TaskController::class, 'index']);
    Route::post('projects/{project}/tasks/add',[TaskController::class, 'store']);
    Route::post('projects/{project}/tasks/{task}/edit',[TaskController::class, 'update']);
    Route::post('projects/{project}/tasks/{task}/delete',[TaskController::class, 'obliterate']);
    Route::post('tasks/{task}/delete',[TaskController::class, 'obliterate']);

});

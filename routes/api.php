<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;

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
Route::post('derp',[ProjectController::class, 'test']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('projects',[ProjectController::class, 'index']);
    Route::post('projects/add',[ProjectController::class, 'store']);
    Route::get('projects/{project}',[ProjectController::class, 'show']);
    Route::post('projects/{project}/edit',[ProjectController::class, 'update']);
    Route::post('projects/{project}/delete', [ProjectController::class, 'obliterate']);

});

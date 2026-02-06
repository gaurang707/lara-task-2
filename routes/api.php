<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\ProjectTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\Task;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[AuthController::class,'login'])->name('apilogin');
Route::post('register',[AuthController::class,'register'])->name('apiregister');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projectapi', ProjectController::class);
    Route::get('/projects/{project}/tasks', [ProjectTaskController::class, 'index'])->name('projects.tasks.index');
});

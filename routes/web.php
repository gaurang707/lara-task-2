<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Models\Project;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');    
});

Route::middleware(['auth', 'role'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::post('/projects/getdata', [ProjectController::class, 'getdata'])->name('projects.getdata');
    Route::resource('tasks', TaskController::class);
    Route::post('/tasks/getdata', [TaskController::class, 'getdata'])->name('tasks.getdata');
    Route::get('/projects/{project}/tasks', function (Project $project){
        return view('project-task.index', compact('project'));
    })->name('projects.tasks.index');
    
});

require __DIR__.'/auth.php';

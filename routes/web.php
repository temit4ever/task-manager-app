<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Task routes
    Route::post('/tasks', [TaskController::class, 'store'])->name('store.task');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('create.task');
    Route::get('/tasks', [TaskController::class, 'index'])->name('index.task');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('edit.task');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('update.task');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('delete.task');
    Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('reorder.task');

    // Project routes
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('create.project');
    Route::post('/projects', [ProjectController::class, 'store'])->name('store.project');
    Route::get('/projects', [ProjectController::class, 'show'])->name('show.project');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/v1/project/{project}/tasks', [TaskController::class, 'show'])->name('show.task');
Route::get('api/v1/reorder/task', [TaskController::class, 'reorder'])->name('reorder.task');



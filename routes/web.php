<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::resource('tasks',TaskController::class);
//ステータス用ルート//
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

//ソート用ルート//
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::get('/', function () {
    return view('welcome');
});

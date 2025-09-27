<?php

use Illuminate\Support\Facades\Route;

Route::resource('tasks',TaskController::class);

Route::get('/', function () {
    return view('welcome');
});

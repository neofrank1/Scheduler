<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegeController;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// College Routes
Route::get('/college/collegeList', [CollegeController::class, 'collegeList']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfessorController;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// College Routes
Route::get('/college/collegeList', [CollegeController::class, 'collegeList']);
Route::get('/college', [CollegeController::class, 'index'])->name('college.home');
Route::post('/college/insertCollege', [CollegeController::class, 'insertCollege'])->name('college.add');
Route::get('/college/getCollege/{id}', [CollegeController::class, 'editCollege']);
Route::post('/college/updateCollege', [CollegeController::class, 'updateCollege'])->name('college.update');
Route::post('/college/statusCollege', [CollegeController::class, 'statusCollege'])->name('college.status');

// Course Routes
Route::get('/course/courseList', [CourseController::class, 'courseList']);
Route::get('/course', [CourseController::class, 'index'])->name('course.home');
Route::post('/course/insertCourse', [CourseController::class, 'insertCourse'])->name('course.add');
Route::get('/course/getCourse/{id}', [CourseController::class, 'editCourse']);
Route::post('/course/updateCourse', [CourseController::class, 'updateCourse'])->name('course.update');
Route::post('/course/statusCourse', [CourseController::class, 'statusCourse'])->name('course.status');

// Faculty Routes
Route::get('/professor', [ProfessorController::class ,'index'])->name('professor.home');
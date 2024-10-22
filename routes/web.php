<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\DeanController;
use App\Http\Controllers\ChairpersonController;
use App\Http\Controllers\SectionController;

Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

// College Routes
Route::get('/college/collegeList', [CollegeController::class, 'collegeList']);
Route::get('/college', [CollegeController::class, 'index'])->name('college.home');
Route::post('/college/insertCollege', [CollegeController::class, 'insertCollege'])->middleware('auth')->name('college.add');
Route::get('/college/getCollege/{id}', [CollegeController::class, 'editCollege']);
Route::post('/college/updateCollege', [CollegeController::class, 'updateCollege'])->middleware('auth')->name('college.update');
Route::post('/college/statusCollege', [CollegeController::class, 'statusCollege'])->middleware('auth')->name('college.status');

// Course Routes
Route::get('/course/courseList', [CourseController::class, 'courseList']);
Route::get('/course', [CourseController::class, 'index'])->name('course.home');
Route::post('/course/insertCourse', [CourseController::class, 'insertCourse'])->middleware('auth')->name('course.add');
Route::get('/course/getCourse/{id}', [CourseController::class, 'editCourse']);
Route::post('/course/updateCourse', [CourseController::class, 'updateCourse'])->middleware('auth')->name('course.update');
Route::post('/course/statusCourse', [CourseController::class, 'statusCourse'])->middleware('auth')->name('course.status');

// Faculty Routes
Route::get('/professor', [ProfessorController::class ,'index'])->middleware('auth')->name('professor.home');
Route::get('/dean', [DeanController::class, 'index'])->middleware('auth')->name('dean.home');
Route::post('/dean/statusDean', [DeanController::class, 'statusDean'])->name('dean.status');
Route::get('/chairperson', [ChairpersonController::class, 'index'])->middleware('auth')->name('chairperson.home');
Route::post('/chairperson/statusChairperson', [ChairpersonController::class, 'statusChairperson'])->name('chairperson.status');
Route::post('/professor/insertProfessor', [ProfessorController::class, 'insertProfessor'])->middleware('auth')->name('professor.add');
Route::post('/professor/statusProfessor', [ProfessorController::class, 'statusProfessor'])->middleware('auth')->name('professor.status');
Route::get('/professor/getProfessor/{id}', [ProfessorController::class, 'editProfessor']);
Route::post('/professor/updateProfessor', [ProfessorController::class, 'updateProfessor'])->middleware('auth')->name('professor.update');

// Section
Route::get('/section', [SectionController::class, 'index'])->middleware('auth')->name('section.home');
Route::post('/section/insertSection', [SectionController::class, 'insertSection'])->middleware('auth')->name('section.add');
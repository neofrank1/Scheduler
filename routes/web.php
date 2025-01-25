<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\DeanController;
use App\Http\Controllers\ChairpersonController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

// College Routes
Route::get('/college/collegeList', [CollegeController::class, 'collegeList']);
Route::get('/college', [CollegeController::class, 'index'])->name('college.home');
Route::post('/college/insertCollege', [CollegeController::class, 'insertCollege'])->middleware('auth')->name('college.add');
Route::get('/college/getCollege/{id}', [CollegeController::class, 'editCollege'])->middleware('auth');
Route::post('/college/updateCollege', [CollegeController::class, 'updateCollege'])->middleware('auth')->name('college.update');
Route::post('/college/statusCollege', [CollegeController::class, 'statusCollege'])->middleware('auth')->name('college.status');

// Course Routes
Route::get('/course/courseList', [CourseController::class, 'courseList']);
Route::get('/course', [CourseController::class, 'index'])->name('course.home');
Route::post('/course/insertCourse', [CourseController::class, 'insertCourse'])->middleware('auth')->name('course.add');
Route::get('/course/getCourse/{id}', [CourseController::class, 'editCourse'])->middleware('auth');
Route::post('/course/updateCourse', [CourseController::class, 'updateCourse'])->middleware('auth')->name('course.update');
Route::post('/course/statusCourse', [CourseController::class, 'statusCourse'])->middleware('auth')->name('course.status');

// Faculty Routes
Route::get('/professor', [ProfessorController::class ,'index'])->middleware('auth')->name('professor.home');
Route::get('/dean', [DeanController::class, 'index'])->middleware('auth')->name('dean.home');
Route::post('/dean/statusDean', [DeanController::class, 'statusDean'])->middleware('auth')->name('dean.status');
Route::get('/chairperson', [ChairpersonController::class, 'index'])->middleware('auth')->name('chairperson.home');
Route::post('/chairperson/statusChairperson', [ChairpersonController::class, 'statusChairperson'])->name('chairperson.status');
Route::post('/professor/insertProfessor', [ProfessorController::class, 'insertProfessor'])->middleware('auth')->name('professor.add');
Route::post('/professor/statusProfessor', [ProfessorController::class, 'statusProfessor'])->middleware('auth')->name('professor.status');
Route::get('/professor/getProfessor/{id}', [ProfessorController::class, 'editProfessor'])->middleware('auth');
Route::post('/professor/updateProfessor', [ProfessorController::class, 'updateProfessor'])->middleware('auth')->name('professor.update');

// Section
Route::get('/section', [SectionController::class, 'index'])->middleware('auth')->name('section.home');
Route::post('/section/insertSection', [SectionController::class, 'insertSection'])->middleware('auth')->name('section.add');
Route::get('/section/getSection/{id}', [SectionController::class, 'editSection'])->middleware('auth');
Route::post('/section/updateSection', [SectionController::class, 'updateSection'])->middleware('auth')->name('section.update');
Route::post('/section/statusSection', [SectionController::class, 'statusSection'])->middleware('auth')->name('section.status');

// Room
Route::get('/room', [RoomController::class, 'index'])->middleware('auth')->name('room.home');
Route::post('/room/insertRoom', [RoomController::class, 'insertRoom'])->middleware('auth')->name('room.add');
Route::get('/room/getRoom/{id}', [RoomController::class, 'editRoom'])->middleware('auth');
Route::post('/room/updateRoom', [RoomController::class, 'updateRoom'])->middleware('auth')->name('room.update');

// Subject
Route::get('/subject', [SubjectController::class, 'index'])->middleware('auth')->name('subject.home');
Route::post('/subject/insertSubject', [SubjectController::class, 'insertSubject'])->middleware('auth')->name('subject.add');
Route::get('/subject/getSubject/{id}', [SubjectController::class, 'editSubject'])->middleware('auth');
Route::post('/subject/updateSubject', [SubjectController::class, 'updateSubject'])->middleware('auth')->name('subject.update');

// Schedule 
Route::get('/schedule', [ScheduleController::class, 'index'])->middleware('auth')->name('schedule.home');
Route::post('/schedule/insertSchedule', [ScheduleController::class, 'insertSchedule'])->middleware('auth')->name('schedule.add');
Route::get('/schedule/editSchedule/{id}', [ScheduleController::class, 'editSchedule'])->middleware('auth');
Route::post('/schedule/updateSchedule', [ScheduleController::class, 'updateSchedule'])->middleware('auth')->name('schedule.update');
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\College;
use App\Models\Course;

class ProfessorController extends Controller
{
    public function index() {
        $course = Course::get();
        $college = College::get();
        return view('faculty.professor')->with(compact('college', 'course'));
    }
}

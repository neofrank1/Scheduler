<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;

class ProfessorController extends Controller
{
    public function index() {
        return view('faculty.professor');
    }
}

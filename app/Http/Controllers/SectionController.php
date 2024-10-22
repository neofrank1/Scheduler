<?php

namespace App\Http\Controllers;
use App\Models\College;
use App\Models\Course;
use App\Models\Section;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index() {
        $course = Course::get();
        $college = College::get();

        if (request()->ajax()){
            $query = Section::select('section.*', 'college.full_name as college_name', 'course.full_name as course_name')
                           ->leftJoin('college', 'section.college_id', '=', 'college.id')
                           ->leftJoin('course', 'section.course_id', '=', 'course.id');
            
            return DataTables::make($query)->make(true);
        }

        return view('section.index')->with(compact('college', 'course'));
    }

    public function insertSection (Request $request) {
        
        if (empty($request->input('_token'))) {
            return false;
        }

        Section::create($request->except('_token',));
        return redirect()->route('section.home')->with('success', 'Section created successfully!');
    }
}

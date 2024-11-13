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

    public function editSection($id){
        $result = Section::select('section.*', 'college.full_name as college_name', 'course.full_name as course_name')
                ->join('course', 'section.course_id', '=', 'course.id')
                ->join('college', 'section.college_id', '=', 'college.id')
                ->where('section.id', $id)
                ->first();
        return response()->json($result);
    }

    public function updateSection(Request $request) {
        if (empty($request->input())) {
            return false;
        }

        if (empty($request->input('_token'))) {
            return false;
        }
        $id = $request->input('section_id');

        $section = Section::find($id);

        $result = $section->update($request->except('_token'));

        if ($result) {
            return redirect()->route('section.home')->with('success', 'section updated successfully!');
        }
    }
}

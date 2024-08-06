<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    //
    public function courseList(): JsonResponse {
        $result = Course::all(['id', 'full_name', 'college_id']);
        return response()->json($result);
    }

    public function index() {
        if (request()->ajax()) {
            $query = Course::select('course.*', 'college.full_name as college_name')
                           ->leftJoin('college', 'course.college_id', '=', 'college.id');
            
            return DataTables::make($query)->make(true);
        }
        return view('course.index');
    }
    
}

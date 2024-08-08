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

    public function insertCourse(Request $request) {
        Course::create($request->except('_token'));
        return redirect()->route('course.home')->with('success', 'Course created successfully!');
    }

    public function editCourse($id) {
        $result = Course::select('course.*', 'college.id as college_id','college.full_name as college_full_name')
                        ->leftJoin('college', 'course.college_id', '=', 'college.id')
                        ->where('course.id', $id)
                        ->first();
    
        return response()->json($result);
    }
    
    public function updateCourse(Request $request) {
        if (empty($request->input())) {
            return false;
        }

        if (empty($request->input('_token'))) {
            return false;
        }
        $id = $request->input('course_id');

        $course = Course::find($id);

        $result = $course->update($request->except('_token'));

        if ($result) {
            return redirect()->route('course.home')->with('success', 'Course updated successfully!');
        }
    }
    public function statusCourse(Request $request)
    {
        if ($request->ajax()) {
            $course = Course::find($request->input('id'));
            if ($course) {
                $course->status = $request->input('status');
                $result = $course->save();

                if ($result) {
                    $message = $request->input('status') == 1 ? 'Course activated successfully!' : 'Course deactivated successfully!';
                    return response()->json(['success' => true, 'message' => $message]);
                }
            }
            return response()->json(['success' => false, 'message' => 'Failed to update Course status.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid request.']);
    }
}

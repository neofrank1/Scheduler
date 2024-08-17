<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;

class ChairpersonController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            $query = User::select('users.*', 'college.full_name as college_name','course.full_name as course_name')
                           ->leftJoin('college', 'users.college_id', '=', 'college.id')
                           ->leftJoin('course', 'users.course_id', '=', 'course.id')
                           ->where('users.user_type', 3);
            return DataTables::make($query)->make(true);
        }
        return view('faculty.chairperson');
    }

    public function statusChairperson(Request $request)
    {
        if ($request->ajax()) {
            $course = User::find($request->input('id'));
            if ($course) {
                $course->status = $request->input('status');
                $result = $course->save();

                if ($result) {
                    $message = $request->input('status') == 1 ? 'Chairperson activated successfully!' : 'Chairperson deactivated successfully!';
                    return response()->json(['success' => true, 'message' => $message]);
                }
            }
            return response()->json(['success' => false, 'message' => 'Failed to update Chairperson status.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid request.']);
    }
}

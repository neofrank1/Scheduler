<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;

class DeanController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            $query = User::select('users.*', 'college.full_name as college_name')
                           ->leftJoin('college', 'users.college_id', '=', 'college.id')
                           ->where('users.user_type', 2);
            
            return DataTables::make($query)->make(true);
        }
        return view('faculty.dean');
    }

    public function statusDean(Request $request)
    {
        if ($request->ajax()) {
            $course = User::find($request->input('id'));
            if ($course) {
                $course->status = $request->input('status');
                $result = $course->save();

                if ($result) {
                    $message = $request->input('status') == 1 ? 'Dean activated successfully!' : 'Dean deactivated successfully!';
                    return response()->json(['success' => true, 'message' => $message]);
                }
            }
            return response()->json(['success' => false, 'message' => 'Failed to update Dean status.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid request.']);
    }
}

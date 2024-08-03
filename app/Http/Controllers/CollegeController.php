<?php

namespace App\Http\Controllers;
use App\Models\College;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function index(College $college) {
        $data = College::all();
        return view('college.index', compact('data'));
    }

    public function collegeList(): JsonResponse {
        $result = College::all(['id', 'full_name']);
        return response()->json($result);
    }

    public function insertCollege(Request $request) {
        College::create($request->except('_token'));
        return redirect()->route('college.home')->with('success', 'College Department created successfully!');
    }

    public function editCollege($id) {
        $result = College::find($id);
        return response()->json($result);
    }

    public function updateCollege(Request $request) {
        if (empty($request->input())) {
            return false;
        }

        if (empty($request->input('_token'))) {
            return false;
        }
        $id = $request->input('college_id');

        $college = College::find($id);

        $result = $college->update($request->except('_token'));

        if ($result) {
            return redirect()->route('college.home')->with('success', 'College updated successfully!');
        }
    }

    public function statusCollege(Request $request)
    {
        if ($request->ajax()) {
            $college = College::find($request->input('id'));
            if ($college) {
                $college->status = $request->input('status');
                $result = $college->save();

                if ($result) {
                    $message = $request->input('status') == 1 ? 'College activated successfully!' : 'College deactivated successfully!';
                    return response()->json(['success' => true, 'message' => $message]);
                }
            }
            return response()->json(['success' => false, 'message' => 'Failed to update college status.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid request.']);
    }
}

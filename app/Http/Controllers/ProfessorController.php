<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\College;
use App\Models\Course;
use App\Models\Ranking;
use Yajra\DataTables\DataTables;

class ProfessorController extends Controller
{
    public function index() {
        $course = Course::get();
        $college = College::get();
        $ranking = Ranking::get();

        if (request()->ajax()){
            $query = Professor::select('professors.*', 'ranking.title as ranking_title', 'college.full_name as college_name', 'course.full_name as course_name')
                           ->leftJoin('ranking', 'professors.ranking_id', '=', 'ranking.id') 
                           ->leftJoin('college', 'professors.college_id', '=', 'college.id')
                           ->leftJoin('course', 'professors.course_id', '=', 'course.id');
            
            return DataTables::make($query)->make(true);
        }


        return view('faculty.professor')->with(compact('college', 'course', 'ranking'));
    }

    public function insertProfessor (Request $request) {
        
        if (empty($request->input('_token'))) {
            return false;
        }

        Professor::create($request->except('_token'));
        return redirect()->route('professor.home')->with('success', 'Professor created successfully!');

    }

    public function editProfessor($id) {
        $result = Professor::find($id);
        return response()->json($result);
    }

    public function statusProfessor(Request $request)
    {
        if ($request->ajax()) {
            $professor = Professor::find($request->input('id'));
            if ($professor) {
                $professor->status = $request->input('status');
                $result = $professor->save();

                if ($result) {
                    $message = $request->input('status') == 1 ? 'Professor activated successfully!' : 'Professor deactivated successfully!';
                    return response()->json(['success' => true, 'message' => $message]);
                }
            }
            return response()->json(['success' => false, 'message' => 'Failed to update professor status.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid request.']);
    }
}

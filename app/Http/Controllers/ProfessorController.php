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

        $existingProfessor = Professor::where('employee_id', $request->input('employee_id'))->first();
        if ($existingProfessor) {
            return redirect()->route('professor.home')->with('error', 'Employee ID already exists!');
        }

        Professor::create($request->except('_token'));
        return redirect()->route('professor.home')->with('success', 'Professor created successfully!');

    }

    public function editProfessor($id) {
        $result = Professor::select('professors.*', 'ranking.*', 'college.*')
                        ->join('ranking', 'professors.ranking_id', '=', 'ranking.id')
                        ->join('college', 'professors.college_id', '=', 'college.id')
                        ->where('professors.id', $id)
                        ->first();
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

    public function updateProfessor(Request $request) {
        if (empty($request->input())) {
            return false;
        }

        if (empty($request->input('_token'))) {
            return false;
        }
        $id = $request->input('employee_id');

        $professor = Professor::find($id);

        $existingProfessor = Professor::where('employee_id', $request->input('employee_id'))->first();
        if ($existingProfessor) {
            return redirect()->route('professor.home')->with('error', 'Employee ID already exists!');
        }
        
        $result = $professor->update($request->except('_token'));

        if ($result) {
            return redirect()->route('professor.home')->with('success', 'professor updated successfully!');
        }
    }
}

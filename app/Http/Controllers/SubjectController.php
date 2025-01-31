<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Subject::select('subjects.*', 'course.short_name as course')
                ->leftJoin('course', 'subjects.course_id', '=', 'course.id');

            return DataTables::of($query)->make(true);    
        }

        return view('subject.index');
    }

    public function insertSubject(Request $request) {

        if(empty($request->input('_token'))) {
            return;
        }

        $data = array();

        foreach($request->input('subj_code') as $index => $subj_code) {

            $data = [
                'subj_code' => $subj_code,
                'subj_desc' => $request->input('subj_desc')[$index] ?? null,
                'subj_hours' => $request->input('subj_hours')[$index] ?? null,
                'subj_lab_hours' => $request->input('subj_lab_hours')[$index] ?? null,
                'subj_lec_hours' => $request->input('subj_lec_hours')[$index] ?? null,
                'subj_units' => $request->input('subj_units')[$index] ?? null,
                'subj_prereq' => $request->input('subj_prereq')[$index] ?? null,
                'subj_type' => $request->input('subj_type')[$index] ?? null,
                'course_id' => Auth::user()->course_id,
                'semester' => $request->input('semester') ?? null,
                'school_year' => $request->input('school_yr') ?? null,
                'year_level' => $request->input('year_lvl') ?? null,
            ]; 
            Subject::create($data);
        }
    
        return redirect()->route('subject.home')->with('success', 'Subject created successfully!');
    }

    public function editSubject($id)
    {
        $subject = Subject::select('subjects.*', 'course.short_name as course')
                ->leftJoin('course', 'subjects.course_id', '=', 'course.id')
                ->where('subjects.id', $id)
                ->first();

        // Generate dynamic school year options
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
        $schoolYears = [];
        for ($i = $currentYear; $i < $nextYear + 5; $i++) {
            $schoolYears[] = $i . '-' . ($i + 1);
        }

        $year_level = array(
            '1' => "1st Year",
            '2' => "2nd Year",
            '3' => "3rd Year",
            '4' => "4th Year"
        );

        $semester = array(
            '1' => "1st",
            '2' => "2nd",
        );

        $subj_type = array(
            '1' => "Major",
            '2' => "Minor",
        );

        return response()->json([
            'subject' => $subject,
            'school_years' => $schoolYears,
            'year_level' => $year_level,
            'semester' => $semester,
            'subj_type' => $subj_type
        ]);
    }

    public function updateSubject(Request $request) {
        if (empty($request->input())) {
            return false;
        }

        if (empty($request->input('_token'))) {
            return false;
        }
        $id = $request->input('subject_id');

        $subject = Subject::find($id);

        $result = $subject->update($request->except('_token'));

        if ($result) {
            return redirect()->route('subject.home')->with('success', 'Subject updated successfully!');
        }
    }
}

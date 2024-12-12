<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index() {

        if (request()->ajax()) {
            $query = Subject::select(
                'subjects.*'
            );
            return DataTables::make($query)->make(true);    
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
                'subj_prereq' => $request->input('subj_prereq')[$index] ?? null,
                'subj_type' => $request->input('subj_type')[$index] ?? null,
                'semester' => $request->input('semester') ?? null,
                'school_year' => $request->input('school_yr') ?? null,
                'year_level' => $request->input('year_lvl') ?? null,
            ]; 
            Subject::create($data);
        }
    
        return redirect()->route('subject.home')->with('success', 'Subject created successfully!');
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index() {

        return view('subject.index');
    }

    public function insertSubject(Request $request) {
        echo '<pre>';
        var_dump($request->input());
        echo '</pre>';

        $data[] = array();

        foreach($request->input('subj_code') as $index => $subj_code) {
            $data['subj_code'] = $subj_code; 
        }
            
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
        Subject::create($data);
   
    }
}

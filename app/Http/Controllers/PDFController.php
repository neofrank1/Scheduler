<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\Subject;
use App\Models\Professor;
use App\Models\Room;
use App\Models\Section;
use App\Models\Schedule;
use App\Models\TimeSlot;
use App\Models\Course;
use App\Models\College;
use Yajra\DataTables\DataTables;
use PDF;

class PDFController extends Controller
{
    public function prospectus()
    {   
        if (request()->ajax()) {
            $query = Course::select('course.*', 'college.short_name as department')
            ->leftJoin('college', 'course.college_id', '=', 'college.id')
            ->where('college_id', Auth::user()->college_id)
            ->where('course.id', Auth::user()->course_id);
            
            return DataTables::of($query)->make(true);    
        }
        return view('pdf.prospectus_home');
    }

    public function generateProspectus($id)
    {
        $subject = Subject::select('subjects.*')
                ->leftJoin('course', 'course.id', '=', 'subjects.course_id')
                ->where('subjects.course_id', $id)
                ->where('subjects.status', 1)
                ->get();
        $course = Course::find($id)->toArray();
        $data = [
            'school_year' => date('Y') . '-' . (date('Y') + 1),
            'course' => $course['short_name'] . '-' . $course['full_name'],
            'subjects' => $subject->toArray()
        ];
        /* echo "<pre>";
            print_r($data);
        echo "</pre>";
        die(); */
        return view('pdf.prospectus_result', ['data' => $data]);

    }

}

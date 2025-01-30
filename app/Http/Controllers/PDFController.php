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

        return view('pdf.prospectus_result', ['data' => $data]);

    }

    public function mis() {
        
        if (request()->ajax()) {
            $query = Section::select('section.*')
            ->where('college_id', Auth::user()->college_id)
            ->where('course_id', Auth::user()->course_id);
            
            return DataTables::of($query)->make(true);    
        }

        return view('pdf.mis_home');
    }

    public function generateMIS($id) {

        $schedule = TimeSlot::select('time_slot.*', 'schedule.*', 'subjects.subj_code', 'subjects.subj_desc', 'professors.first_name', 'professors.last_name', 'rooms.*', 'section.name')
                    ->leftJoin('schedule', 'time_slot.schedule_id', '=', 'schedule.id')
                    ->leftJoin('subjects', 'schedule.subject_id', '=', 'subjects.id')
                    ->leftJoin('professors', 'schedule.prof_id', '=', 'professors.id')
                    ->leftJoin('rooms', 'schedule.room_id', '=', 'rooms.id')
                    ->leftJoin('section', 'schedule.section_id', '=', 'section.id')
                    ->where('schedule.section_id', $id)
                    ->get();
        $data = [
            'school_year' => date('Y') . '-' . (date('Y') + 1),
            'schedule' => $schedule->toArray()
        ];

        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die();

        return view('pdf.mis_result');
    }
}

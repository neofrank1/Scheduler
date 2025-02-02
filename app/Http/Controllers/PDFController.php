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

        $schedule = TimeSlot::select('time_slot.*', 'schedule.*', 'subjects.subj_code', 'subjects.subj_desc', 'subjects.subj_lec_hours', 'subjects.subj_lab_hours', 'subjects.subj_units', 'professors.first_name', 'professors.last_name', 'professors.middle_name', 'rooms.*')
                    ->leftJoin('schedule', 'time_slot.schedule_id', '=', 'schedule.id')
                    ->leftJoin('subjects', 'schedule.subject_id', '=', 'subjects.id')
                    ->leftJoin('professors', 'schedule.prof_id', '=', 'professors.id')
                    ->leftJoin('rooms', 'schedule.room_id', '=', 'rooms.id')
                    ->where('schedule.section_id', $id)
                    ->get();

        $college = College::find(Auth::user()->college_id)->toArray();
        $section = Section::find($id)->toArray();
        $schedule = $schedule->toArray();
        $course = Course::find(Auth::user()->course_id)->toArray();

        $groupedSchedule = [];
        foreach ($schedule as $value) {
            if (!isset($groupedSchedule[$value['schedule_id']])) {
                $groupedSchedule[$value['schedule_id']] = $value;
                $groupedSchedule[$value['schedule_id']]['days'] = [];
                $groupedSchedule[$value['schedule_id']]['start_times'] = [];
                $groupedSchedule[$value['schedule_id']]['end_times'] = [];
            }
            match ($value['day']) {
                '1' => $value['day'] = 'Mon',
                '2' => $value['day'] = 'Tue',
                '3' => $value['day'] = 'Wed',
                '4' => $value['day'] = 'Thu',
                '5' => $value['day'] = 'Fri',
                '6' => $value['day'] = 'Sat',
                '7' => $value['day'] = 'Sun',
            };
            $groupedSchedule[$value['schedule_id']]['days'][] = $value['day'];
            $start_time = date('h:i A', strtotime($value['start_time']));
            if (!in_array($start_time, $groupedSchedule[$value['schedule_id']]['start_times'])) {
                $groupedSchedule[$value['schedule_id']]['start_times'][] = $start_time;
            }
            $end_time = date('h:i A', strtotime($value['end_time']));
            if (!in_array($end_time, $groupedSchedule[$value['schedule_id']]['end_times'])) {
                $groupedSchedule[$value['schedule_id']]['end_times'][] = $end_time;
            }
            unset($groupedSchedule[$value['schedule_id']]['day']);
            unset($groupedSchedule[$value['schedule_id']]['start_time']);
            unset($groupedSchedule[$value['schedule_id']]['end_time']);
        }
        $schedules = $groupedSchedule;
        
        $data = [
            'college' => $college['short_name'],
            'school_year' => $schedule[0]['school_yr'],
            'semester' => $schedule[0]['semester'],
            'schedule' => $schedules,
            'section' => $section['name'],
            'course' => $course['short_name'] . '-' . $course['full_name']
        ];

        return view('pdf.mis_result', ['data' => $data]);
    }

    public function pbt() {

        if (request()->ajax()) {
            $query = Section::select('section.*')
            ->where('college_id', Auth::user()->college_id)
            ->where('course_id', Auth::user()->course_id);
            
            return DataTables::of($query)->make(true);    
        }

        return view('pdf.pbt_home');
    }

    public function generatePBT($id) {
        
    }

    public function pbr() {

        if (request()->ajax()) {
            $query = Schedule::select('schedule.*', 'rooms.*')
                    ->leftJoin('rooms', 'schedule.room_id', '=', 'rooms.id')
                    ->where('schedule.course_id', Auth::user()->course_id)
                    ->where('rooms.college_id', Auth::user()->college_id)
                    ->get();

            return DataTables::of($query)->make(true);    
        }

        return view('pdf.pbr_home');
    }

    public function generatePBR($id) {
        
        $timeSlots = [
            '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'
        ];

        $college = College::find(Auth::user()->college_id)->toArray();
        $course = Course::find(Auth::user()->course_id)->toArray();
        $schedule = TimeSlot::select('time_slot.*', 'schedule.*', 'subjects.subj_code', 'subjects.subj_desc', 'subjects.subj_lec_hours', 'subjects.subj_lab_hours', 'subjects.subj_units', 'professors.first_name', 'professors.last_name', 'professors.middle_name', 'rooms.*')
                    ->leftJoin('schedule', 'time_slot.schedule_id', '=', 'schedule.id')
                    ->leftJoin('subjects', 'schedule.subject_id', '=', 'subjects.id')
                    ->leftJoin('professors', 'schedule.prof_id', '=', 'professors.id')
                    ->leftJoin('rooms', 'schedule.room_id', '=', 'rooms.id')
                    ->where('rooms.id', $id)
                    ->where('rooms.college_id', Auth::user()->college_id)
                    ->get();

        $schedule = $schedule->toArray();
        $data = [
            'college' => $college['short_name'],
            'school_year' => date('Y') . '-' . (date('Y') + 1),
            'course' => $course['short_name'] . '-' . $course['full_name'],
            'semester' => $schedule[0]['semester'],
            'schedule' => $schedule,
            'time_slots' => $timeSlots
        ];

        echo '<pre>';
        print_r($data);
        echo '</pre>';


        return view('pdf.pbr_result', ['data' => $data]);
    }
}

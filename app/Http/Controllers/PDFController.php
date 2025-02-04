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
            $query = Schedule::select(
                        'schedule.semester',
                        'schedule.school_yr',
                        'schedule.prof_id',
                        'professors.first_name',
                        'professors.last_name',
                        DB::raw('count(schedule.prof_id) as prof_count')
                    )
                    ->leftJoin('professors', 'schedule.prof_id', '=', 'professors.id')
                    ->where('schedule.course_id', Auth::user()->course_id)
                    ->groupBy('schedule.prof_id', 'schedule.semester', 'schedule.school_yr', 'professors.first_name', 'professors.last_name')
                    ->get();
        
            return DataTables::of($query)->make(true);    
        }

        return view('pdf.pbt_home');
    }

    public function generatePBT($id, $semester, $school_yr) {
        $timeSlots = [
            '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'
        ];

        $college = College::find(Auth::user()->college_id)->toArray();
        $course = Course::find(Auth::user()->course_id)->toArray();
        $professor = Professor::find($id)->toArray();
        $schedule = TimeSlot::select('time_slot.*', 'schedule.*', 'subjects.subj_code', 'subjects.subj_desc', 'subjects.subj_lec_hours', 'subjects.subj_lab_hours', 'subjects.subj_units','professors.first_name', 'professors.last_name', 'professors.middle_name', 'rooms.*', 'section.name as section_name', 'section.program')
                    ->leftJoin('schedule', 'time_slot.schedule_id', '=', 'schedule.id')
                    ->leftJoin('subjects', 'schedule.subject_id', '=', 'subjects.id')
                    ->leftJoin('professors', 'schedule.prof_id', '=', 'professors.id')
                    ->leftJoin('rooms', 'schedule.room_id', '=', 'rooms.id')
                    ->leftJoin('section', 'schedule.section_id', '=', 'section.id')
                    ->where('schedule.semester', $semester)
                    ->where('schedule.school_yr', $school_yr)
                    ->where('schedule.prof_id', $id)
                    ->get();

        $summary = Schedule::select('schedule.*', 'subjects.*', 'section.name as section_name')
                    ->leftJoin('subjects', 'schedule.subject_id', '=', 'subjects.id')
                    ->leftJoin('section', 'schedule.section_id', '=', 'section.id')
                    ->where('schedule.course_id', Auth::user()->course_id)
                    ->where('schedule.semester', $semester)
                    ->where('schedule.school_yr', $school_yr)
                    ->where('schedule.prof_id', $id)
                    ->get();

        $schedule = $schedule->toArray();
        $summary = $summary->toArray();
        $data = [
            'college' => $college['short_name'],
            'school_year' => date('Y') . '-' . (date('Y') + 1),
            'course' => $course['short_name'] . '-' . $course['full_name'],
            'semester' => $schedule[0]['semester'],
            'schedule' => $schedule,
            'section' => $schedule[0]['section_name'],
            'program' => $schedule[0]['program'] == 1 ? 'Day' : 'Evening',
            'time_slots' => $timeSlots,
            'summary' => $summary,
            'professor' => $professor
        ];

        return view('pdf.pbt_result', ['data' => $data]);
    }

    public function pbr() {

        if (request()->ajax()) {
            $query = Schedule::select(
                        'schedule.room_id',
                        'rooms.building_name',
                        'rooms.floor_number',
                        'rooms.room_number',
                        'schedule.semester',
                        'schedule.school_yr',
                        DB::raw('count(schedule.room_id) as room_count')
                    )
                    ->leftJoin('rooms', 'schedule.room_id', '=', 'rooms.id')
                    ->where('schedule.course_id', Auth::user()->course_id)
                    ->where('rooms.college_id', Auth::user()->college_id)
                    ->groupBy('schedule.room_id', 'rooms.building_name', 'rooms.floor_number', 'rooms.room_number','schedule.semester', 'schedule.school_yr')
                    ->get();
        
            return DataTables::of($query)->make(true);    
        }

        return view('pdf.pbr_home');
    }
    public function generatePBR($id, $semester, $school_yr) {
        
        $timeSlots = [
            '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'
        ];

        $college = College::find(Auth::user()->college_id)->toArray();
        $course = Course::find(Auth::user()->course_id)->toArray();
        $room = Room::find($id)->toArray();
        $schedule = TimeSlot::select('time_slot.*', 'schedule.*', 'subjects.subj_code', 'subjects.subj_desc', 'subjects.subj_lec_hours', 'subjects.subj_lab_hours', 'subjects.subj_units', 'professors.first_name', 'professors.last_name', 'professors.middle_name', 'rooms.*', 'section.name as section_name')
                    ->leftJoin('schedule', 'time_slot.schedule_id', '=', 'schedule.id')
                    ->leftJoin('subjects', 'schedule.subject_id', '=', 'subjects.id')
                    ->leftJoin('professors', 'schedule.prof_id', '=', 'professors.id')
                    ->leftJoin('rooms', 'schedule.room_id', '=', 'rooms.id')
                    ->leftJoin('section', 'schedule.section_id', '=', 'section.id')
                    ->where('rooms.id', $id)
                    ->where('rooms.college_id', Auth::user()->college_id)
                    ->where('schedule.semester', $semester)
                    ->where('schedule.school_yr', $school_yr)
                    ->get();

        $schedule = $schedule->toArray();
        $data = [
            'college' => $college['short_name'],
            'school_year' => date('Y') . '-' . (date('Y') + 1),
            'course' => $course['short_name'] . '-' . $course['full_name'],
            'semester' => $schedule[0]['semester'],
            'schedule' => $schedule,
            'time_slots' => $timeSlots,
            'room' => sprintf('%s %s%02d', $room['building_name'], $room['floor_number'], $room['room_number'])
        ];

        return view('pdf.pbr_result', ['data' => $data]);
    }

    public function pbs() {

        if (request()->ajax()) {
            $query = Schedule::select(
                        'schedule.section_id',
                        'schedule.semester',
                        'schedule.school_yr',
                        'section.name',
                        'section.program',
                        DB::raw('count(schedule.section_id) as section')
                    )
                    ->leftJoin('section', 'schedule.section_id', '=', 'section.id')
                    ->where('schedule.course_id', Auth::user()->course_id)
                    ->groupBy('schedule.section_id', 'schedule.semester', 'schedule.school_yr', 'section.name', 'section.program')
                    ->get();
        
            return DataTables::of($query)->make(true);    
        }

        return view ('pdf.pbs_home');
    }

    public function generatePBS($section, $semester, $school_yr, $program) {

        $timeSlots = [
            '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'
        ];

        $college = College::find(Auth::user()->college_id)->toArray();
        $course = Course::find(Auth::user()->course_id)->toArray();
        $schedule = TimeSlot::select('time_slot.*', 'schedule.*', 'subjects.subj_code', 'subjects.subj_desc', 'subjects.subj_lec_hours', 'subjects.subj_lab_hours', 'subjects.subj_units','professors.first_name', 'professors.last_name', 'professors.middle_name', 'rooms.*', 'section.name as section_name', 'section.program')
                    ->leftJoin('schedule', 'time_slot.schedule_id', '=', 'schedule.id')
                    ->leftJoin('subjects', 'schedule.subject_id', '=', 'subjects.id')
                    ->leftJoin('professors', 'schedule.prof_id', '=', 'professors.id')
                    ->leftJoin('rooms', 'schedule.room_id', '=', 'rooms.id')
                    ->leftJoin('section', 'schedule.section_id', '=', 'section.id')
                    ->where('schedule.section_id', $section)
                    ->where('schedule.semester', $semester)
                    ->where('schedule.school_yr', $school_yr)
                    ->where('section.program', $program)
                    ->get();

        $summary = Schedule::select('schedule.*', 'subjects.*')
                    ->leftJoin('subjects', 'schedule.subject_id', '=', 'subjects.id')
                    ->where('schedule.course_id', Auth::user()->course_id)
                    ->where('schedule.section_id', $section)
                    ->where('schedule.semester', $semester)
                    ->where('schedule.school_yr', $school_yr)
                    ->get();

        $schedule = $schedule->toArray();
        $summary = $summary->toArray();
        $data = [
            'college' => $college['short_name'],
            'school_year' => date('Y') . '-' . (date('Y') + 1),
            'course' => $course['short_name'] . '-' . $course['full_name'],
            'semester' => $schedule[0]['semester'],
            'schedule' => $schedule,
            'section' => $schedule[0]['section_name'],
            'program' => $schedule[0]['program'] == 1 ? 'Day' : 'Evening',
            'time_slots' => $timeSlots,
            'summary' => $summary
        ];

        return view ('pdf.pbs_result', ['data' => $data]);
    }
}

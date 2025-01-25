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
use Yajra\DataTables\DataTables;

class ScheduleController extends Controller
{
    public function index()
    {
        $subjects = Subject::getSubjectsByCourseId(Auth::user()->course_id);
        $professors = Professor::getProfessorByCourseId(Auth::user()->course_id);
        $sections = Section::getSectionByCourseId(Auth::user()->course_id);
        $rooms = Room::get();

        if (request()->ajax()) {
            $query = Schedule::select('schedule.*', 'course.short_name as course', 'section.name as section', 'subjects.subj_code as subject', DB::raw('CONCAT(professors.first_name, " ", professors.last_name) as professor'))
            ->leftJoin('section', 'schedule.section_id', '=', 'section.id')
            ->leftJoin('subjects', 'schedule.subject_id', '=', 'subjects.id')
            ->leftJoin('professors', 'schedule.prof_id', '=', 'professors.id')
            ->leftJoin('course', 'schedule.course_id', '=', 'course.id');
            
            return DataTables::of($query)->make(true);    
        }

        return view('schedule.index')->with(compact('subjects','professors', 'rooms', 'sections'));
    }

    public function insertSchedule(Request $request) {
        if(empty($request->input('_token'))) {
            return;
        }
        foreach($request->input('subjects') as $value) {
            
            $data = array(
                'course_id' => Auth::user()->course_id,
                'section_id' => $request->input('section_id'),
                'semester' => $request->input('semester'),
                'school_yr' => $request->input('school_year'),
                'subject_id' => $value['subject_id'],
                'room_id' => $value['room_id'],
                'prof_id' => $value['professor_id'],
                'status' => 1
            );

            if ($data != null) {
                $res = Schedule::create($data);
                $lastInsertedId = $res->id;
            }

            if ($lastInsertedId) {
                foreach($value['days'] as $day) {
                    $data = array(
                        'schedule_id' => $lastInsertedId,
                        'start_time' => isset($day['start_time']) ? $day['start_time'] : null,
                        'end_time' => isset($day['end_time']) ? $day['end_time'] : null,
                        'day' => $day['day'],
                    );
                    
                    if ($data['start_time'] == null && $data['end_time'] == null) {
                        return redirect()->route('schedule.home')->with('error', 'Please fill up all fields!');
                    } else {
                        $res = TimeSlot::create($data);
                    }
                }   
            }
        }

        if ($res) {
            return redirect()->route('schedule.home')->with('error', 'Schedule created successfully!');
        }
    }

    public function editSchedule($id)
    {
        $subjects = Subject::getSubjectsByCourseId(Auth::user()->course_id);
        $professors = Professor::getProfessorByCourseId(Auth::user()->course_id);
        $sections = Section::getSectionByCourseId(Auth::user()->course_id);
        $rooms = Room::get();

        if (request()->ajax()) {
            $query = TimeSlot::select('time_slot.schedule_id', 'subjects.subj_code as subject_name')
                ->leftJoin('schedule', 'time_slot.schedule_id', '=', 'schedule.id')
                ->leftJoin('subjects', 'schedule.subject_id', '=', 'subjects.id')
                ->where('time_slot.schedule_id', $id)
                ->groupBy('time_slot.schedule_id', 'subjects.subj_code')
                ->get();

            return DataTables::of($query)->make(true);    
        }
        return view('schedule.edit')->with(compact('subjects','professors', 'rooms', 'sections'));
    }

    public function getTimsSlot($id) {
        
        if (empty($id)) {
            return false;
        }

        if (request()->ajax()) {
            $timeSlots = Schedule::getTimeSlotBySchedule($id);
            return response()->json($timeSlots);
        }
    }
}

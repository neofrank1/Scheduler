<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Professor;
use App\Models\Room;
use App\Models\Section;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $subjects = Subject::getSubjectsByCourseId(Auth::user()->course_id);
        $professors = Professor::getProfessorByCourseId(Auth::user()->course_id);
        $sections = Section::getSectionByCourseId(Auth::user()->course_id);
        $rooms = Room::get();

        return view('schedule.index')->with(compact('subjects','professors', 'rooms', 'sections'));
    }

    public function insertSchedule(Request $request) {
        if(empty($request->input('_token'))) {
            return;
        }
        foreach($request->input('subjects') as $value) {
            foreach($value['days'] as $day) {
                $data = array(
                    'subject_id' => $value['subject_id'],
                    'prof_id' => $value['professor_id'],
                    'room_id' => $value['room_id'],
                    'course_id' => Auth::user()->course_id,
                    'section_id' => $request->input('section_id'),
                    'semester' => $request->input('semester'),
                    'school_yr' => $request->input('school_year'),
                    'start_time' => isset($day['start_time']) ? $day['start_time'] : null,
                    'end_time' => isset($day['end_time']) ? $day['end_time'] : null,
                    'day' => $day['day'],
                    'status' => 1
                );
                
                if ($data['start_time'] == null && $data['end_time'] == null) {
                    return redirect()->route('schedule.home')->with('error', 'Please fill up all fields!');
                } else {
                     $res = Schedule::create($data);
                }
            }   
        }

        if ($res) {
            return redirect()->route('schedule.home')->with('error', 'Schedule created successfully!');
        }
    }
}

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
            return redirect()->route('schedule.home')->with('success', 'Schedule created successfully!');
        }
    }

    public function editSchedule($id)
    {
        $subjects = Subject::getSubjectsByCourseId(Auth::user()->course_id);
        $professors = Professor::getProfessorByCourseId(Auth::user()->course_id);
        $sections = Section::getSectionByCourseId(Auth::user()->course_id);
        $rooms = Room::get();

        $timesched = $this->getTimeSlot($id)->toArray();
        $timesched = array_combine(range(1, count($timesched)), array_values($timesched));

        return view('schedule.edit')->with(compact('subjects','professors', 'rooms', 'sections', 'timesched'));
    }

    public function editSchedule2($id)
    {
        $subjects = Subject::getSubjectsByCourseId(Auth::user()->course_id);
        $professors = Professor::getProfessorByCourseId(Auth::user()->course_id);
        $sections = Section::getSectionByCourseId(Auth::user()->course_id);
        $rooms = Room::get();
        $schedule = Schedule::find($id);

        return view('schedule.edit2')->with(compact('subjects','professors', 'rooms', 'sections', 'schedule'));
    }

    public function getTimeSlot($id) {
        
        if (empty($id)) {
            return false;
        }

        $timeSlots = Schedule::getTimeSlotBySchedule($id);
        return $timeSlots;
    }

    public function updateTimeSlot(Request $request) {
        if(empty($request->input('_token'))) {
            return;
        }
        
        $data = $request->input('timeslot');

        foreach($data as $timeslots) {
            foreach($timeslots as $timeslot) {
                $arr = [
                    'start_time' => $timeslot['start_time'] ?? null,
                    'end_time' => $timeslot['end_time'] ?? null,
                    'day' => $timeslot['day'] ?? null,
                    'schedule_id' => $timeslot['schedule_id'] ?? null,
                ];

                if ($arr['start_time'] != null && $arr['end_time'] != null && $arr['day'] != null && $arr['schedule_id'] != null && isset($timeslot['id']) && $timeslot['id'] != null) {
                    $res = TimeSlot::where('id', $timeslot['id'])
                               ->where('schedule_id', $timeslot['schedule_id'])
                               ->update($arr); 
                } else if ($arr['start_time'] != null && $arr['end_time'] != null && $arr['day'] != null && $arr['schedule_id'] != null) {
                    $res = TimeSlot::create($arr);
                } else if ($arr['start_time'] == null && $arr['end_time'] == null && $arr['day'] != null && $arr['schedule_id'] != null && isset($timeslot['id']) && $timeslot['id'] != null) {
                    $res = TimeSlot::where('id', $timeslot['id'])
                               ->where('schedule_id', $timeslot['schedule_id'])
                               ->delete();
                }
            }
        }

        if ($res) {
            return redirect()->route('schedule.home')->with('success', 'Schedule updated successfully!');
        }
    }

    public function updateSchedule(Request $request) {
        if(empty($request->input('_token'))) {
            return;
        }

        $data = $request->input();

        $schedule = Schedule::find($data['id']);
        $result = $schedule->update($data);

        if ($result) {
            return redirect()->route('schedule.home')->with('success', 'Schedule updated successfully!');
        }
    }

    public function updateStatus(Request $request) {
        if(empty($request->input('_token'))) {
            return;
        }

        if ($request->ajax()) {
            $schedule = Schedule::find($request->input('id'));
            if ($schedule) {
                $status = $request->input('status');
                $result = $schedule->save($status);

                if ($result) {
                    $message = $request->input('status') == 1 ? 'Schedule activated successfully!' : 'Schedule deactivated successfully!';
                    return response()->json(['success' => true, 'message' => $message]);
                }
            }
            return response()->json(['success' => false, 'message' => 'Failed to update schedule status.']);
        }
    }
}

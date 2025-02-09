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
        foreach($request->input('subjects') as $key => $value) {
            
            $data1 = array(
                'course_id' => Auth::user()->course_id,
                'section_id' => $request->input('section_id'),
                'semester' => $request->input('semester'),
                'school_yr' => $request->input('school_year'),
                'subject_id' => $value['subject_id'],
                'room_id' => $value['room_id'],
                'prof_id' => $value['professor_id'],
                'status' => 1
            );

            if ($data1 != null) {
                foreach($value['days'] as $day) {
                    $data = array(
                        'start_time' => isset($day['start_time']) ? $day['start_time'] : null,
                        'end_time' => isset($day['end_time']) ? $day['end_time'] : null,
                        'day' => $day['day'],
                    );

                    $conflict = $this->checkDataSchedule([
                        'room_id' => $data1['room_id'],
                        'semester' => $data1['semester'],
                        'school_yr' => $data1['school_yr'],
                        'start_time' => $data['start_time'],
                        'end_time' => $data['end_time'],
                        'day' => $data['day'],
                        'prof_id' => $data1['prof_id'],
                        'section_id' => $data1['section_id']
                    ]);

                    if ($conflict) {
                        return redirect()->back()->with('error', 'Schedule conflict detected!');
                    }
                }   

                $res = Schedule::create($data1);
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
                        continue;
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
        $timesched = array_combine(array_column($timesched, 'day'), array_values($timesched));

        return view('schedule.edit')->with(compact('subjects','professors', 'rooms', 'sections', 'timesched', 'id'));
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

    public function checkDataSchedule($data)
    {
        try {
            $query = "SELECT COUNT(*) as count 
                    FROM schedule AS scheduled
                    LEFT JOIN time_slot AS day_time ON scheduled.id = day_time.schedule_id
                    WHERE scheduled.status = 1 
                    AND (
                        (scheduled.room_id = :room_id AND scheduled.school_yr = :school_yr1 AND scheduled.semester = :semester1 
                        AND day_time.start_time <= :end_time1 AND day_time.end_time >= :start_time1 AND day_time.day = :day1) 
                        OR 
                        (scheduled.prof_id = :prof_id AND scheduled.school_yr = :school_yr2 AND scheduled.semester = :semester2 
                        AND day_time.start_time <= :end_time2 AND day_time.end_time >= :start_time2 AND day_time.day = :day2)
                        OR 
                        (scheduled.section_id = :section_id AND scheduled.school_yr = :school_yr3 AND scheduled.semester = :semester3 
                        AND day_time.start_time <= :end_time3 AND day_time.end_time >= :start_time3 AND day_time.day = :day3)
                    )";

            // Convert time format correctly and ensure all data keys exist
            $params = [
                'room_id' => $data['room_id'] ?? null,
                'prof_id' => $data['prof_id'] ?? null,
                'school_yr1' => $data['school_yr'] ?? null,
                'semester1' => $data['semester'] ?? null,
                'start_time1' => isset($data['start_time']) ? date('H:i:s', strtotime($data['start_time'])) : null,
                'end_time1' => isset($data['end_time']) ? date('H:i:s', strtotime($data['end_time'])) : null,
                'day1' => $data['day'] ?? null,
                'school_yr2' => $data['school_yr'] ?? null,
                'semester2' => $data['semester'] ?? null,
                'start_time2' => isset($data['start_time']) ? date('H:i:s', strtotime($data['start_time'])) : null,
                'end_time2' => isset($data['end_time']) ? date('H:i:s', strtotime($data['end_time'])) : null,
                'day2' => $data['day'] ?? null,
                'section_id' => $data['section_id'] ?? null,
                'school_yr3' => $data['school_yr'] ?? null,
                'semester3' => $data['semester'] ?? null,
                'start_time3' => isset($data['start_time']) ? date('H:i:s', strtotime($data['start_time'])) : null,
                'end_time3' => isset($data['end_time']) ? date('H:i:s', strtotime($data['end_time'])) : null,
                'day3' => $data['day'] ?? null,
            ];

            $result = DB::select($query, $params);

            return isset($result[0]) && $result[0]->count != 0;
        } catch (\Exception $e) {
            return false;
        }
    }

}

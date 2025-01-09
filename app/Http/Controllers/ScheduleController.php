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
        echo '<pre>';
        var_dump($request->input('schedule'));
        echo '</pre>';
        $data = array();
        $schedule = $request->input('schedule');
        foreach($schedule['subjects'] as $subj) {

            echo '<pre>';
            print_r($schedule['subjects']);
            echo '</pre>';
            //Schedule::create($data);

        }
        
        die();
        return redirect()->route('subject.home')->with('success', 'Subject created successfully!');
    }
}

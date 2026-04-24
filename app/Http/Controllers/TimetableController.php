<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
   
    public function index()
    {
        $data['days'] = Day::all();
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.timetable.create', $data);
    }

    public function store(Request $request)
    {
        $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        
        foreach ($request->timetable as $timetable){
            $day_id = $timetable['day_id'];
            $start_time = $timetable['start_time'];
            $end_time = $timetable['end_time'];
            $room_no = $timetable['room_no'];

            if (!empty($start_time) && !empty($end_time) && !empty($room_no)) {
                Timetable::updateOrCreate(
                    [
                        'class_id' => $class_id,
                        'subject_id' => $subject_id,
                        'day_id' => $day_id,
                    ],
                    [
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'room_no' => $room_no,
                    ]
                );
            } else {
                // Optional: If you want to remove the record when fields are empty
                Timetable::where('class_id', $class_id)
                         ->where('subject_id', $subject_id)
                         ->where('day_id', $day_id)
                         ->delete();
            }
        }
        return redirect()->back()->with('success', 'Timetable saved successfully.');
    }

    public function read(Request $request)
    {
        $data['classes'] = Classes::all();
        $timetables = Timetable::with('class','subject','day');
        if($request->class_id){
            $timetables->where('class_id', $request->class_id);
        }
        if($request->subject_id){
            $timetables->where('subject_id', $request->subject_id);
        }
        $data['timetables'] = $timetables->get();
        return view('admin.timetable.list', $data);
    }

    public function delete($id)
    {
        $timetable = Timetable::find($id);
        $timetable->delete();
        return redirect()->route('timetable.read')->with('success', 'Timetable deleted successfully.');
    }
}
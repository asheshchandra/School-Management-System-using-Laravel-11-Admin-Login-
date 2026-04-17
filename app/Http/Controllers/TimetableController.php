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
        dd($request->all());
    }
}
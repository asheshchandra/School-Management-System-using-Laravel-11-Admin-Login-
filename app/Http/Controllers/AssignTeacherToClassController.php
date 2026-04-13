<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\User;
use App\Models\subject;
use App\Models\classes;
use App\Models\AssignTeacherToClass;
use App\Models\AssignTeacherToClass as ModelsAssignTeacherToClass;
// use App\Models\updateOrCreate;
use Illuminate\Http\Request;

class AssignTeacherToClassController extends Controller
{
    public function index()
    {
        $data['classes'] = classes::all();
        $data['teachers'] = User::where('role', 'teacher')->get();
        $data['subjects'] = subject::all();
        return view('admin.assign-teacher.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id'=>'required',
            'subject_id'=>'required',
            'teacher_id'=>'required',
        ]);
        AssignTeacherToClass::updateOrCreate(
            [
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
            ],
            [
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'teacher_id' => $request->teacher_id,
            ]
        );
        return redirect()->route('assign-teacher.create')->with('success', 'Teacher with Assigned Successfulli');
    }

    public function findSubject(Request $request)
    {
        $class_id = $request->class_id;
        $subject = AssignSubjectToClass::with('subject')->where('class_id', $class_id)->get();
        return response()->json([
            'status' => true,
            'subject' => $subject
        ]);
    }
}

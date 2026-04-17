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
        $data['subjects'] = collect();
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

    public function read(Request $request)
    {
        $data['classes'] = classes::all();
        $query = AssignTeacherToClass::with(['class','subject','teacher']);
        if($request->class_id){
            $query->where('class_id', $request->class_id);
        }
        $data['assign_teachers'] = $query->latest()->get();
        return view('admin.assign-teacher.list', $data);
    }

    public function delete($id)
    {
        $res = AssignTeacherToClass::find($id);
        $res->delete();
        return redirect()->route('assign-teacher.read')->with('success', 'Teacher with Assigned Deleted Successfully');
    }

    public function edit($id)
    {
        $data['assign_teacher'] = AssignTeacherToClass::find($id);
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = User::where('role', 'teacher')->get();
        return view('admin.assign-teacher.edit_form', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'class_id'=>'required',
            'subject_id'=>'required',
            'teacher_id'=>'required',
        ]);
        $data = AssignTeacherToClass::find($id);
        $data -> class_id = $request->class_id;
        $data -> subject_id = $request->subject_id;
        $data -> teacher_id = $request->teacher_id;
        $data->update();
        return redirect()->route('assign-teacher.read')->with('success', 'Teacher with Assigned Updated Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectToClassController extends Controller
{
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.assign_subject.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);

        $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        foreach ($request->subject_id as $subjectId) {
            $isAlreadyAssigned = AssignSubjectToClass::where('class_id', $request->class_id)
                ->where('subject_id', $subjectId)
                ->first();

            if (!$isAlreadyAssigned) {
                $assignSubject = new AssignSubjectToClass();
                $assignSubject->class_id = $request->class_id;
                $assignSubject->subject_id = $subjectId;
                $assignSubject->save();
            }
        }

        return redirect()->route('assign-subject.create')->with('success', 'Subjects assigned to class successfully.');
    }
}

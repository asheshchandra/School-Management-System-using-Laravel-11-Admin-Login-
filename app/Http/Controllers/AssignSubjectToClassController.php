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
            AssignSubjectToClass::updateOrCreate(
            [
                'class_id' => $class_id,
                'subject_id' => $subjectId,
            ],
            [
                'class_id' => $class_id,
                'subject_id' => $subjectId,
            ]);
        }
        return redirect()->route('assign-subject.create')->with('success', 'Subjects assigned to class added successfully.');
    }

    public function read(Request $request)
    {
        $query = AssignSubjectToClass::with(['class', 'subject']);

        if($request->filled('class_id')){
            $query->where('class_id', $request->get('class_id'));
        }

        $data['assign_subjects'] = $query->get();
        $data['Classes'] = Classes::all();
        return view('admin.assign_subject.table', $data);
    }
    
    public function delete($id)
    {
        $res = AssignSubjectToClass::find($id);
        $res->delete();
        return redirect()->route('assign-subject.read')->with('success', 'Subjects assigned to class deleted successfully.');
    }

    public function edit($id)
    {
        $data['assign_subject'] = AssignSubjectToClass::find($id);
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.assign_subject.edit_form', $data);
    }

    public function update(Request $request, $id)
    {
        $data = AssignSubjectToClass::find($id);
        $data -> class_id = $request->class_id;
        $data -> subject_id = $request->subject_id;
        $data->update();
        return redirect()->route('assign-subject.read')->with('success', 'Subjects assigned to class updated successfully.');
    }
}

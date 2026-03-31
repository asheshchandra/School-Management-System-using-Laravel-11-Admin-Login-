<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\classes as Classes;
use App\Models\AcademicYear;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        return view('admin.student.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id'       => 'required',
            'academic_year_id' => 'required',
            'admission_date' => 'required',
            'student_name'   => 'required',
            'father_name'    => 'required',
            'mother_name'    => 'required',
            'dob'            => 'required',
            'phone'          => 'required',
            'gender'         => 'required',
            'email'          => 'required',
            'password'       => 'required|min:6',
        ]);

        $user = new User();
        $user->class_id = $request->class_id;
        $user->academic_year_id = $request->academic_year_id;
        $user->admission_date = $request->admission_date;
        $user->name = $request->student_name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'student';
        $user->save();

        return redirect()->back()->with('success', 'Student created successfully');
    }

    public function read(Request $request)
    {
        $query = User::with(['studentClass', 'studentAcademicYear'])->where('role', 'student')->latest('id');
        if($request->filled('academic_year_id')){
            $query->where('academic_year_id', $request->academic_year_id);
        }
        if($request->filled('class_id')){
            $query->where('class_id', $request->class_id);
        }
        $students = $query->get();
        $data['students'] = $students;
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        return view('admin.student.student_list', $data);
    }

    public function edit($id)
    {
        $data['student'] = User::findOrFail($id);
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        return view('admin.student.edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'             => 'required',
            'class_id'       => 'required',
            'academic_year_id' => 'required',
            'admission_date' => 'required',
            'student_name'   => 'required',
            'father_name'    => 'required',
            'mother_name'    => 'required',
            'dob'            => 'required',
            'phone'          => 'required',
            'gender'         => 'required',
            'email'          => 'required|unique:users,email,' . $request->id,
        ]);

        $user = User::findOrFail($request->id);
        $user->class_id = $request->class_id;
        $user->academic_year_id = $request->academic_year_id;
        $user->admission_date = $request->admission_date;
        $user->name = $request->student_name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->save();

        return redirect()->route('student.read')->with('success', 'Student updated successfully');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('student.read')->with('success', 'Student deleted successfully');
    }
}

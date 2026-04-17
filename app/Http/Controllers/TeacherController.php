<?php

namespace App\Http\Controllers;

use App\Models\AssignTeacherToClass;
use App\Models\AssignSubjectToClass;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return view('admin.teacher.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_name'   => 'required',
            'father_name'    => 'required',
            'mother_name'    => 'required',
            'dob'            => 'required',
            'phone'          => 'required',
            'gender'         => 'required',
            'email'          => 'required|unique:users,email',
            'password'       => 'required',
        ]);

        $user = new User();
        $user->name = $request->teacher_name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'teacher';
        $user->save();

        return redirect()->route('teacher.create')->with('success', 'Teacher created successfully');
    }

    public function read()
    {
        $data['teachers'] = User::where('role', 'teacher')->latest()->get();
        return view('admin.teacher.table', $data);
    }

    public function edit($id)
    {
        $data['teacher'] = User::find($id);
        return view('admin.teacher.edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'             => 'required',
            'teacher_name'   => 'required',
            'father_name'    => 'required',
            'mother_name'    => 'required',
            'dob'            => 'required',
            'phone'          => 'required',
            'gender'         => 'required',
            'email'          => 'required|unique:users,email,' . $request->id,
        ]);

        $user = User::find($request->id);
        $user->name = $request->teacher_name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('teacher.read')->with('success', 'Teacher updated successfully');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('teacher.read')->with('success', 'Teacher deleted successfully');
    }

    // login
    public function login()
    {
        return view('teacher.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'=> 'required',
            'password'=>'required'
        ]);
        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password])){
            if (Auth::guard('teacher')->user()->role !== 'teacher'){
                Auth::guard('teacher')->logout();
                return redirect()->route('teacher.login')->with('error', 'Unautherise user.Access denied!');
            }
            return redirect()->route('teacher.dashboard');
        }else{
            return redirect()->route('teacher.login')->with('error', 'shomething went worng');
        }
    }

    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login')->with('success', 'Logged out successfully');
    }

    public function myClass()
    {
        $teacher_id = Auth::guard('teacher')->user()->id;
        $data['assign_class'] = AssignTeacherToClass::where('teacher_id', $teacher_id)->with('class', 'subject')->get();
        return view('teacher.my_class', $data);
    }
}

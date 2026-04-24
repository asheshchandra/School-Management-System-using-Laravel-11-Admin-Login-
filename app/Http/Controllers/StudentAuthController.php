<?php

namespace App\Http\Controllers;
use App\Models\AssignTeacherToClass;
use App\Models\Timetable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Announement;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function index()
    {
        return view('student.login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('student')->user()->role != 'student') {
                Auth::guard('student')->logout();
                return redirect()->route('student.login')->with('error', 'You are not authorized to login as student');
            }
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('student.login')->with('error', 'Invalid credentials');
        }
    }

    public function dashboard()
    {
        $data['announement'] = Announement::where('type', 'student')->latest()->limit(1)->get();
        return view('student.dashboard', $data);
    }

    public function mySubject()
    {
        $class_id = Auth::guard('student')->user()->class_id;
        $data['my_subject'] = AssignTeacherToClass::where('class_id', $class_id)->with('subject', 'teacher')->get();
        return view('student.my_subject', $data);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login')->with('success', 'Logout successfully');
    }

    public function changePassword()
    {
        return view('student.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password',
        ]);
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $user = User::find(Auth::guard('student')->user()->id);
        if (Hash::check($old_password, $user->password)){
            $user->password = Hash::make($new_password);
            $user->save();
            return redirect()->route('student.change-password')->with('success','Password changed successfully');
        }else{
            return redirect()->back()->with('error','Invalid old password');
        }
    }

    public function timetable()
    {
        $class_id = Auth::guard('student')->user()->class_id;
        $timetable = Timetable::with(['day','subject'])->where('class_id', $class_id)->get();
        $group = [];
        foreach($timetable as $data){
            $group[$data->day->name][] = [
                'subject'=>$data->subject->name,
                'start_time'=>$data->start_time,
                'end_time'=>$data->end_time,
                'room_no'=>$data->room_no
            ];
        }
        $data['timetable'] = $group;
        return view('student.timetable', $data);
    }
}

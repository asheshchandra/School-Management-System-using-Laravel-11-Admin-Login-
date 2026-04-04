<?php

namespace App\Http\Controllers;

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
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role != 'student') {
                Auth::logout();
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

    public function logout()
    {
        Auth::logout();
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
        $user = User::find(Auth::user()->id);
        if (Hash::check($old_password, $user->password)){
            $user->password = Hash::make($new_password);
            $user->save();
            return redirect()->route('student.change-password')->with('success','Password changed successfully');
        }else{
            return redirect()->back()->with('error','Invalid old password');
        }
    }
}

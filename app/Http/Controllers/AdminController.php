<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function authenticate(Request $request){
        $request->validate([
            'email'=> 'required',
            'password'=>'required'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            if (Auth::guard('admin')->user()->role !== 'admin'){
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', 'Unautherise user.Access denied!');
            }
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.login')->with('error', 'shomething went worng');
        }
    }

    public function register(){
        $user = new User();
        $user -> name= 'Uttom';
        $user -> role= 'student';
        $user -> email= 'uttom@gmail.com';
        $user -> password= Hash::make('admin');
        $user->save();
        return redirect()->route('admin.login')->with('success', 'User created successfully');
    }


    public function dashboard(){
        return view('admin.dashboard');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'logout successfully!');
    }

    public function form(){
        return view('admin.form');
    }
    public function table(){
        return view('admin.table');
    }
}

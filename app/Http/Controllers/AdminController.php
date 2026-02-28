<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            echo "ok";
        }else{
            return redirect()->route('admin.loing')->with('error', 'shomething went worng');
        }
    }

    public function register(){
        $user = new User();
        $user -> name= 'Admin';
        $user -> role= 'admin';
        $user -> email= 'admin@gmail.com';
        $user -> password= 'Hash::make'('admin');
        return redirect()->route('admin.loing')->with('success', 'shomething went successfully');
    }


    public function dashboard(){
        return view('admin.dashboard');
    }

    public function form(){
        return view('admin.form');
    }
    public function table(){
        return view('admin.table');
    }
}

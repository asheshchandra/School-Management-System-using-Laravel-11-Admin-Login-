<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\classes;

class ClassesController extends Controller
{
    public function index(){
        return view('admin.class.class');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        $data = new classes();
        $data->name=$request->name;
        $data->save();
        return redirect()->route('class.create')->with('success', 'Class Added Successfully');
    }

    public function read(){
        $data['class'] = classes::get();
        return view('admin.class.class_list', $data);
    }

    public function edit($id){
        $data['class'] = classes::find($id);
        return view('admin.class.edit_class', $data);
    }

    public function update(Request $request){
        $data = classes::find($request->id);
        $data->name=$request->name;
        $data->update();
        return redirect()->route('class.read')->with('success', 'Class Updated Successfully');
    }

    public function delete($id){
        $data = classes::find($id);
        $data->delete();
        return redirect()->route('class.read')->with('success', 'Class Deleted Successfully');
    }
}

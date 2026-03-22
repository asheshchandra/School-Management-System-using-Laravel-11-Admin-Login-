<?php

namespace App\Http\Controllers;

use App\Models\FeeHead;
use Illuminate\Http\Request;

class FeeHeadController extends Controller
{
    public function index(){
        return view('admin.fee_head.fee');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        $data = new FeeHead();
        $data->name=$request->name;
        $data->save();
        return redirect()->route('fee-head.create')->with('success', 'Fee Head Added Successfully');
    }

    public function read(){
        $data['fee'] = FeeHead::latest()->get();
        return view('admin.fee_head.fee_list', $data);
    }

    public function edit($id){
        $data['fee'] = FeeHead::find($id);
        return view('admin.fee_head.edit_fee', $data);
    }

    public function update(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        $data = FeeHead::find($request->id);
        $data->name=$request->name;
        $data->save();
        return redirect()->route('fee-head.read')->with('success', 'Fee Head Updated Successfully');
    }

    public function delete($id){
        $data = FeeHead::find($id);
        $data->delete();
        return redirect()->route('fee-head.read')->with('success', 'Fee Head Deleted Successfully');
    }
}

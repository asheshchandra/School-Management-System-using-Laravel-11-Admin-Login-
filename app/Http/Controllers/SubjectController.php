<?php

namespace App\Http\Controllers;

use App\Models\subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return view('admin.subject.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);
        $subject = new subject();
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->save();
        return redirect()->route('subject.create')->with('success', 'Subject created successfully');
    }

    public function read()
    {
        $date['subjects'] = Subject::latest()->get();
        return view('admin.subject.table', $date);
    }

    public function edit($id)
    {
        $date['subject'] = Subject::find($id);
        return view('admin.subject.edit', $date);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);
        $subject = Subject::find($request->id);
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->save();
        return redirect()->route('subject.read')->with('success', 'Subject updated successfully');
    }

    public function delete($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return redirect()->route('subject.read')->with('success', 'Subject deleted successfully');
    }
}

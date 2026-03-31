<?php

namespace App\Http\Controllers;

use App\Models\Announement;
use Illuminate\Http\Request;

class AnnounementController extends Controller
{
    public function index()
    {
        return view('admin.announement.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'type' => 'required',
        ]);

        $announcement = new Announement();
        $announcement->message = $request->message;
        $announcement->type = $request->type;
        $announcement->save();

        return redirect()->route('announement.create')->with('success', 'Announcement created successfully');
    }

    public function read()
    {
        $data['announements'] = Announement::latest ()->get();
        return view('admin.announement.list', $data);
    }

}

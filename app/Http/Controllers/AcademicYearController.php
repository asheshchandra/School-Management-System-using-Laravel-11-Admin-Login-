<?php

namespace App\Http\Controllers;
use App\Models\AcademicYear;

use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index(){
        return view('admin.academic-year');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\classes;
use App\Models\AcademicYear;
use App\Models\FeeHead;
use App\Models\FeeStructure;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['academic_year'] = AcademicYear::all();
        $data['fee_head'] = FeeHead::all();
        return view('admin.fee-structure.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'academic_year_id' => 'required',
            'fee_head_id' => 'required',
        ]);

        FeeStructure::create($request->all());

        return redirect()->route('fee-structure.create')->with('success', 'Fee Structure added successfully');
    }

    public function read(Request $request)
    {
        $feeStructure = FeeStructure::query()->with('FeeHead', 'AcademicYear', 'classes')->latest();
        if($request->filled('class_id')){
            $feeStructure->where('class_id', $request->get('class_id'));
        }
        if($request->filled('academic_year_id')){
            $feeStructure->where('academic_year_id', $request->get('academic_year_id'));
        }
        $data['fee_structure'] = $feeStructure->get();
        $data['classes'] = Classes::all();
        $data['academic_year'] = AcademicYear::all();
        return view('admin.fee-structure.list', $data);
    }
    public function delete($id)
    {
        $data = FeeStructure::find($id);
        $data->delete();
        return redirect()->route('fee-structure.read')->with('success', 'Fee Structure deleted successfully');
    }

    public function edit($id)
    {
        $data['fee'] = FeeStructure::find($id);
        $data['classes'] = Classes::all();
        $data['academic_year'] = AcademicYear::all();
        $data['fee_head'] = FeeHead::all();
        return view('admin.fee-structure.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $fee = FeeStructure::find($id);
        $fee->class_id = $request->class_id;
        $fee->academic_year_id = $request->academic_year_id;
        $fee->fee_head_id = $request->fee_head_id;
        $fee->january = $request->january;
        $fee->february = $request->february;
        $fee->march = $request->march;
        $fee->april = $request->april;
        $fee->may = $request->may;
        $fee->june = $request->june;
        $fee->july = $request->july;
        $fee->august = $request->august;
        $fee->september = $request->september;
        $fee->october = $request->october;
        $fee->november = $request->november;
        $fee->december = $request->december;
        $fee->save();
        return redirect()->route('fee-structure.read')->with('success', 'Fee Structure updated successfully');
    }
}

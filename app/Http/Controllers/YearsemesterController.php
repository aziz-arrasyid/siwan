<?php

namespace App\Http\Controllers;

use App\Models\Yearsemester;
use Illuminate\Http\Request;

class YearsemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dataYearSemesters.index')->with([
            'yearSemesters' => Yearsemester::all(),
            'dataTitle' => 'Data T/A & Semester',
            'addData' => 'Add T/A & Semester',
            'editData' => 'Edit T/A & Semester'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                'tahunAjar' => 'required',
                'semester' => 'required',
            ],
            [
                'tahunAjar.required' => 'T/A tidak boleh kosong',
                'semester.required' => 'semester tidak boleh kosong'
            ]
        );

        $yearsemester = Yearsemester::create($request->all());
        $message = 'Data ' . $yearsemester->tahunAjar . ' semester ' . $yearsemester->semester. ' berhasil ditambahkan.';
        return redirect()->route('data-ta-semester.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Yearsemester $yearsemester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Yearsemester $data_ta_semester)
    {
        return response()->json($data_ta_semester);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Yearsemester $data_ta_semester)
    {
        $request->validate([
                'tahunAjar' => 'required',
                'semester' => 'required'
            ],
            [
                'tahunAjar.required' => 'T/A tidak boleh kosong',
                'semester.required' => 'semester tidak boleh kosong'
            ]
        );

        $data_ta_semester->update($request->all());
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Yearsemester $data_ta_semester)
    {
        $data_ta_semester->delete();
        return response()->json();
    }
}

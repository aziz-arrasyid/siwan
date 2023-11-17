<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
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
                'student_id' => 'required',
                'violation_id' => 'required',
            ],
            [
                'student_id.required' => 'Nama siswa tidak boleh kosong',
                'violation_id.required' => 'Pelanggaran tidak boleh kosong',
            ]
        );

        $student = Student::find($request->student_id);

        pelanggaran::create([
            'student_id' => $request->student_id,
            'violation_id' => $request->violation_id,
            'classroom_id' => $student->classroom_id,
        ]);
        return response()->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(pelanggaran $pelanggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pelanggaran $pelanggaran)
    {
        $pelanggaran->load('student', 'violation', 'Classroom');
        return response()->json($pelanggaran);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pelanggaran $pelanggaran)
    {
        $request->validate([
                'violation_id' => 'required',
            ],
            [
                'violation_id.required' => 'Pelanggaran tidak boleh kosong',
            ]
        );

        $pelanggaran->update($request->all());
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();
        return response()->json();
    }
}

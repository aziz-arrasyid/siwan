<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
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
                'data_array.*.waktu_absensi_id' => 'required',
                'data_array.*.student_id' => 'required',
                'data_array.*.teacher_id' => 'required',
                'data_array.*.status_guru' => 'required',
                'data_array.*.status' => 'required',
            ],[
                'data_array.*.waktu_absensi_id.required' => 'Waktu absensi kosong',
                'data_array.*.student_id.required' => 'siswa ada yang kosong',
                'data_array.*.teacher_id.required' => 'guru belum dipilih',
                'data_array.*.status_guru.required' => 'status guru kosong',
                'data_array.*.status.required' => 'status siswa kosong',
            ]
        );

        foreach ($request->data_array as $data) {
            $Absensi = Absensi::where('waktu_absensi_id', $data['waktu_absensi_id'])->where('student_id', $data['student_id'])->get();
            if($Absensi->isNotEmpty()) {
                foreach($Absensi as $absensi) {
                    $absensi->update([
                        'waktu_absensi_id' => $data['waktu_absensi_id'],
                        'teacher_id' => $data['teacher_id'],
                        'status_guru' => $data['status_guru'],
                        'student_id' => $data['student_id'],
                        'status' => $data['status'],
                    ]);
                }
            }else {
                Absensi::create([
                    'waktu_absensi_id' => $data['waktu_absensi_id'],
                    'teacher_id' => $data['teacher_id'],
                    'status_guru' => $data['status_guru'],
                    'student_id' => $data['student_id'],
                    'status' => $data['status'],
                ]);
            }
        }
        return response()->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\pelanggaran;
use Illuminate\Http\Request;

class dashboardSiswaController extends Controller
{
    public function index()
    {
        $student = Student::where('nis', auth()->user()->username)->first();

        $totalPelanggaran = pelanggaran::where('student_id', $student->id)
        ->join('violations', 'violations.id', '=', 'pelanggarans.violation_id')
        ->sum('violations.poin_pelanggaran');

        return view('siswa.index')->with([
            'DataDiri' => Student::where('nis', auth()->user()->username)->first(),
            'totalPelanggaran' => $totalPelanggaran,
        ]);
    }

    public function pelanggaran()
    {
        $student = Student::where('nis', auth()->user()->username)->first();
        return view('siswa.pelanggaran.index')->with([
            'DataDiri' => $student,
            'dataTitle' => 'Pelanggaran',
            'Pelanggaran' => pelanggaran::where('student_id', $student->id)->get(),
        ]);
    }

    public function getKelasProfile($competene_id)
    {
        $classroom = Classroom::where('competence_id', $competene_id)->get();

        return response()->json($classroom);
    }

    public function editProfileSiswa(Request $request, Student $student)
    {
        $request->validate(
            [
                'full_name' => 'required',
                'birthplace' => 'required',
                'birthdate' => 'required',
                'gender' => 'required',
                'religion' => 'required',
            ],
            [
                'full_name.required' => 'nama siswa tidak boleh kosong',
                'birthplace.required' => 'Tanggal Lahir siswa tidak boleh kosong',
                'birthdate.required' => 'Tempat Lahir siswa tidak boleh kosong',
                'gender.required' => 'Jenis Kelamin siswa tidak boleh kosong',
                'religion.required' => 'Agama siswa tidak boleh kosong',
            ]
        );
        $student->update($request->all());

        return response()->json();
    }
}

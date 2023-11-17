<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\Violation;
use App\Models\Competence;
use App\Models\pelanggaran;
use Illuminate\Http\Request;

class dashboardGuruPiketController extends Controller
{
    public function index()
    {
        return view('guruPiket.index')->with([
            'studentCount' => Student::count(),
            'pelanggaranCount' => pelanggaran::count(),
        ]);
    }

    public function siswaPelanggaran()
    {
        return view('guruPiket.dataSiswaPelanggaran.index')->with([
            'dataTitle' => 'Data pelanggaran',
            'addData' => 'Tambah data',
            'editData' => 'Edit data',
            'Pelanggaran' => pelanggaran::orderBy('id', 'desc')->get(),
            'Jurusan' => Competence::all(),
            'Violation' => Violation::all(),
        ]);
    }

    public function getClassroom($id)
    {
        $classroom = Classroom::where('competence_id', $id)->get();

        return response()->json($classroom);
    }

    public function getSiswa($id)
    {
        $student = Student::where('classroom_id', $id)->get();

        return response()->json($student);
    }
}

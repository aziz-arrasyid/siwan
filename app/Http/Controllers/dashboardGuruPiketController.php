<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Violation;
use App\Models\Competence;
use App\Models\pelanggaran;
use App\Models\WaktuAbsensi;
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

    public function showWaktuabsensi($id) {
        $WaktuAbsensi = WaktuAbsensi::where('classroom_id', $id)->with('classroom')->get();
        return response()->json($WaktuAbsensi);
    }

    public function getSiswaAbsensi($waktu_absensi_id) {
        $data_teacher = Absensi::where('waktu_absensi_id', $waktu_absensi_id)->with('waktuAbsensi')->first();
        $getSiswaAbsensi = Absensi::where('waktu_absensi_id', $waktu_absensi_id)->with('student', 'teacher')->get();
        $count = Absensi::where('waktu_absensi_id', $waktu_absensi_id)->count();
        return response()->json([
            'data_teacher' => $data_teacher,
            'getSiswaAbsensi' => $getSiswaAbsensi,
            'count' => $count,
        ]);
    }
}

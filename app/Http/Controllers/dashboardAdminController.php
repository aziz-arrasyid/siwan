<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Competence;
use App\Models\pelanggaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class dashboardAdminController extends Controller
{
    public function index()
    {
        $classroomCount = Classroom::count();
        $competenceCount = Competence::count();
        $teacherCount = Teacher::count();
        return view('admin.index', compact('classroomCount','competenceCount','teacherCount'));
    }

    public function server()
    {
        $query = Student::with('classroom','competence');
        return DataTables::of($query)->make(true);
    }

    public function pelanggaranData($id)
    {
        $Pelanggaran = pelanggaran::where('student_id', $id)->with(['violation', 'student'])->get();

        return response()->json($Pelanggaran);
    }

    public function showKepsek()
    {
        $data = Teacher::all();
        return response()->json($data);
    }

    public function cekSiswa($classroom)
    {
        $countStudentClass = Student::where('classroom_id', $classroom)->count();

        return response()->json($countStudentClass);
    }

}

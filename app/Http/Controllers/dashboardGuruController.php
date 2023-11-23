<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Violation;
use App\Models\Competence;
use App\Models\PanggilanOrtu;
use App\Models\pelanggaran;
use Illuminate\Http\Request;

class dashboardGuruController extends Controller
{
    public function index()
    {
        $teacher = Teacher::where('user_id', auth()->user()->id)->first();
        $classroom = Classroom::where('teacher_id', $teacher->id)->first();
        if($classroom != null){
            $studentCount = Student::where('classroom_id', $classroom->id)->count();
        }else{
            $studentCount = null;
        }
        return view('guru.index')->with([
            'classroom' => $classroom,
            'studentCount' => $studentCount,
            'DataDiri' => $teacher,
        ]);
    }

    public function siswaPelanggaran()
    {
        $teacher = Teacher::where('user_id', auth()->user()->id)->first();
        $classroom = Classroom::where('teacher_id', $teacher->id)->first();

        if($classroom == null){
            return redirect()->route('teacher');
        }

        $pelanggaran = pelanggaran::where('classroom_id', $classroom->id)->orderBy('id', 'desc')->get();

        $student = Student::where('classroom_id', $classroom->id)->get();

        return view('guru.siswaPelanggaran.index')->with([
            'dataTitle' => 'pelanggaran',
            'addData' => 'Tambah data',
            'editData' => 'Edit data',
            'DataDiri' => $teacher,
            'Student' => $student,
            'Violation' => Violation::all(),
            'Pelanggaran' => $pelanggaran,
        ]);
    }

    public function infoSiswa()
    {
        $teacher = Teacher::where('user_id', auth()->user()->id)->first();
        $classroom = Classroom::where('teacher_id', $teacher->id)->first();

        if($classroom == null){
            return redirect()->route('teacher');
        }

        $student = Student::where('classroom_id', $classroom->id)->get();

        return view('guru.infoSiswa.index')->with([
            'dataTitle' => 'Biodata Siswa',
            'addData' => 'Tambah data',
            'editData' => 'Edit data',
            'DataDiri' => $teacher,
            'Student' => $student,
            'competences' => Competence::all(),
        ]);
    }

    public function profileSiswa($student_id)
    {
        $student = Student::find($student_id);
        return response()->json($student);
    }

    public function tambahSiswa(Request $request)
    {
        $teacher = Teacher::where('user_id', auth()->user()->id)->first();
        $classroom = Classroom::where('teacher_id', $teacher->id)->first();

        $request->validate([
                'nis' => 'required',
                'full_name' => 'required',
                'birthplace' => 'required',
                'birthdate' => 'required',
                'gender' => 'required',
                'religion' => 'required',
                'contact' => 'required',
                'address' => 'required',
            ],
            [
                'nis.required' => 'nis siswa tidak boleh kosong',
                'full_name.required' => 'nama siswa tidak boleh kosong',
                'birthplace.required' => 'Tempat lahir siswa tidak boleh kosong',
                'birthdate.required' => 'Tanggal lahir siswa tidak boleh kosong',
                'gender.required' => 'Jenis kelamin siswa tidak boleh kosong',
                'religion.required' => 'Agama siswa tidak boleh kosong',
                'contact.required' => 'Nomor HP/WA siswa tidak boleh kosong',
                'address.required' => 'Alamat siswa tidak boleh kosong',
            ]
        );

        if(Student::where('nis', $request->nis)->exists())
        {
            return redirect()->back()->withErrors([
                'error' => 'Siswa dengan NIS tersebut sudah ada',
            ]);
        }

        Student::create([
            'classroom_id' => $classroom->id,
            'competence_id' => $classroom->competence_id,
            'nis' => $request->nis,
            'full_name' => $request->full_name,
            'birthplace' => $request->birthplace,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'contact' => $request->contact,
            'address' => $request->address,
        ]);

        $message = 'Data berhasil ditambahkan.';
        return redirect()->route('siswa.biodata')->with('success', $message);
    }

    public function tampilEditDataSiswa(Student $student)
    {
        return response()->json($student);
    }

    public function updateSiswa(Request $request, Student $student)
    {
        $request->validate(
            [
                'nis' => 'required',
                'full_name' => 'required',
                'birthplace' => 'required',
                'birthdate' => 'required',
                'gender' => 'required',
                'religion' => 'required',
                'contact' => 'required',
                'address' => 'required',
            ],
            [
                'nis.required' => 'nis siswa tidak boleh kosong',
                'full_name.required' => 'nama siswa tidak boleh kosong',
                'birthplace.required' => 'Tempat lahir siswa tidak boleh kosong',
                'birthdate.required' => 'Tanggal lahir siswa tidak boleh kosong',
                'gender.required' => 'Jenis kelamin siswa tidak boleh kosong',
                'religion.required' => 'Agama siswa tidak boleh kosong',
                'contact.required' => 'Nomor HP/WA siswa tidak boleh kosong',
                'address.required' => 'Alamat siswa tidak boleh kosong',
            ]
        );

        if (Student::where('nis', $request->nis)->where('nis', '!=', $student->nis)->exists()) {
            return response()->json([
                'error' => 'Siswa dengan NIS tersebut sudah ada',
            ], 422);
        }
        $student->update($request->all());

        return response()->json();
    }

    public function deleteSiswa(Student $student)
    {
        $student->delete();
        return response()->json();
    }

    public function updateDataPribadi(Request $request, Teacher $teacher)
    {
        $request->validate([
                'full_name' => 'required',
                'username' => 'required',
                'birthplace' => 'required',
                'gender' => 'required',
                'birthdate' => 'required',
                'contact' => 'required',
                'religion' => 'required',
            ],[
                'full_name.required' => 'Nama tidak boleh kosong',
                'username.required' => 'username tidak boleh kosong',
                'birthplace.required' => 'Tempat lahir tidak boleh kosong',
                'gender.required' => 'Jenis kelamin tidak boleh kosong',
                'birthdate.required' => 'Tanggal lahir tidak boleh kosong',
                'contact.required' => 'Kontak/WA tidak boleh kosong',
                'religion.required' => 'Agama tidak boleh kosong',
            ]
        );

        if(User::where('username', '!=', $teacher->user->username)->where('username', $request->username)->exists())
        {
            return response()->json(['error' => 'Username sudah ada yang pakai'], 422);
        }

        User::find($teacher->user_id)->update([
            'username' => $request->username,
        ]);

        $teacher->update([
            'full_name' => $request->full_name,
            'reg_number' => $request->reg_number,
            'birthplace' => $request->birthplace,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'contact' => $request->contact,
            'religion' => $request->religion,
            'address' => $request->address,
        ]);

        return response()->json();
    }

    public function infoPanggilan($panggilan_id)
    {
        $panggilan = PanggilanOrtu::find($panggilan_id);
        $panggilan->load('student');

        return response()->json($panggilan);
    }
}

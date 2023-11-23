<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Competence;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index')->with([
            'Jurusan' => Competence::all(),
        ]);
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
                'nis' => 'required',
                'full_name' => 'required',
                'birthplace' => 'required',
                'birthdate' => 'required',
                'gender' => 'required',
                'religion' => 'required',
                'contact' => 'required',
                'address' => 'required',
                'competence_id' => 'required',
                'classroom_id' => 'required',
            ],[
                'nis.required' => 'NIS tidak boleh kosong',
                'full_name' => 'Nama tidak boleh kosong',
                'birthplace.required' => 'Tempat lahir tidak boleh kosong',
                'birthdate.required' => 'Tanggal lahir tidak boleh kosong',
                'gender.required' => 'Jenis kelamin tidak boleh kosong',
                'religion.required' => 'Agama tidak boleh kosong',
                'contact.required' => 'Kontak/WA tidak boleh kosong',
                'address.required' => 'Alamat tidak boleh kosong',
                'competence_id.required' => 'Jurusan tidak boleh kosong',
                'classroom_id.required' => 'Kelas tidak boleh kosong',
            ]
        );

        if(Student::where('nis', $request->nis)->exists())
        {
            return redirect()->back()->with('error', 'NIS tersbeut sudah ada yang pakai');
        }

        User::create([
            'username' => $request->nis,
            'role' => '4',
            'password' => bcrypt('siswa'),
        ]);
        Student::create($request->all());

        return redirect()->route('landing.page.index')->with('successRegister', 'Akun berhasil dibuat');
    }

    public function getKelas($competence_id)
    {
        $classroom = Classroom::where('competence_id', $competence_id)->get();

        return response()->json($classroom);
    }
}

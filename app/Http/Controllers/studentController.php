<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Violation;
use App\Models\Competence;
use App\Models\pelanggaran;
use Illuminate\Http\Request;

class studentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('admin.dataSiswa.index')->with([
        'dataTitle' => 'Data Siswa',
        'addData' => 'Tambah',
        'editData' => 'Update',
        'Student' => Student::all(),
        'competences' => Competence::all(),
        'classroom' => Classroom::all(),
        'pelanggaranData' => 'Data pelanggaran',
        'Violation' => Violation::all(),
        'Pelanggaran' => pelanggaran::all(),
    ]);
  }

  public function getClassroom($compID){
    $classroom = Classroom::where("competence_id", $compID)->pluck('classroom_name', 'id');
    return response()->json($classroom);
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
    $request->validate(
			[
				'nis' => 'required',
				'full_name' => 'required',
			],
			[
				'nis.required' => 'nis tidak boleh kosong',
				'full_name.required' => 'nama siswa tidak boleh kosong',
			]
		);
    $student = Student::create($request->all());
    User::create([
        'username' => $student->nis,
        'role' => '4',
        'password' => bcrypt('siswa'),
    ]);
	$message = 'Data berhasil ditambahkan.';
	return redirect()->route('students.index')->with('success', $message);
  }


  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Student $student)
  {
    return response()->json($student);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Student $student)
  {
    $request->validate(
			[
				'nis' => 'required',
				'full_name' => 'required',
                'birthplace' => 'required',
                'birthdate' => 'required',
                'gender' => 'required',
                'religion' => 'required',
			],
			[
				'nis.required' => 'nis tidak boleh kosong',
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

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Student $student)
  {
    $student->delete();
		return response()->json();
  }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Competence;
use App\Models\pelanggaran;
use Illuminate\Http\Request;

class classroomController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('admin.dataKelas.index')->with([
      'competences' => Competence::all(),
      'classroom' => Classroom::orderBy('id', 'desc')->get(),
      'dataTitle' => 'Data Kelas',
      'addData' => 'Tambah',
      'editData' => 'Update',
      'Guru' => Teacher::all(),
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
    $request->validate(
			[
				'classroom_name' => 'required',
                'competence_id' => 'required',
                'teacher_id' => 'required',
			],
			[
				'classroom_name.required' => 'kelas tidak boleh kosong',
                'competence_id.required' => 'jurusan tidak boleh kosong',
                'teacher_id.required' => 'wali kelas tidak boleh kosong',
			]
		);

    if(Classroom::where('teacher_id', $request->teacher_id)->exists()){
      return redirect()->route('classroom.index')->with('error', 'Guru ini sudah jadi wali kelas');
    }else if(Classroom::where('classroom_name', $request->classroom_name)->exists()){
        return redirect()->route('classroom.index')->with('error', 'nama kelas sudah dipakai');
    }

    Classroom::create($request->all());
		$message = 'Data berhasil ditambahkan.';
		return redirect()->route('classroom.index')->with('success', $message);
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
  public function edit(Classroom $classroom)
  {
    return response()->json($classroom);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Classroom $classroom)
  {
    $request->validate(
			[
				'classroom_name' => 'required',
			],
			[
				'classroom_name.required' => 'Nama Kelas tidak boleh kosong'
			]
		);

        if(Classroom::where('teacher_id','!=', $classroom->teacher_id)->where('teacher_id', $request->teacher_id)->exists()){
            return response()->json([
                'error' => 'Guru ini sudah jadi wali kelas',
            ], 422);
        }else if(Classroom::where('classroom_name', '!=', $classroom->classroom_name)->where('classroom_name', $request->classroom_name)->exists()){
            return response()->json([
                'error' => 'nama kelas sudah dipakai',
            ], 422);
        }
    $classroom->update($request->all());
		return response()->json();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Classroom $classroom)
  {
        $Student = Student::where('classroom_id', $classroom->id)->get();
        foreach($Student as $student){
            pelanggaran::where('student_id', $student->id)->delete();
            $student->delete();
        }
        $classroom->delete();
		return response()->json();
  }
}

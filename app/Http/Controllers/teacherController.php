<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;

class teacherController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('admin.dataGuru.index')->with([
      'teachers' => Teacher::orderBy('id', 'desc')->get(),
      'dataTitle' => 'Data Guru',
      'addData' => 'Tambah Guru',
      'editData' => 'Edit Guru',
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
                'full_name' => 'required',
                'reg_number' => 'required',
                'birthplace' => 'required',
                'birthdate' => 'required',
                'gender' => 'required',
                'religion' => 'required',
                'contact' => 'required',
                'email' => 'required|email',
                'address' => 'required',
        ],
        [
                'full_name.required' => 'nama tidak boleh kosong',
                'reg_number.required' => 'NIP/NUPTK/NRHS tidak boleh kosong',
                'birthplace.required' => 'Tempat lahir tidak boleh kosong',
                'birthdate.required' => 'Tanggal lahir tidak boleh kosong',
                'gender.required' => 'Jenis kelamin tidak boleh kosong',
                'religion.required' => 'Agama tidak boleh kosong',
                'contact.required' => 'Nomor HP/WA tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Format email salah',
                'address.required' => 'Alamat tidak boleh kosong',
        ]
    );

    if(Teacher::where('reg_number', $request->reg_number)->exists())
    {
        return redirect()->back()->withErrors(['error' => 'Guru dengan NIP/NUPTK/NRHS sudah ada']);
    }

    $username = 'user' . mt_rand(1000, 9999);

    // Memastikan username unik
    while (User::where('username', $username)->exists()) {
        $username = 'user' . mt_rand(1000, 9999);
    }

    $user = User::create([
        'username' => $username,
        'role' => '1',
        'password' => bcrypt('guru'),
    ]);

    Teacher::create([
        'reg_number' => $request->reg_number,
        'full_name' => $request->full_name,
        'birthplace' => $request->birthplace,
        'birthdate' => $request->birthdate,
        'gender' => $request->gender,
        'religion' => $request->religion,
        'contact' => $request->contact,
        'email' => $request->email,
        'address' => $request->address,
        'user_id' => $user->id,
    ]);

    $message = 'Data berhasil ditambahkan.';
    return redirect()->route('teachers.index')->with('success', $message);
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
  public function edit(Teacher $teacher)
  {
    $teacher->load('user');
    return response()->json($teacher);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Teacher $teacher)
  {
    $request->validate(
        [
            'full_name' => 'required',
            'reg_number' => 'required',
            'birthplace' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ],
        [
            'full_name.required' => 'nama tidak boleh kosong',
            'reg_number.required' => 'NIP/NUPTK/NRHS tidak boleh kosong',
            'birthplace.required' => 'Tempat lahir tidak boleh kosong',
            'birthdate.required' => 'Tanggal lahir tidak boleh kosong',
            'gender.required' => 'Jenis kelamin tidak boleh kosong',
            'religion.required' => 'Agama tidak boleh kosong',
            'contact.required' => 'Nomor HP/WA tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email salah',
            'address.required' => 'Alamat tidak boleh kosong',
        ]
    );

    if(Teacher::where('reg_number', $request->reg_number)->where('reg_number', '!=', $teacher->reg_number)->exists())
    {
        return response()->json([
            'error' => 'Guru dengan NIP/NUPTK/NRHS sudah ada',
        ], 422);
    }
    $teacher->update($request->all());
		return response()->json();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Teacher $teacher)
  {
    User::find($teacher->user_id)->delete();
    $teacher->delete();
	return response()->json();
  }
}

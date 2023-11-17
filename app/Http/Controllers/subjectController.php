<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class subjectController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('admin.dataMapel.index')->with([
      'subjects' => Subject::all(),
      'dataTitle' => 'Mata Pelajaran',
      'addData' => 'Tambah',
      'editData' => 'Update'
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
				'codeMapel' => 'required',
        'namaMapel' => 'required',
			],
			[
				'codeMapel.required' => 'Code Mapel tidak boleh kosong',
        'namaMapel.required' => 'Nama  Mapel tidak boleh kosong',
			]
		);
    Subject::create($request->all());
		$message = 'Data berhasil ditambahkan.';
		return redirect()->route('subjects.index')->with('success', $message);
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
  public function edit(Subject $subject)
  {
    return response()->json($subject);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Subject $subject)
  {
    $request->validate(
			[
				'codeMapel' => 'required',
        'namaMapel' => 'required',
			],
			[
				'codeMapel.required' => 'Code Mapel tidak boleh kosong',
        'namaMapel.required' => 'Nama  Mapel tidak boleh kosong',
			]
		);
    $subject->update($request->all());
		return response()->json();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Subject $subject)
  {
    $subject->delete();
		return response()->json();
  }
}

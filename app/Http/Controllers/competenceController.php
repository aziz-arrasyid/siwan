<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use Illuminate\Http\Request;

class competenceController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
  return view('admin.dataJurusan.index')->with([
      'competences' => Competence::orderBy('id', 'desc')->get(),
      'dataTitle' => 'Data Jurusan',
      'addData' => 'Tambah Jurusan',
      'editData' => 'Edit Jurusan'
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
				'inisial_jurusan' => 'required',
				'nama_jurusan' => 'required',
			],
			[
				'inisial_jurusan.required' => 'inisial jurusan tidak boleh kosong',
				'nama_jurusan.required' => 'nama jurusan tidak boleh kosong'
			]
		);

		Competence::create($request->all());
		//hallo
		$message = 'Data ' . ' berhasil ditambahkan.';
		return redirect()->route('competences.index')->with('success', $message);
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
  public function edit(Competence $competence)
  {
		return response()->json($competence);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Competence $competence)
  {
		$request->validate(
			[
				'inisial_jurusan' => 'required',
				'nama_jurusan' => 'required',
			],
			[
				'inisial_jurusan.required' => 'inisial jurusan tidak boleh kosong',
				'nama_jurusan.required' => 'nama jurusan tidak boleh kosong'
			]
		);

		$competence->update($request->all());
		return response()->json();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Competence $competence)
  {
		$competence->delete();
		return response()->json();
  }
}

<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use Illuminate\Http\Request;

class violationController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('admin.dataPelanggaran.index')->with([
      'violations' => Violation::all(),
      'dataTitle' => 'Data Pelanggaran',
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
				'nama_pelanggaran' => 'required',
                'poin_pelanggaran' => 'required',
			],
			[
				'nama_pelanggaran.required' => 'Nama Pelanggaran tidak boleh kosong',
                'poin_pelanggaran.required' => 'Poin pelanggaran tidak boleh kosong',
			]
		);
    Violation::create($request->all());
	$message = 'Data berhasil ditambahkan.';
	return redirect()->route('violations.index')->with('success', $message);
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
  public function edit(Violation $violation)
  {
    return response()->json($violation);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Violation $violation)
  {
    $request->validate(
			[
				'nama_pelanggaran' => 'required',
        'poin_pelanggaran' => 'required',
			],
			[
				'nama_pelanggaran.required' => 'Nama Pelanggaran tidak boleh kosong',
        'poin_pelanggaran.required' => 'Poin pelanggaran tidak boleh kosong',
			]
		);
    $violation->update($request->all());
		return response()->json();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Violation $violation)
  {
    $violation->delete();
		return response()->json();
  }
}

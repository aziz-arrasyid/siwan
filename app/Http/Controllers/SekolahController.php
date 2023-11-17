<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dataSekolah.index')->with([
            'editData' => 'Edit data Sekolah',
            'dataSekolah' => Sekolah::first(),
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
        $request->validate([
                'name' => 'required',
                'teacher_id' => 'required',
                'email' => 'required',
                'telepon' => 'required',
                'alamatSekolah' => 'required',
            ],[
                'name.required' => 'Nama tidak boleh kosong',
                'teacher_id.required' => 'Kepala sekolah tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'telepon.required' => 'telepon tidak boleh kosong',
                'alamatSekolah.required' => 'Alamat tidak boleh kosong',
            ]
        );
        Sekolah::updateOrCreate(
            ['id' => $request->id],
            [
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
            'teacher_id' => $request->teacher_id,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamatSekolah' => $request->alamatSekolah,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);
        return redirect()->route('sekolah.index')->with('success', 'Data berhasil diubah/ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sekolah $sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sekolah $sekolah)
    {
        $sekolah->load('teacher');
        return response()->json($sekolah);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sekolah $sekolah)
    {
        //
    }
}

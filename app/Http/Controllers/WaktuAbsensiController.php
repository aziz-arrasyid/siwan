<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\WaktuAbsensi;
use Illuminate\Http\Request;

class WaktuAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('guruPiket.absensi.index')->with([
            'Kelas' => Classroom::all(),
            'Guru' => Teacher::all(),
            'dataTitle' => 'Data absensi',
            'addData' => 'Tambah data',
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
        $waktu = Carbon::now();

        if(WaktuAbsensi::where(
            'classroom_id', $request->classroom_id)
            ->where('hari', $waktu->isoFormat('dddd'))
            ->where('tanggal', $waktu->format('j F Y'))->exists()) {
            return response()->json();
        }else {
            if($waktu->isoFormat('dddd') != 'Sabtu' && $waktu->isoFormat('dddd') != 'Minggu') {
                WaktuAbsensi::create([
                    'classroom_id' => $request->classroom_id,
                    'hari' => $waktu->isoFormat('dddd'),
                    'tanggal' => $waktu->format('j F Y'),
                ]);
            }
            return response()->json($waktu);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WaktuAbsensi $waktuAbsensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WaktuAbsensi $waktuAbsensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WaktuAbsensi $waktuAbsensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaktuAbsensi $waktuabsensi)
    {
        Absensi::where('waktu_absensi_id', $waktuabsensi->id)->delete();
        $waktuabsensi->delete();

        return response()->json();
    }
}

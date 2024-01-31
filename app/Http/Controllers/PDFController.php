<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\WaktuAbsensi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function pdfAbsensi($id) {
        $absensikelas = Absensi::where('waktu_absensi_id', $id)->with('student', 'teacher')->get();
        $absensikelasGuru = Absensi::where('waktu_absensi_id', $id)->with('student', 'teacher')->first();
        // dd($absensikelas, $absensikelasGuru);
        if($absensikelasGuru == null){
            return response()->json(['error' => 'error'], 422);
        }
        foreach ($absensikelas as $item) {
            $absensiMurid[] = $item;
        }
        // dd(is_array($data_array), $data_array);
        $namaPDF = WaktuAbsensi::find($id)->with('classroom')->first();
        // $absensiArray = $absensikelas->toArray();
        $data = ['title' => 'anuuuu'];
        // return response()->json($namaPDF);
        $pdf = Pdf::loadView('layouts.pdf', compact('absensikelas', 'absensikelasGuru', 'namaPDF'));
        return $pdf->download($namaPDF->hari. '_'. date('d_F_Y', strtotime($namaPDF->tanggal)). '_'. str_replace(' ', '_', $namaPDF->classroom->classroom_name).'.pdf');
    }

    public function cekDatapdf($id) {
        $absensikelasGuru = Absensi::where('waktu_absensi_id', $id)->with('student', 'teacher')->first();
        if($absensikelasGuru == null){
            return response()->json(['error' => 'Data absensi kosong'], 422);
        }
    }
}

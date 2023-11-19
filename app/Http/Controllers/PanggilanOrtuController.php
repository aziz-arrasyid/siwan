<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\PanggilanOrtu;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PanggilanOrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Teacher::where('user_id', auth()->user()->id)->first();
        $classroom = Classroom::where('teacher_id', $teacher->id)->first();
        $student = Student::where('classroom_id', $classroom->id)->get();
        if($classroom == null)
        {
            return redirect()->route('teacher');
        }
        return view('guru.panggilanOrtu.index')->with([
            // 'Panggilan' => PanggilanOrtu::all(),
            'dataTitle' => 'Data panggilan ortu/wali',
            'addData' => 'Tambah data',
            'editData' => 'Edit data',
            'Student' => $student,
            'DataDiri' => $teacher,
            'Panggilan' => PanggilanOrtu::all(),
            // 'StudentPelanggaran' => pelanggaran::where('')
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
                'dokumentasi' => 'required|image',
                'permasalahan' => 'required',
                'statusPanggilan' => 'required',
                'student_id' => 'required',
            ],[
                'dokumentasi.required' => 'Foto dokumentasi tidak boleh kosong',
                'dokumentasi.image' => 'File dokumentasi harus berupa foto',
                'permasalahan.required' => 'Permasalahan tidak boleh kosong',
                'statusPanggilan.required' => 'Status panggilan tidak boleh kosong',
                'student_id' => 'Nama siswa tidak boleh kosong',
            ]
        );

        $student = Student::find($request->student_id);

        if(PanggilanOrtu::where('student_id', $request->student_id)->where('statusPanggilan', $request->statusPanggilan)->exists())
        {
            return response()->json([
                'error' => 'Data panggilan nya sudah ada',
            ], 422);
        }

        if($request->hasFile('dokumentasi'))
        {
            $image = $request->file('dokumentasi');

            // Proses kompresi gambar
            $compressedImage = Image::make($image)
            ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg', 75); // jpg dengan kualitas 75%

            // Ubah nama file sesuai format yang diinginkan
            $imageName = 'image_' . 'nis_' . $student->nis . '_' . now()->format('Ymd_His') . '.jpg';

            // Simpan gambar yang sudah dikompresi ke penyimpanan
            Storage::put('public/images/' . $imageName, $compressedImage);
        }else{
            return response()->json([
                'error' => 'Data gambar tidak bisa di input',
            ], 422);
        }


        PanggilanOrtu::create([
            'student_id' => $request->student_id,
            'classroom_id' => $student->classroom_id,
            'statusPanggilan' => $request->statusPanggilan,
            'permasalahan' => $request->permasalahan,
            'dokumentasi' => $imageName,
        ]);

        return response()->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(PanggilanOrtu $panggilan_ortu_wali)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PanggilanOrtu $panggilan_ortu_wali)
    {
        $panggilan_ortu_wali->load('student');
        return response()->json($panggilan_ortu_wali);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PanggilanOrtu $panggilan_ortu_wali)
    {
        $request->validate(
            [
                // 'dokumentasi' => 'required',
                'permasalahan' => 'required',
                'statusPanggilan' => 'required',
                'student_id' => 'required',
            ],
            [
                // 'dokumentasi.required' => 'Foto dokumentasi tidak boleh kosong',
                'permasalahan.required' => 'Permasalahan tidak boleh kosong',
                'statusPanggilan.required' => 'Status panggilan tidak boleh kosong',
                'student_id' => 'Nama siswa tidak boleh kosong',
            ]
        );
        if($panggilan_ortu_wali->student_id != $request->student_id)
        {
            if(PanggilanOrtu::where('student_id', $request->student_id)->where('statusPanggilan', $request->statusPanggilan)->exists())
            {
                return response()->json([
                    'error' => 'Data panggilan nya sudah ada',
                ], 422);
            }
        }elseif($panggilan_ortu_wali->student_id == $request->student_id)
        {
            if(PanggilanOrtu::where('student_id', $request->student_id)->where('statusPanggilan', $request->statusPanggilan)->where('statusPanggilan', '!=', $panggilan_ortu_wali->statusPanggilan)->exists())
            {
                return response()->json([
                    'error' => 'Data panggilan nya sudah ada',
                ], 422);
            }
        }
        $panggilan_ortu_wali->update($request->all());

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PanggilanOrtu $panggilan_ortu_wali)
    {
        Storage::delete('public/images/' . $panggilan_ortu_wali->dokumentasi);
        $panggilan_ortu_wali->delete();

        return response()->json();
    }
}

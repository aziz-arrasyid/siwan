<?php

namespace App\Http\Controllers;

use App\Models\Kreator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class KreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kreator.dataBerita.index')->with([
            'Kreator' => Kreator::all(),
            'dataTitle' => 'Data berita',
            'addData' => 'Tambah data',
            'editData' => 'Edit data',
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
                'picture' => 'required|image|mimes:jpeg,png,jpg',
                'title' => 'required',
                'content' => 'required',

            ],[
                'picture.required' => 'Foto tidak boleh kosong',
                'picture.image' => 'File harus berupa gambar',
                'picture.mimes' => 'Format foto yang diizinkan jpeg,png,jpg',
                'title.required' => 'Judul tidak boleh kosong',
                'content.required' => 'Konten tidak boleh kosong',
            ]
        );

        $image = $request->file('picture');

        // Proses kompresi gambar
        $compressedImage = Image::make($image)
            ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg', 75); // jpg dengan kualitas 75%

        // Ubah nama file sesuai format yang diinginkan
        $imageName = 'image' . rand(0, 100) . '_' . Str::random(5) . '_' . now()->format('Ymd_His') . '.jpg';

        // Simpan gambar yang sudah dikompresi ke penyimpanan
        Storage::put('public/images/' . $imageName, $compressedImage);

        Kreator::create([
            'title' => $request->title,
            'content' => $request->content,
            'picture' => $imageName,
        ]);

        return redirect()->route('kreator.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kreator $kreator)
    {
        return response()->json($kreator);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kreator $kreator)
    {
        return response()->json($kreator);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kreator $kreator)
    {
        $request->validate([
                'picture' => 'nullable|image|mimes:jpeg,png,jpg',
                'content' => 'required',
                'title' => 'required',
            ],[
                'picture.mimes' => 'Format foto yang diizinkan jpeg,png,jpg',
                'picture.image' => 'File harus berupa gambar',
                'content.required' => 'Konten tidak boleh kosong',
                'title.required' => 'Judul tidak boleh kosong'
            ]
        );

        if($request->hasFile('picture'))
        {
            Storage::delete('public/images/'. $kreator->picture);

            $image = $request->file('picture');

            // Proses kompresi gambar
            $compressedImage = Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg', 75); // jpg dengan kualitas 75%

            // Ubah nama file sesuai format yang diinginkan
            $imageName = 'image' . rand(0, 100) . '_' . Str::random(5) . '_' . now()->format('Ymd_His') . '.jpg';

            // Simpan gambar yang sudah dikompresi ke penyimpanan
            Storage::put('public/images/' . $imageName, $compressedImage);

            $kreator->update([
                'picture' => $imageName,
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }else
        {
            $kreator->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        return response()->json();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kreator $kreator)
    {
        Storage::delete('public/images/' . $kreator->picture);

        $kreator->delete();

        return response()->json();
    }
}

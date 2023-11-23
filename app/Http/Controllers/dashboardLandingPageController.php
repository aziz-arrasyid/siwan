<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Competence;
use App\Models\Kreator;
use App\Models\Sekolah;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class dashboardLandingPageController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->ip());
        return view('landingPage.index')->with([
            'sekolah' => Sekolah::first(),
            'siswaCount' => Student::count(),
            'guruCount' => Teacher::count(),
            'kelasCount' => Classroom::count(),
            'jurusanCount' => Competence::count(),
        ]);
    }

    public function visiMisi()
    {
        return view('landingPage.visiMisi.index')->with([
            'title' => 'Visi da Misi',
            'subTitle' => 'Meliputi visi, 8 butir misi serta tujuan dan sasaran SMK Negeri 4 Tanjungpinang',
            'sekolah' => Sekolah::first(),
        ]);
    }

    public function tataTertib()
    {
        return view('landingPage.tataTertib.index')->with([
            'title' => 'Tata Tertib',
            'subTitle' => 'Meliputi hal menimbang, mengingat, memperhatikan, memutuskan; menetapkan',
            'sekolah' => Sekolah::first(),
        ]);
    }

    public function poinPelanggaran()
    {
        return view('landingPage.poinPelanggaran.index')->with([
            'title' => 'Poin Pelanggaran',
            'subTitle' => 'Meliputi daftar poin/denda pelanggaran tata tertib siswa SMK Negeri 4 Tanjungpinang',
            'sekolah' => Sekolah::first(),
        ]);
    }

    public function berita()
    {
        return view('landingPage.berita.index')->with([
            'sekolah' => Sekolah::first(),
            'Berita' => Kreator::paginate(3),
            'BeritaPopuler' => Kreator::orderBy('visitors', 'desc')->take(3)->get(),
            'sekolah' => Sekolah::first(),
        ]);
    }

    public function singlePost($title)
    {
        $post = Kreator::where('title', $title)->first();
        if($post == null)
        {
            return view('errors.404');
        }else
        {
            $post->visitors += 1;
            $post->save();
            return view('landingPage.berita.singlePost.index')->with([
                'berita' => Kreator::where('title', $title)->first(),
                'BeritaRandom' => Kreator::inRandomOrder()->take(3)->get(),
            ]);
        }
    }
}

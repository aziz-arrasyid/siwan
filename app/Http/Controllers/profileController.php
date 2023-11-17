<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class profileController extends Controller
{
    public function index()
    {
        if(Teacher::where('user_id', auth()->user()->id)->first()){
            $dataDiri = Teacher::where('user_id', auth()->user()->id)->first();
        }else{
            $dataDiri = Student::where('nis', auth()->user()->username)->first();
        }

        return view('profile.index')->with([
            'DataDiri' => $dataDiri,
            'Jurusan' => Competence::all(),
        ]);
    }
}

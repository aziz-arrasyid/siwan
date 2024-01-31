<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use App\Models\pelanggaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PanggilanOrtu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class loginControllerApi extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username kosong',
                'password.required' => 'Password kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $student = Student::with('classroom', 'competence')->where('nis', $request->username)->first();
            $pelanggaran = pelanggaran::with('violation', 'classroom', 'student')->where('student_id', $student->id)->get();
            $panggilanOrtu = PanggilanOrtu::where('student_id', $student->id)->get();

            return response()->json([
                'student' => $student,
                'pelanggaran' => $pelanggaran,
                'panggilanOrtu' => $panggilanOrtu,
            ]);
        } else {
            return response()->json(['error' => 'Username atau password salah'], 422);
        }
    }
}

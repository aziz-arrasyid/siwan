<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'username tidak boleh kosong',
                'password.required' => 'password tidak boleh kosong',
            ]
        );

        if (auth()->attempt(['username' => $input['username'], 'password' => $input['password']])) {
            if(auth()->user()->role == 'admin')
            {
                return redirect()->route('admin')->with('login', 'Selamat datang ' . auth()->user()->username);
            } else if(auth()->user()->role == 'guruPiket')
            {
                return redirect()->route('guru.piket')->with('login', 'Selamat datang ' . auth()->user()->username);
            } else if(auth()->user()->role == 'guru')
            {
                return redirect()->route('teacher')->with('login', 'Selamat datang ' . auth()->user()->username);
            } else if (auth()->user()->role == 'siswa') {
                return redirect()->route('siswa')->with('login', 'Selamat datang ' . auth()->user()->username);
            } else if (auth()->user()->role == 'kreator')
            {
                return redirect()->route('kreator')->with('login', 'Selamat datang '. auth()->user()->username);
            }
        }else{
            return redirect()->route('login')->with('gagal', 'Username atau password salah.');
        }
    }
}

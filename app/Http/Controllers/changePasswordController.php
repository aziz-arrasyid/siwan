<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class changePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ],[
                'current_password.required' => 'Password sekarang tidak boleh kosong',
                'password.required' => 'Password baru tidak boleh kosong',
                'password.confirmed' => 'Password baru dengan password confirm tidak sama',
                'password_confirmation.required' => 'Password confirm tidak boleh kosong',
            ]
        );

        $user = User::find(Auth()->user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect('/profile')->with('error', 'Kata Sandi Lama Salah');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
    }
}

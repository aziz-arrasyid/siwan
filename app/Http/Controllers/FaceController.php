<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaceController extends Controller
{
    public function face()
    {
        // Jalankan skrip Python
        // $output = shell_exec('/app/python/pythonFaceRecognition/faceDetector.py');
        $output = shell_exec('python ' . base_path('app/python/pythonFaceRecognition/faceDetector.py'));

        // Kirim output kembali ke browser
        return response()->json(['output' => $output]);
    }
}

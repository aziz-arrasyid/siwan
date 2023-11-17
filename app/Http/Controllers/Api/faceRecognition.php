<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class faceRecognition extends Controller
{
    public function index(Request $request)
    {
        dd($request->all());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardKreatorController extends Controller
{
    public function index()
    {
        return view('kreator.index');
    }
}

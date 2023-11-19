<?php

namespace App\Http\Controllers;

use App\Models\Kreator;
use Illuminate\Http\Request;

class dashboardKreatorController extends Controller
{
    public function index()
    {
        return view('kreator.index')->with([
            'countBerita' => Kreator::count(),
        ]);
    }
}

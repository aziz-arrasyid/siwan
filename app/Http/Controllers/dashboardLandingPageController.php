<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class dashboardLandingPageController extends Controller
{
    public function index(Request $request)
    {
        dd($request->ip());
        return view('landingPage.index')->with([
            'sekolah' => Sekolah::first(),
        ]);
    }
}

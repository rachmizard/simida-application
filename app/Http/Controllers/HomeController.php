<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function sekretariatHome(Request $request)
    {
        return 'Sekretariat Here';
    }

    public function pendidikanHome(Request $request)
    {
        return 'Pendidikan Here';
    }

    public function keuanganHome(Request $request)
    {
        return 'Keuangan Here';
    }

    public function keamananHome(Request $request)
    {
        return 'Keamanan Here';
    }
}

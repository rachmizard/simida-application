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
        return view('home-sekretariat');
    }

    public function pendidikanHome(Request $request)
    {
        return view('home-pendidikan');
    }

    public function keuanganHome(Request $request)
    {
        return view('home-keuangan');
    }

    public function keamananHome(Request $request)
    {
        return view('home-keamanan');
    }
}

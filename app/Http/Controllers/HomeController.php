<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Santri;
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
        $getTotalSantri = Santri::whereStatus('aktif')->count();
        $getSantriPutra = Santri::whereStatus('aktif')->whereJenisKelamin('L')->count();
        $getSantriPutri = Santri::whereStatus('aktif')->whereJenisKelamin('P')->count();

        $getSantriIbtida = Santri::whereStatus('aktif')->whereHas('tingkat', function($query){
                $query->where('nama_tingkatan', 'Ibtida');
        })->count();

        $getSantriTsanawi = Santri::whereStatus('aktif')->whereHas('tingkat', function($query){
                $query->where('nama_tingkatan', 'Tsanawi');
        })->count();

        $getSantriMahadAly = Santri::whereStatus('aktif')->whereHas('tingkat', function($query){
                $query->where('nama_tingkatan', "Ma'had Aly");
        })->count();
        return view('home', compact('getTotalSantri', 'getSantriPutra', 'getSantriPutri', 'getSantriIbtida', 'getSantriTsanawi', 'getSantriMahadAly'));
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

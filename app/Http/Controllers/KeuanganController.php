<?php

namespace App\Http\Controllers;
use App\Periode;
use App\TotalUang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function blockedAccess()
    {
        $errorType = 403;
        $messageTitle = 'Tidak ada akses!';
        $messageCaption = 'Akses anda tidak dapat dialihkan kehalaman ini!';
        return view('keuangan.no-access-page', compact('errorType', 'messageTitle', 'messageCaption'));
    }

    public function index()
    {
        return view('keuangan.keuangan');
    }

    public function cashNow()
    {
        
        $periodeDefaultSet = Periode::whereStatus('aktif')->first();

        $start_date = Carbon::parse($periodeDefaultSet['start_date'])->format('Y-m-d');
        $end_date = Carbon::parse($periodeDefaultSet['end_date'])->format('Y-m-d');

        $totalByPeriodeActive = TotalUang::wherePeriode($periodeDefaultSet['nama_periode'])->value('total_nominal');


        return response()->json(['total' => $totalByPeriodeActive, 'periode' => $periodeDefaultSet['nama_periode']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

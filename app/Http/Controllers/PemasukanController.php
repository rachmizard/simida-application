<?php

namespace App\Http\Controllers;

use App\Pemasukan;
use App\Periode;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function totalPemasukan()
    {
        $periodeDefaultSet = Periode::whereStatus('aktif')->first();

        $start_date = Carbon::parse($periodeDefaultSet['start_date'])->format('Y-m-d');
        $end_date = Carbon::parse($periodeDefaultSet['end_date'])->format('Y-m-d');

        $totalByPeriodeActive = Pemasukan::whereBetween('tgl_pemasukan', [$start_date, $end_date])->sum('jumlah_pemasukan');

        return response()->json(['total' => $totalByPeriodeActive, 'periode' => $periodeDefaultSet['nama_periode']]);
    }

    public function sekilasKeuangan()
    {
        return response()->json(['data' => Pemasukan::orderBy('jumlah_pemasukan', 'DESC')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_pemasukan' => 'required', 
            'jenis_pemasukan' => 'required', 
            // 'santri_id' => 'required', 
            'jumlah_pemasukan' => 'required', 
            'nama_donatur' => 'required',
        ]);

        $storepemasukan = new Pemasukan();
            if ($request->jenis_pemasukan == 'donatur') {
                $storepemasukan->nama_donatur = $request->nama_donatur;
                $storepemasukan->tgl_pemasukan = date('Y-m-d', strtotime($request->tgl_pemasukan));
                $storepemasukan->jumlah_pemasukan = $request->jumlah_pemasukan;
                $storepemasukan->jenis_pemasukan = 'donatur';
            }else if($request->jenis_pemasukan == 'infaq'){
                $storepemasukan->santri_id = $request->santri_id;
                $storepemasukan->tgl_pemasukan = date('Y-m-d', strtotime($request->tgl_pemasukan));
                $storepemasukan->jumlah_pemasukan = $request->jumlah_pemasukan;
                $storepemasukan->jenis_pemasukan = 'infaq';
            }
            // Push to datatabase!
            $storepemasukan->save();
        return response()->json(['response' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Pemasukan::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'tgl_pemasukan' => 'required', 
            'jenis_pemasukan' => 'required', 
            'santri_id' => 'required', 
            'jumlah_pemasukan' => 'required', 
            'nama_donatur' => 'required',
        ]);

        $storepemasukan = Pemasukan::find($id);
            if ($request->jenis_pemasukan == 'donatur') {
                $storepemasukan->nama_donatur = $request->nama_donatur;
                $storepemasukan->tgl_pemasukan = date('Y-m-d', strtotime($request->tgl_pemasukan));
                $storepemasukan->jumlah_pemasukan = $request->jumlah_pemasukan;
                $storepemasukan->jenis_pemasukan = 'donatur';
            }else if($request->jenis_pemasukan == 'infaq'){
                $storepemasukan->nis = $request->nis;
                $storepemasukan->tgl_pemasukan = date('Y-m-d', strtotime($request->tgl_pemasukan));
                $storepemasukan->jumlah_pemasukan = $request->jumlah_pemasukan;
                $storepemasukan->jenis_pemasukan = 'infaq';
            }
            // Push to datatabase!
            $storepemasukan->save();
        return response()->json(['response' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletepemasukan = Pemasukan::find($id)->delete();
        return response()->json(['response' => 'success']);
    }
}

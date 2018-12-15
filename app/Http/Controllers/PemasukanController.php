<?php

namespace App\Http\Controllers;

use App\Pemasukan;
use App\Periode;
use Carbon\Carbon;
use DB;
use App\TotalUang;
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

        $totalByPeriodeActive = TotalUang::wherePeriode($periodeDefaultSet['nama_periode'])->value('total_nominal');


        return response()->json(['total' => $totalByPeriodeActive, 'periode' => $periodeDefaultSet['nama_periode']]);
    }

    public function sekilasKeuangan()
    {
        return response()->json(Pemasukan::orderBy('jumlah_pemasukan', 'DESC')->paginate(10));
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


            $periodeDefaultSet = Periode::whereStatus('aktif')->first();
            $start_date = Carbon::parse($periodeDefaultSet['start_date'])->format('Y-m-d');
            $end_date = Carbon::parse($periodeDefaultSet['end_date'])->format('Y-m-d');

            $getTotalUang = DB::table('total_uang')->where('periode', $periodeDefaultSet['nama_periode'])->first();
            $defaultUang = Pemasukan::whereBetween('tgl_pemasukan', [$start_date, $end_date])->sum('jumlah_pemasukan');
            $masukanUang =  $defaultUang + $request->jumlah_pemasukan;
            $updateTotalUang = TotalUang::find($getTotalUang->id);
            $updateTotalUang->total_nominal = $masukanUang;
            $updateTotalUang->update();

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
            // 'santri_id' => 'required', 
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
                $storepemasukan->santri_id = $request->santri_id;
                $storepemasukan->tgl_pemasukan = date('Y-m-d', strtotime($request->tgl_pemasukan));
                $storepemasukan->jumlah_pemasukan = $request->jumlah_pemasukan;
                $storepemasukan->jenis_pemasukan = 'infaq';
            }
            // Push to datatabase!


            $periodeDefaultSet = Periode::whereStatus('aktif')->first();
            $start_date = Carbon::parse($periodeDefaultSet['start_date'])->format('Y-m-d');
            $end_date = Carbon::parse($periodeDefaultSet['end_date'])->format('Y-m-d');

            $getTotalUang = DB::table('total_uang')->where('periode', $periodeDefaultSet['nama_periode'])->first();
            $defaultUang = Pemasukan::whereBetween('tgl_pemasukan', [$start_date, $end_date])->sum('jumlah_pemasukan');
            $masukanUang =  $defaultUang + $request->jumlah_pemasukan;
            $updateTotalUang = TotalUang::find($getTotalUang->id);
            $updateTotalUang->total_nominal = $masukanUang;
            $updateTotalUang->update();

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
        $deletepemasukan = Pemasukan::find($id);
        $getDefaultPeriode = Periode::whereStatus('aktif')->first();
        $getTotalUang = TotalUang::where('periode', $getDefaultPeriode['nama_periode'])->value('total_nominal');
        $tambahinUangnya = $getTotalUang + $getDefaultPeriode;
        $updateTotalUang = TotalUang::wherePeriode($getDefaultPeriode['nama_periode'])->update(['total_nominal' => $tambahinUangnya]);
        $deletepemasukan->delete();

        return response()->json(['response' => 'success']);
    }
}

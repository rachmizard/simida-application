<?php

namespace App\Http\Controllers;

use App\MasterLimitIzin;
use Illuminate\Http\Request;

class MasterLimitIzinController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'max_durasi' => 'required', 
            'kategori_limit' => 'required', 
            'status' => 'required'
        ]);

        $storeLimitIzin = new MasterLimitIzin();
        $storeLimitIzin->max_durasi = $request->max_durasi;
        $storeLimitIzin->kategori_limit = $request->kategori_limit;
        $storeLimitIzin->status = 'tidak_aktif';
        $storeLimitIzin->save();

        return response()->json(['response' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MasterLimitIzin  $masterLimitIzin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return MasterLimitIzin::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MasterLimitIzin  $masterLimitIzin
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterLimitIzin $masterLimitIzin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterLimitIzin  $masterLimitIzin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'max_durasi' => 'required', 
            'kategori_limit' => 'required', 
            'status' => 'required'
        ]);

        $storeLimitIzin = MasterLimitIzin::findOrFail($id);
        $storeLimitIzin->max_durasi = $request->max_durasi;
        $storeLimitIzin->kategori_limit = $request->kategori_limit;
        $storeLimitIzin->status = 'tidak_aktif';
        $storeLimitIzin->update();

        return response()->json(['response' => 'success']);
    }

    public function setAktif($id)
    {
        $setAktif = MasterLimitIzin::findOrFail($id);
        $setAsDefault = MasterLimitIzin::whereStatus('aktif')->update(['status' => 'tidak_aktif']);
        $setAktif->status = 'aktif';
        $setAktif->update();

        return response()->json(['response' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MasterLimitIzin  $masterLimitIzin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteLimitIzin = MasterLimitIzin::findOrFail($id)->delete();
        return response()->json(['response' => 'success']);
    }
}

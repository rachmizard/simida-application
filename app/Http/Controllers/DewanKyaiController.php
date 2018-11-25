<?php

namespace App\Http\Controllers;

use App\DewanKyai;
use Illuminate\Http\Request;

class DewanKyaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sekretariat.dewan_kyai.dewankyai');
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
            'nama_dewan_kyai' = 'required'
        ]);

        $dewanKyai = new DewanKyai();
        $dewanKyai->nama_dewan_kyai = $request->nama_dewan_kyai;
        if ($request->foto) {
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DewanKyai  $dewanKyai
     * @return \Illuminate\Http\Response
     */
    public function show(DewanKyai $dewanKyai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DewanKyai  $dewanKyai
     * @return \Illuminate\Http\Response
     */
    public function edit(DewanKyai $dewanKyai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DewanKyai  $dewanKyai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DewanKyai $dewanKyai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DewanKyai  $dewanKyai
     * @return \Illuminate\Http\Response
     */
    public function destroy(DewanKyai $dewanKyai)
    {
        //
    }
}

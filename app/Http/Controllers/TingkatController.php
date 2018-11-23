<?php

namespace App\Http\Controllers;

use App\Tingkat;
use Illuminate\Http\Request;

class TingkatController extends Controller
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

    public function getJSON()
    {
        $tingkat = Tingkat::all();
        return response()->json(['data' => $tingkat]);
    }

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
        try {
            $tingkat = Tingkat::create($request->all());   
            $data['messageWarningTingkatan'] = false;
            $data['messageErrorTingkatan'] = false;
            $data['messageTingkatan'] = 'Berhasil menambahkan Tingkat!';
            $data['type'] = 'success';  
        } catch (Exception $e) {
                $data['messageWarningTingkatan'] = false;
                $data['messageErrorTingkatan'] = 'Terjadi Kesalahan!';
                $data['messageTingkatan'] = false;
                $data['type'] = 'success';  
        }
        return response()->json(['response' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tingkat  $tingkat
     * @return \Illuminate\Http\Response
     */
    public function show(Tingkat $tingkat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tingkat  $tingkat
     * @return \Illuminate\Http\Response
     */
    public function edit(Tingkat $tingkat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tingkat  $tingkat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tingkat $tingkat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tingkat  $tingkat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tingkat $tingkat)
    {
        //
    }
}

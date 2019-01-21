<?php

namespace App\Http\Controllers;

use App\Predikat;
use Illuminate\Http\Request;

class PredikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendidikan.predikat.index');
    }

    public function getPredikatAll()
    {
        return Predikat::all();
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
            'nilai_minimal' => 'required',
            'nilai_maksimal' => 'required',
            'keterangan' => 'required'
        ]);

        $predikat = Predikat::create($request->all());

        return response()->json($predikat);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Predikat  $predikat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Predikat::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Predikat  $predikat
     * @return \Illuminate\Http\Response
     */
    public function edit(Predikat $predikat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Predikat  $predikat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nilai_minimal' => 'required',
            'nilai_maksimal' => 'required',
            'keterangan' => 'required'
        ]);

        $predikat = Predikat::find($id)->update($request->all());

        return response()->json($predikat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Predikat  $predikat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $predikat = Predikat::find($id)->delete();

        return response()->json($predikat);
    }
}

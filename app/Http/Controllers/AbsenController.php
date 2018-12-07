<?php

namespace App\Http\Controllers;

use App\Absen;
<<<<<<< HEAD
use App\Santri;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Resources\AbsenSantriResource;
use Carbon\Carbon;
use DB;
=======
use Illuminate\Http\Request;
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        return view('pendidikan.absen.absen');
    }

    public function getSantriDataTables(Request $request)
    {
        return AbsenSantriResource::collection(Santri::orderBy('nama_santri', 'ASC')->with([
                                'asrama.ngaran',
                                'kobong',
                                'tingkat',
                                'kelas',
                                'dewan'
                                ])->whereKelasId($request->kelas_id)->select('santri.*')->get());
=======
        //
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
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
<<<<<<< HEAD
        $checkDuplicatePresence = Absen::whereSantriId($request->santri_id)->whereKegiatanId($request->kegiatan_id)->whereDate('created_at', Carbon::parse($request->created_at)->format('Y-m-d'))->count();
        if ($checkDuplicatePresence > 0) {
            $data['message'] = 'Santri '. \App\Santri::find($request->santri_id)->nama_santri. ' sudah melakukan absen di kegiatan ini!';
        }else{
            $absen = new Absen();
            $absen->santri_id = $request->santri_id; 
            $absen->kegiatan_id = $request->kegiatan_id; 
            $absen->keterangan = $request->keterangan; 
            $absen->created_at = Carbon::parse($request->created_at)->format('Y-m-d'); 
            $absen->updated_at = Carbon::parse($request->created_at)->format('Y-m-d'); 
            $absen->save();
            $data['message'] = 'Berhasil di absen!';   
        }
        return response()->json(['response' => $data]);
=======
        //
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function destroy($id)
    {
        $absen = Absen::find($id)->delete();
        return response()->json(['response' => 'success']);
=======
    public function destroy(Absen $absen)
    {
        //
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
    }
}

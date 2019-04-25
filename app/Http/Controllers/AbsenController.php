<?php

namespace App\Http\Controllers;

use App\Absen;
use App\Santri;
use App\Asrama;
use App\Kelas;
use App\Kegiatan;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Resources\AbsenSantriResource;
use Carbon\Carbon;
use DB;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
                                ])->whereAsramaId($request->asrama_id)->whereStatus('aktif')->select('santri.*')->get());
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
    public function destroy($id)
    {
        $absen = Absen::find($id)->delete();
        return response()->json(['response' => 'success']);
    }

    public function santri(Request $request)
    {
        $santri = array();
        if ($request->kelas_id) {
            $santri = Santri::whereKelasId($request->kelas_id)->whereStatus('aktif')->get();
        }
        if($request->asrama_id)
        {
            $santri = Santri::whereAsramaId($request->asrama_id)->whereStatus('aktif')->get();
        }

        return response()->json(['data' => $santri]);
    }

    public function listKegiatan()
    {
        $listKegiatan = Kegiatan::orderBy('mulai_kegiatan', 'ASC')->get();
        return response()->json(['data' => $listKegiatan]);
    }

    public function report()
    {
        
    }

    public function reportView(Request $request)
    {
        $asramas = Asrama::all();
        $kelass = Kelas::all();
        $listSantris = array();
        $listKegiatans = Kegiatan::all();
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        // if ($request->kelas_id) {
        //     $listSantris = Santri::whereKelasId($request->kelas_id)->get();
        // }else if($request->asrama_id){
        //     $listSantris = Santri::whereAsramaId($request->asrama_id)->get();
        // }
            $listSantris = Santri::whereAsramaId($request->asrama_id)->orWhere('kelas_id', $request->kelas_id)->get();


        return view('pendidikan.absen.report', compact('asramas', 'kelass', 'listSantris', 'listKegiatans', 'start_date', 'end_date'));
    }
}

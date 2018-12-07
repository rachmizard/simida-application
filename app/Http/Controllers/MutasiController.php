<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Santri;
use DB;
use Carbon\Carbon;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sekretariat.mutasi.mutasi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getSantriDataTables(Request $request, Datatables $datatables)
    {
         $santri = Santri::with([
                                'asrama.ngaran',
                                'kobong',
                                'tingkat',
                                'kelas',
                                'dewan'
                                ])->select('santri.*');
        return $datatables->eloquent($santri) 
                              ->addColumn('action', function($var){
                                return '
                                        <div class="text-center">
                                            <a href="#/mutasi/santri/'. $var->id .'" class="btn btn-xs btn-info text-white" title="Pindah Asrama"><i class="icon wb-random"></i></a>
                                        </div>

                                        ';
                              })
                              ->editColumn('nis', function($var){
                                return '<span class="badge badge-round badge-dark badge-md">'. $var->nis .'</span>';
                              })
                              // ->addColumn('foto', function($var){
                              //       return '<img src="/storage/santri_pic/'. $var->foto .'" width="100" height="100" alt="Foto Santri '. $var->nama_santri .'">';
                              // })
                              ->filter(function($query) use ($request){
                                if ($request->get('filter_nis')) {
                                    return $query->where('nis', '=', request()->get('filter_nis'))->first();
                                }

                                if ($request->get('filter_kelas')) {
                                    $query->where('kelas_id', request()->get('filter_kelas'))->get();
                                }
                              }, true)
                              ->rawColumns(['action', 'nis'])
                              ->make(true);
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
        $mutasi = Santri::find($id);
        // Send a report
        $report = DB::table('report_mutasi')
                ->insert([
                    'santri_id' => $id,
                    'asrama_asal_id' => $mutasi->asrama_id,
                    'asrama_tujuan_id' => $request->asrama_id,
                    'kobong_asal_id' => $mutasi->kobong_id,
                    'kobong_tujuan_id' => $request->kobong_id,
                    'alasan_mutasi' => $request->alasan_mutasi,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
        if ($report) {
            $mutasi->update(['asrama_id' => $request->asrama_id, 'kobong_id' => $request->kobong_id ]);
        }
        return response()->json(['response' => 'success']);
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

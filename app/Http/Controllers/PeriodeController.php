<?php

namespace App\Http\Controllers;

use App\Periode;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;


class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendidikan.periode.periode');
    }

    public function getPeriodeDataTables(Datatables $datatables)
    {
        $periode = Periode::select('periode.*');
        return $datatables->eloquent($periode) 
                              ->addColumn('action', function($var){
                                return '
                                        <div class="btn-group text-center">
                                            <a href="#/aktif/periode/'. $var->id .'" class="btn btn-xs btn-info text-white"><i class="icon wb-check"></i></a>
                                            <a href="#/edit/periode/'. $var->id .'" class="btn btn-xs btn-warning text-white"><i class="icon wb-edit"></i></a>
                                            <a href="#/hapus/periode/'. $var->id .'" class="btn btn-xs btn-danger text-white"><i class="icon wb-trash"></i></a>
                                        </div>

                                        ';
                              })
                              ->editColumn('status', function($var){
                                if ($var->status == 'aktif') {
                                    return '<span class="badge badge-round badge-md badge-success">Aktif</span>'; 
                                }else{
                                    return '<span class="badge badge-round badge-md badge-dark">Tidak Aktif</span>';
                                }
                              })
                              ->rawColumns(['action', 'status'])
                              ->make(true);
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
        $periode = Periode::insert([
            'nama_periode' => $request->nama_periode,
            'start_date' => date('Y-m-d', strtotime($request->start_date)),
            'end_date' => date('Y-m-d', strtotime($request->end_date))
        ]);

        $data['message'] = 'Berhasil di ditambahkan!';
        $data['messageWarning'] = false;
        $data['messageError'] = false;
        return response()->json(['response' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Periode::find($id);
    }

    public function isactived()
    {
        return Periode::whereStatus('aktif')->first();
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $periode = Periode::find($id);
        $periode->update($request->all());
        $data['message'] = 'Berhasil di edit!';
        $data['messageWarning'] = false;
        $data['messageError'] = false;   

        return response()->json(['response' => $data]);
    }

    public function aktif($id)
    {
        $get = Periode::whereStatus('aktif')->first();
        $reset = Periode::whereIn('status', $get)->update(['status' => 'tidak_aktif']);
        $periode = Periode::find($id);
        $periode->update(['status' => 'aktif']);

        $data['message'] = 'Periode '. $periode->nama_periode .' telah di aktifkan!';
        $data['messageWarning'] = false;
        $data['messageError'] = false;   

        return response()->json(['response' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periode = Periode::find($id);
        $periode->delete();
        return response()->json(['response' => 'success']);
    }
}

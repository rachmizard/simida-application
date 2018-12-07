<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
=======
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        return view('pendidikan.kegiatan.kegiatan');
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

<<<<<<< HEAD
    public function getKegiatanDataTables(Datatables $datatables)
    {
    $kegiatans = Kegiatan::select('kegiatan.*');
        return $datatables->eloquent($kegiatans)
                ->addColumn('action', function($kegiatans){
                    return '
                        <div class="text-center">
                            <a href="#/kegiatan/edit/'. $kegiatans->id .'" class="btn btn-sm btn-warning"><i class="icon wb-edit"></i></a>
                            <a href="#/kegiatan/hapus/'. $kegiatans->id .'" class="btn btn-sm btn-danger"><i class="icon wb-trash"></i></a>
                        </div>

                            ';
                })
                ->editColumn('mulai_kegiatan', function($var){
                    return '<span class="badge badge-primary">'. $var->mulai_kegiatan .'</span>';
                })
                ->editColumn('akhir_kegiatan', function($var){
                    return '<span class="badge badge-danger">'. $var->akhir_kegiatan .'</span>';     
                })
                ->rawColumns(['action', 'mulai_kegiatan', 'akhir_kegiatan'])
                ->make(true);
    }

    public function JSON()
    {
        $kegiatans = Kegiatan::orderBy('id', 'DESC')->get();
        return response()->json(['data' => $kegiatans]);
    }

=======
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        $this->validate($request, [
            'nama_kegiatan' => 'required',
            'mulai_kegiatan' => 'required',
            'akhir_kegiatan' => 'required',
        ]);

        $validator = Kegiatan::where('mulai_kegiatan', Carbon::parse($request->mulai_kegiatan)->format('H:i'))->where('mulai_kegiatan', Carbon::parse($request->mulai_kegiatan)->format('H:i'))->count();
        $getData = Kegiatan::where('mulai_kegiatan', Carbon::parse($request->mulai_kegiatan)->format('H:i'))->where('mulai_kegiatan', Carbon::parse($request->mulai_kegiatan)->format('H:i'))->first();
        if ($validator > 0) {
            $data['message'] = false;
            $data['messageWarning'] = 'Jadwal kegiatan telah tersedia oleh kegiatan '. $getData['nama_kegiatan'] .' pada pukul '. Carbon::parse($getData['mulai_kegiatan'])->format('H:i') .' sampai '. Carbon::parse($getData['akhir_kegiatan'])->format('H:i');
            $data['messageError'] = false;   
        }else{
            $kegiatan = Kegiatan::create([
                            'nama_kegiatan' => $request->nama_kegiatan,
                            'mulai_kegiatan' => Carbon::parse($request->mulai_kegiatan)->format('H:i'),
                            'akhir_kegiatan' => Carbon::parse($request->akhir_kegiatan)->format('H:i')
                        ]);
            $data['message'] = 'Kegiatan berhasil di tambahkan!';
            $data['messageWarning'] = false;
            $data['messageError'] = false;   
        }
        return response()->json(['response' => $data]);
=======
        //
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function show($id)
    {
        return Kegiatan::find($id);
=======
    public function show(Kegiatan $kegiatan)
    {
        //
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function update(Request $request, $id)
    {
       $this->validate($request, [
            'nama_kegiatan' => 'required',
            'mulai_kegiatan' => 'required',
            'akhir_kegiatan' => 'required',
        ]);

        $validator = Kegiatan::where('mulai_kegiatan', Carbon::parse($request->mulai_kegiatan)->format('H:i'))->where('mulai_kegiatan', Carbon::parse($request->mulai_kegiatan)->format('H:i'))->count();
        $getData = Kegiatan::where('mulai_kegiatan', Carbon::parse($request->mulai_kegiatan)->format('H:i'))->where('mulai_kegiatan', Carbon::parse($request->mulai_kegiatan)->format('H:i'))->first();
        if ($validator > 0 && !$id) {
            $data['message'] = false;
            $data['messageWarning'] = 'Jadwal kegiatan telah tersedia oleh kegiatan '. $getData['nama_kegiatan'] .' pada pukul '. Carbon::parse($getData['mulai_kegiatan'])->format('H:i') .' sampai '. Carbon::parse($getData['akhir_kegiatan'])->format('H:i');
            $data['messageError'] = false;      
        }else{
            $kegiatan = Kegiatan::find($id)->update([
                            'nama_kegiatan' => $request->nama_kegiatan,
                            'mulai_kegiatan' => Carbon::parse($request->mulai_kegiatan)->format('H:i'),
                            'akhir_kegiatan' => Carbon::parse($request->akhir_kegiatan)->format('H:i')
                        ]);
            $data['message'] = 'Kegiatan berhasil di edit!';
            $data['messageWarning'] = false;
            $data['messageError'] = false;   
        }
        return response()->json(['response' => $data]);
=======
    public function update(Request $request, Kegiatan $kegiatan)
    {
        //
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function destroy($id)
    {
        $kegiatan = Kegiatan::find($id)->delete();
        $data['message'] = 'Kegiatan berhasil di hapus!';
        $data['messageWarning'] = false;
        $data['messageError'] = false;   
        return response()->json(['response' => $data]);
=======
    public function destroy(Kegiatan $kegiatan)
    {
        //
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
    }
}

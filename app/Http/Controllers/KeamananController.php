<?php

namespace App\Http\Controllers;
use App\Keamanan;
use App\Notifikasi;
use App\Santri;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class KeamananController extends Controller
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

    public function listSantriIzin(Request $request)
    {
        
    }

    public function listSantriIzinWithFilter(Request $request)
    {
        $santri = Santri::with(['kelas', 'asrama.ngaran'])->where('nama_santri', $request->nama_santri )->orWhere('nis', $request->nis)->get();
        $available = count($santri) > 0 ? true : false;
        return response()->json(['data' => $santri, 'available' => $available]);
    }

    public function getListSantriIzinDataTables(Datatables $datatables, Request $request)
    {
        $entriIzin = Keamanan::select('keamanan.*');
        return $datatables->of($entriIzin)
        ->editColumn('kategori', function($var){
            if ($var->kategori == 'jauh') {
                return '<span class="badge badge-danger">Jauh</span>';
            }else if($var->kategori == 'dekat'){
                return '<span class="badge badge-info">Dekat</span>';
            }
        })
        ->editColumn('status', function($var){
            if ($var->status == 'belum_kembali') {
                return '<span class="badge badge-danger">Belum Kembali</span>';
            }else if($var->status == 'sudah_kembali'){
                return '<span class="badge badge-success">Sudah Kembali</span>';
            }
        })
        ->filter(function ($query) use ($request){
            if (request()->has('start_date') && request()->has('end_date')) {
                $query->whereBetween('created_at', [Carbon::parse($request->get('start_date'))->format('Y-m-d'), Carbon::parse($request->get('end_date'))->format('Y-m-d')]);
            }
        })
        ->rawColumns(['kategori', 'status'])
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Keamanan::where('santri_id', $request->santri_id)
                            ->where('kategori', $request->kategori)
                            ->where('status', 'belum_kembali')
                            ->whereDate('created_at', Carbon::now()->format('Y-m-d'))
                            ->get();

        $entri = new Keamanan();
        if ($request->kategori == 'jauh') {
            $this->validate($request, [
                'santri_id' => 'required', 
                'kategori' => 'required', 
                'alasan' => 'required', 
                'tujuan' => 'required', 
                'pemberi_izin' => 'required',
                'tgl_berakhir_izin' => 'required'
            ]);

            if (count($validator) > 0) {
                $message['message'] = false;
                $message['messageAlert'] = true;
            }else{
                $entri->santri_id = $request->santri_id;
                $entri->kategori = $request->kategori;
                $entri->alasan = $request->alasan;
                $entri->tujuan = $request->tujuan;
                $entri->status = 'belum_kembali';
                $entri->pemberi_izin = $request->pemberi_izin;
                $entri->tgl_berakhir_izin = Carbon::parse($request->tgl_berakhir_izin)->format('Y-m-d');
                $message['message'] = true;
                $message['messageAlert'] = false;
                $entri->save();
            }
        }else{

            $this->validate($request, [
                'santri_id' => 'required', 
                'kategori' => 'required', 
                'tujuan' => 'required', 
                'alasan' => 'required', 
            ]);


            if (count($validator) > 0) {
                $message['message'] = false;
                $message['messageAlert'] = true;
            }else{
                $entri->santri_id = $request->santri_id;
                $entri->kategori = $request->kategori;
                $entri->alasan = $request->alasan;
                $entri->tujuan = $request->tujuan;
                $entri->status = 'belum_kembali';
                $message['message'] = true;
                $message['messageAlert'] = false;
                $entri->save();
            }
        }

        return response()->json(['response' => $message]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Keamanan::findOrFail($id);
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
        $this->validate($request, [
            'santri_id' => 'required', 
            'kategori' => 'required', 
            'alasan' => 'required', 
            'durasi' => 'required', 
            'status' => 'required', 
            // 'pemberi_izin' => 'required'
        ]);

        // $validator = Keamanan::whereSantriId($request->santri_id)
        //                     ->whereKategori($request->kategori)
        //                     ->whereStatus($request->status)
        //                     ->get();
                            
        $entri = Keamanan::findOrFail($id);
        // if (count($validator) > 0) {
        //     $message['message'] = 'Santri tersebut sudah melakukan izin!';
        // }else{
            $entri->santri_id = $request->santri_id;
            $entri->kategori = $request->kategori;
            $entri->alasan = $request->alasan;
            $entri->tujuan = $request->tujuan;
            $entri->status = $request->status;
            $entri->pemberi_izin = $request->pemberi_izin;
            $entri->update();

            $message['message'] = 'Entri Izin Santri berhasil diupdate!';
        // }

        return response()->json(['response' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entri = Keamanan::find($id)->delete();

        return response()->json(['response' => 'success']);
    }

    public function getPemberitahuan(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
            $filters = Notifikasi::whereTipe('keamanan')->whereBetween('created_at', [$start_date, $end_date])->get();
        }else{
            $filters = Notifikasi::orderBy('created_at', 'ASC')->whereTipe('keamanan')->paginate(30);
        }

        return response()->json(['data' => $filters]);
    }
}

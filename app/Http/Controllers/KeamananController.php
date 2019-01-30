<?php

namespace App\Http\Controllers;
use App\Keamanan;
use App\Notifikasi;
use App\Santri;
use App\HistoriIzin;
use App\Http\Resources\LaporanEntriIzinResource;
use App\Http\Resources\DetailEntriResource;
use App\Events\RefreshNotification;
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
        $santri = Santri::orderBy('nama_santri', 'ASC')->with(['kelas', 'asrama.ngaran'])->where('nama_santri', 'like', '%'.$request->nama_santri.'%' )->orWhere('nis', $request->nis)->get();
        $available = count($santri) > 0 ? true : false;
        return response()->json(['data' => $santri, 'available' => $available]);
    }

    public function getListSantriIzinDataTables(Datatables $datatables, Request $request)
    {
        $entriIzin = Keamanan::select('keamanan.*')->with(['santri'])->where('created_at', Carbon::now());
        return $datatables->eloquent($entriIzin)
        ->addColumn('action', function($var){
            if ($var['status'] == 'sudah_kembali') {  
                return '
                    <a class="btn btn-xs btn-black" href="#" title="Sudah dinyatakan kembali" disabled><i class="icon wb-check"></i></a>
                    <a class="btn btn-xs btn-primary" href="#/detail/entri/'. $var['santri_id'] .'/keamanan/'. $var['id'] .'" title="Lihat Detil"><i class="icon wb-eye"></i></a>
                    <a class="btn btn-xs btn-warning" href="#/edit/keamanan/'. $var['id'] .'" title="Edit"><i class="icon wb-pencil"></i></a>
                    <a class="btn btn-xs btn-danger" href="#/delete/entri/'. $var['id'] .'" title="Hapus"><i class="icon wb-trash"></i></a>
                ';
            }else if($var['status'] == 'belum_kembali'){  
                return '
                    <a class="btn btn-xs btn-info" href="#/update/status/'. $var['id'] .'" title="Nyatakan status kembali"><i class="icon wb-check"></i></a>
                    <a class="btn btn-xs btn-primary" href="#/detail/entri/'. $var['santri_id'] .'/keamanan/'. $var['id'] .'" title="Lihat Detil"><i class="icon wb-eye"></i></a>
                    <a class="btn btn-xs btn-warning" href="#/edit/keamanan/'. $var['id'] .'" title="Edit"><i class="icon wb-pencil"></i></a>
                    <a class="btn btn-xs btn-danger" href="#/delete/entri/'. $var['id'] .'" title="Hapus"><i class="icon wb-trash"></i></a>
                ';
            }
        })
        ->editColumn('kategori', function($var){
            if ($var->kategori == 'jauh') {
                return '<span class="badge badge-warning text-white">Jauh</span>';
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
        ->editColumn('tgl_berakhir_izin', function($var){
            if ($var->tgl_berakhir_izin == null) {
                return '-';
            }else{
                return date('d-m-Y', strtotime($var->tgl_berakhir_izin));
            }
        })
        ->editColumn('created_at', function($var){
            if ($var->created_at == null) {
                return '-';
            }else{
                return date('d-m-Y H:i:s', strtotime($var->created_at));
            }
        })
      ->filter(function($query) use ($request){
        if (request()->get('start_date') && request()->get('end_date')) {
          return $query->whereBetween('created_at', [request()->get('start_date'), request()->get('end_date')]);
        }
      }, true)
        ->rawColumns(['action', 'kategori', 'status'])
        ->make(true);
    }

    public function getListKeamanan(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $parseStartDate = Carbon::parse($request->start_date)->format('Y-m-d');
            $parseEndDate = Carbon::parse($request->end_date)->format('Y-m-d');
            $entriIzin = LaporanEntriIzinResource::collection(Keamanan::orderBy('created_at', 'ASC')->with(['santri'])->whereStatus($request->status)->whereBetween('created_at', [$parseStartDate, $parseEndDate])->get());
        }else{
            $entriIzin = LaporanEntriIzinResource::collection(Keamanan::orderBy('created_at', 'ASC')->with(['santri'])->select('keamanan.*')->get());
        }

        return response()->json(['data' => $entriIzin]);
    }

    public function getSantri($id)
    {
        return Santri::with(['kelas', 'asrama.ngaran', 'kobong'])->find($id);
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

        $setterDate = Carbon::now();

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
                $entri->tgl_berakhir_izin = date('Y-m-d', strtotime($request->tgl_berakhir_izin));
                $message['message'] = true;
                $message['messageAlert'] = false;
                $entri->save();

                $kode_izin = $entri['id'] + 1;

                $storeHistory = HistoriIzin::create([
                    'kode_izin' => 'SK'.$kode_izin.'',
                    'keamanan_id' => $entri->id,
                    'santri_id' => $request->santri_id, 
                    'tujuan' => $request->tujuan, 
                    'alasan' => $request->alasan, 
                    'kategori' => $request->kategori, 
                    'status' => 'belum_kembali', 
                    'pemberi_izin' => $request->pemberi_izin,
                    'tgl_berakhir_izin' => date('Y-m-d', strtotime(Carbon::parse($request->tgl_berakhir_izin)->format('Y-m-d'))),
                ]);

                $updateHistoryIdAndKodeIzin = Keamanan::find($entri->id)
                                        ->update(['kode_izin' => 'SK'.$kode_izin.'']);
            }
        }else{
            $this->validate($request, [
                'santri_id' => 'required', 
                'kategori' => 'required', 
                'tujuan' => 'required', 
                'alasan' => 'required', 
                'jam_berakhir' => 'required'
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
                $entri->jam_berakhir = $request->jam_berakhir;
                $message['message'] = true;
                $message['messageAlert'] = false;
                $entri->save();

                $kode_izin = $entri['id'] + 1;

                $storeHistory = HistoriIzin::create([
                    'kode_izin' => 'SK'.$kode_izin.'',
                    'keamanan_id' => $entri->id,
                    'santri_id' => $request->santri_id, 
                    'tujuan' => $request->tujuan, 
                    'alasan' => $request->alasan, 
                    'kategori' => $request->kategori, 
                    'status' => 'belum_kembali', 
                ]);

                $updateHistoryIdAndKodeIzin = Keamanan::find($entri->id)
                                        ->update(['kode_izin' => 'SK'.$kode_izin.'']);

            }
        }

        return response()->json(['response' => $message]);

    }

    public function historyByKeamananId($id)
    {
        $historyBySantriId = DetailEntriResource::collection(HistoriIzin::with(['santri'])->where('keamanan_id', $id)->get());
        return response()->json($historyBySantriId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Keamanan::with(['santri'])->findOrFail($id);
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
       // $validator = Keamanan::where('santri_id', $request->santri_id)
       //                      ->where('kategori', $request->kategori)
       //                      ->where('status', 'belum_kembali')
       //                      ->whereDate('created_at', Carbon::now()->format('Y-m-d'))
       //                      ->get();

        $entri = Keamanan::find($id);
        if ($request->kategori == 'jauh') {
            $this->validate($request, [
                'santri_id' => 'required', 
                'kategori' => 'required', 
                'alasan' => 'required', 
                'tujuan' => 'required', 
                'pemberi_izin' => 'required',
                'tgl_berakhir_izin' => 'required'
            ]);

            $entri->santri_id = $request->santri_id;
            $entri->kategori = $request->kategori;
            $entri->alasan = $request->alasan;
            $entri->tujuan = $request->tujuan;
            $entri->pemberi_izin = $request->pemberi_izin;
            $entri->tgl_berakhir_izin = date('Y-m-d', strtotime($request->tgl_berakhir_izin));
            $message['message'] = true;
            $message['messageAlert'] = false;
            $entri->save();

            $storeHistory = HistoriIzin::whereKeamananId($entri->id)->update([
                'keamanan_id' => $entri->id,
                'kode_izin' => $entri->kode_izin,
                'santri_id' => $entri->santri_id, 
                'tujuan' => $entri->tujuan, 
                'alasan' => $entri->alasan, 
                'kategori' => $entri->kategori, 
                'pemberi_izin' => $entri->pemberi_izin, 
                'tgl_berakhir_izin' => date('Y-m-d', strtotime($entri->tgl_berakhir_izin))
            ]);
        }else{
                $this->validate($request, [
                    'santri_id' => 'required', 
                    'kategori' => 'required', 
                    'tujuan' => 'required', 
                    'alasan' => 'required', 
                    'jam_berakhir' => 'required'
                ]);

                $entri->santri_id = $request->santri_id;
                $entri->kategori = $request->kategori;
                $entri->alasan = $request->alasan;
                $entri->tujuan = $request->tujuan;
                $message['message'] = true;
                $message['messageAlert'] = false;
                $entri->save();

                $storeHistory = HistoriIzin::whereKeamananId($entri->id)->update([
                    'keamanan_id' => $entri->id,
                    'kode_izin' => $entri->kode_izin,
                    'santri_id' => $entri->santri_id, 
                    'tujuan' => $entri->tujuan, 
                    'alasan' => $entri->alasan, 
                    'kategori' => $entri->kategori, 
                    'jam_berakhir' => $entri->jam_berakhir
                ]);
        }

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

        if ($entri) {
            $historyDeletes = HistoriIzin::whereKeamananId($id)->delete();
        }

        return response()->json(['response' => 'success']);
    }

    public function getPemberitahuan(Request $request)
    {
        
        if ($request->start_date && $request->end_date) {
            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
            $filters = Notifikasi::orderBy('created_at', 'DESC')->whereTipe('keamanan')->whereBetween('created_at', [$start_date, $end_date])->get();
        }else{
            $filters = Notifikasi::orderBy('created_at', 'DESC')->whereTipe('keamanan')->paginate(30);
        }

        return response()->json(['data' => $filters]);
    }

    public function getPemberitahuanWhereIsUnRead()
    {
        $filters = Notifikasi::orderBy('created_at', 'DESC')->whereTipe('keamanan')->whereStatus('unread')->paginate(30);
        return response()->json(['data' => $filters]);
    }

    public function countingNotifications()
    {
        $notifications = Notifikasi::whereTipe('keamanan')->whereStatus('unread')->count();
        return response()->json(['total_unread' => $notifications]);
    }

    public function markAsRead($id)
    {
        $markAsRead = Notifikasi::findOrFail($id)->update(['status' => 'read']);
        event(new RefreshNotification());
        return response()->json(['response' => 'success']);
    }

    public function ceklisSantriKembali(Request $request, $id)
    {
        $getKeamananInfo = Keamanan::find($id);
        $ceklis = Keamanan::find($id)->update(['status' => 'sudah_kembali']);
        $storeHistory = HistoriIzin::create([
                    'keamanan_id' => $id,
                    'kode_izin' => $getKeamananInfo->kode_izin,
                    'santri_id' => $getKeamananInfo->santri_id, 
                    'tujuan' => $getKeamananInfo->tujuan, 
                    'alasan' => $getKeamananInfo->alasan, 
                    'kategori' => $getKeamananInfo->kategori, 
                    'status' => 'sudah_kembali',
                    'tgl_berakhir_izin' => Carbon::now(),
                    'jam_berakhir' => Carbon::now()->format('H:i:s'),
                    'created_at' => $getKeamananInfo['created_at'],
                    'pemberi_izin' => $getKeamananInfo['pemberi_izin']
                ]);
        return response()->json(['response' => 'success']);
    }
}

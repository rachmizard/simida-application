<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use App\TotalUang;
use App\Periode;
use App\NamaJenisPengeluaran;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
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

    public function getPengeluaranDataTables(Datatables $datatables)
    {
        $pengeluarans = Pengeluaran::with('jenispengeluaran')->select('pengeluaran.*');
        return $datatables->eloquent($pengeluarans)
                        ->addColumn('action', function($var){
                            return '
                            <div class="text-center">
                                <a href="#/keuangan/pengeluaran/hapus/'. $var->id .'" class="btn btn-sm btn-danger" title="Hapus pengeluaran"><i class="icon wb-trash"></i></a>
                            </div>';
                        })
                        ->rawColumns(['action'])
                        ->make(true);
    }

    public function getNamaJenisPengeluaran()
    {
        $getNamaJenisPengeluaran = NamaJenisPengeluaran::get();
        return response()->json(['data' => $getNamaJenisPengeluaran]);
    }



    public function sekliaspengeluaran()
    {
        return response()->json(Pengeluaran::with('jenispengeluaran')->orderBy('jumlah_pengeluaran', 'DESC')->paginate(10));
    }

    public function totalpengeluaran()
    {
        
        $periodeDefaultSet = Periode::whereStatus('aktif')->first();

        $start_date = Carbon::parse($periodeDefaultSet['start_date'])->format('Y-m-d');
        $end_date = Carbon::parse($periodeDefaultSet['end_date'])->format('Y-m-d');

        $totalByPeriodeActive = Pengeluaran::whereBetween('tgl_pengeluaran', [$start_date, $end_date])->sum('jumlah_pengeluaran');


        return response()->json(['total' => $totalByPeriodeActive, 'periode' => $periodeDefaultSet['nama_periode']]);
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
            'tgl_pengeluaran' => 'required', 
            'jenis_pengeluaran' => 'required', 
            'jumlah_pengeluaran' => 'required', 
            'keterangan' => 'required', 
        ]);

        $pengeluaran = new Pengeluaran();
        $pengeluaran->tgl_pengeluaran = \Carbon\Carbon::parse($request->tgl_pengeluaran)->format('Y-m-d');
        $pengeluaran->jenis_pengeluaran = $request->jenis_pengeluaran;
        $pengeluaran->jumlah_pengeluaran = $request->jumlah_pengeluaran;
        $pengeluaran->keterangan = $request->keterangan;

        $getDefaultPeriode = Periode::whereStatus('aktif')->first();
        $getTotalUang = TotalUang::where('periode', $getDefaultPeriode['nama_periode'])->first();
        if ($getTotalUang['total_nominal'] < $request->jumlah_pengeluaran) {
            $message['messageAlert'] = 'Tidak dapat diproses, kas keuangan tidak mencukupi.';
            $message['messageSucess'] = false;
        }else{
            $kuranginUangnya = $getTotalUang['total_nominal'] - $request->jumlah_pengeluaran;
            $updateTotalUang = TotalUang::wherePeriode($getDefaultPeriode['nama_periode'])->update(['total_nominal' => $kuranginUangnya]);
            $pengeluaran->save();   
            $message['messageAlert'] = false;
            $message['messageSucess'] = 'success';
        }

        return response()->json(['response' => $message]);

    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $var = new NamaJenisPengeluaran();
        $var->nama_jenis_pengeluaran = $request->name;
        $var->save();

        return response()->json(['response' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Pengeluaran::find($id);
    }

    public function showJenisPengeluaran($id)
    {
        return NamaJenisPengeluaran::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tgl_pengeluaran' => 'required', 
            'jenis_pengeluaran' => 'required', 
            'jumlah_pengeluaran' => 'required', 
            'keterangan' => 'required', 
        ]);

        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->tgl_pengeluaran = \Carbon\Carbon::parse($request->tgl_pengeluaran)->format('Y-m-d');
        $pengeluaran->jenis_pengeluaran = $request->jenis_pengeluaran;
        $pengeluaran->jumlah_pengeluaran = $request->jumlah_pengeluaran;
        $pengeluaran->keterangan = $request->keterangan;

        $getDefaultPeriode = Periode::whereStatus('aktif')->first();
        $getTotalUang = TotalUang::where('periode', $getDefaultPeriode['nama_periode'])->first();
        $kuranginUangnya = $getTotalUang['total_nominal'] - $request->jumlah_pengeluaran;
        $updateTotalUang = TotalUang::wherePeriode($getDefaultPeriode['nama_periode'])->update(['total_nominal' => $kuranginUangnya]);
        $pengeluaran->update();

        return response()->json(['response' => 'success']);
    }

    public function updateJenisPengeluaran(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $jenispengeluaran = NamaJenisPengeluaran::find($id);
        $jenispengeluaran->update(['nama_jenis_pengeluaran' => $request->name ]);

        return response()->json(['response' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapusPengeluaran = Pengeluaran::find($id);
        $getDefaultPeriode = Periode::whereStatus('aktif')->first();
        $getTotalUang = TotalUang::where('periode', $getDefaultPeriode['nama_periode'])->value('total_nominal');
        $tambahinUangnya = $getTotalUang + $hapusPengeluaran['jumlah_pengeluaran'];
        $updateTotalUang = TotalUang::wherePeriode($getDefaultPeriode['nama_periode'])->update(['total_nominal' => $tambahinUangnya]);
        $hapusPengeluaran->delete();

        return response()->json(['response' => 'success!']);
    }

    public function jenispengeluaranDestroy($id)
    {
        $hapusJenisPengeluaran = NamaJenisPengeluaran::find($id);
        $hapusJenisPengeluaran->delete();

        return response()->json(['response' => 'success']);
    }
}

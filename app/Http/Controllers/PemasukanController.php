<?php

namespace App\Http\Controllers;

use App\Pemasukan;
use App\Periode;
use App\Santri;
use App\Kelas;
use App\Asrama;
use Carbon\Carbon;
use DB;
use App\TotalUang;
use App\Http\Resources\SyariahSantriResource;
use App\Http\Resources\RiwayatSyariahPerSantriResource;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class PemasukanController extends Controller
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

    public function getPemasukanDataTables(Request $request, Datatables $datatables)
    {
        $pemasukans = Pemasukan::query();
        return $datatables->eloquent($pemasukans)
        ->editColumn('jumlah_pemasukan', function($var){
            return "Rp " . number_format($var->jumlah_pemasukan,2,',','.');
        })
        ->editColumn('jenis_pemasukan', function($var){
            if ($var->jenis_pemasukan == 'donatur') {
                return '<span class="badge badge-sm bg-yellow-700 text-white">DONATUR</span>';
            }else if ($var->jenis_pemasukan == 'infaq') {
                return '<span class="badge badge-sm bg-blue-700 text-white">Infaq</span>';
            }else if ($var->jenis_pemasukan == 'syariah') {
                return '<span class="badge badge-sm bg-green-700 text-white">Syariah</span>';
            }
        })
        ->addColumn('action', function($var){
            return '
            <div class="text-center">
            <a title="Hapus pemasukan" href="#/keuangan/pemasukan/hapus/'. $var->id .'" class="btn btn-xs btn-round btn-danger"><i class="icon wb-trash"></i></a>
            </div>
            ';
        })
        ->filter(function($query) use ($request){
            if (request()->get('filter_jenis_pemasukan')) {
                $query->where('jenis_pemasukan', request()->get('filter_jenis_pemasukan'))->get();
            }

            if (request()->get('filter_bulan') && request()->get('filter_tahun')) {
                $query->whereYear('created_at', request()->get('filter_tahun'))->whereMonth('created_at', request()->get('filter_bulan'))->get();
            }
        })
        ->rawColumns(['jenis_pemasukan', 'action'])
        ->make(true);
    }

    public function getSantriForSyariah(Request $request)
    {
        $this->validate($request, [
            'bulan' => 'required'
        ]);
        return SyariahSantriResource::collection(Santri::whereNis($request->nis)->orWhere('asrama_id', $request->asrama)->whereStatus('aktif')->get());
    }

    public function checkingofpaid(Request $request)
    {
        $validator = Pemasukan::whereSantriId($request->santri_id)
                                ->where('jenis_pemasukan', 'syariah')
                                ->whereYear('tgl_pemasukan', Carbon::parse($request->tgl_pemasukan)->format('Y'))
                                ->whereMonth('tgl_pemasukan', Carbon::parse($request->tgl_pemasukan)->format('m'))
                                ->count();
                                // ngecek apabila dia sudah bayar / belum // ngecek apabila dia sudah bayar / belum
            $results = '';
            if ($validator > 0) {
                $results = true;
            }else{
                $results = false;
            }
        return response()->json(['hasil' => $results]);
    }

    public function getOnceSantri($id)
    {
        return new SyariahSantriResource(Santri::findOrFail($id));
    }

    public function riwayatPembayaranPerSantri(Request $request, $id)
    {
        if ($request->start_date && $request->end_date) {
            $riwayatPembayaranPerSantri =  RiwayatSyariahPerSantriResource::collection(Pemasukan::whereNis($request->nis)->orWhere('kelas_id', $request->kelas)->orWhere('asrama_id', $request->asrama)->get());
        }else{
            $riwayatPembayaranPerSantri =  RiwayatSyariahPerSantriResource::collection(Pemasukan::whereSantriId($id)->get());
        }
        return $riwayatPembayaranPerSantri;
    }

    public function totalPemasukan()
    {
        $periodeDefaultSet = Periode::whereStatus('aktif')->first();

        $start_date = Carbon::parse($periodeDefaultSet['start_date'])->format('Y-m-d');
        $end_date = Carbon::parse($periodeDefaultSet['end_date'])->format('Y-m-d');

        $totalByPeriodeActive = Pemasukan::whereBetween('tgl_pemasukan', [$start_date, $end_date ])->sum('jumlah_pemasukan');


        return response()->json(['total' => $totalByPeriodeActive, 'periode' => $periodeDefaultSet['nama_periode']]);
    }

    public function sekilasKeuangan()
    {
        return response()->json(Pemasukan::with('santri')->orderBy('jumlah_pemasukan', 'DESC')->paginate(10));
    }

    public function parseBulan(Request $request)
    {
        Carbon::setLocale('id');
        return response()->json(['bulan' => Carbon::parse($request->bulan)->format('F Y')]);
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
            'tgl_pemasukan' => 'required',
            'jenis_pemasukan' => 'required',
            // 'santri_id' => 'required',
            'jumlah_pemasukan' => 'required|numeric',
            // 'nama_donatur' => 'required',
            'metode_pembayaran' => 'required',
            'status_tunggakan' => 'required'
        ]);

        $storepemasukan = new Pemasukan();
            if ($request->jenis_pemasukan == 'donatur') {
                $storepemasukan->nama_donatur = $request->nama_donatur;
                $storepemasukan->tgl_pemasukan = date('Y-m-d', strtotime($request->tgl_pemasukan));
                $storepemasukan->jumlah_pemasukan = $request->jumlah_pemasukan;
                $storepemasukan->jenis_pemasukan = 'donatur';
                $storepemasukan->metode_pembayaran = $request->metode_pembayaran;
                $storepemasukan->status_tunggakan = 1; // donatur mah ga ada tunggakan, jadi ya auto lunas.
            }else if($request->jenis_pemasukan == 'infaq'){
                $storepemasukan->santri_id = $request->santri_id;
                $storepemasukan->tgl_pemasukan = date('Y-m-d', strtotime($request->tgl_pemasukan));
                $storepemasukan->jumlah_pemasukan = $request->jumlah_pemasukan;
                $storepemasukan->nama_donatur = $request->nama_donatur;
                $storepemasukan->jenis_pemasukan = 'infaq';
                $storepemasukan->metode_pembayaran = $request->metode_pembayaran;
                $storepemasukan->status_tunggakan = 1; // sama ini juga, infaq mah ga ada tunggakan2, jadi auto lunas.
            }
            // sementara di non-aktifkan di dalam fungsi store untuk jenis_pemasukan syariah
            // else if ($request->jenis_pemasukan == 'syariah') {
            //     $storepemasukan->tgl_pemasukan = Carbon::now()->format('Y-m-d');
            //     $storepemasukan->santri_id = $request->nis;
            //     $storepemasukan->jumlah_pemasukan = '300000';
            //     $storepemasukan->jenis_pemasukan = 'syariah';
            //     $storepemasukan->metode_pembayaran = $request->metode_pembayaran;
            // }
            // Push to datatabase!
            $validator = Pemasukan::whereSantriId($request->santri_id)
                                    ->whereJenisPemasukan($request->jenis_pemasukan)
                                    ->whereDate('created_at', Carbon::parse($request->tgl_pemasukan)->format('m-Y'))
                                    ->count(); // ngecek apabila dia sudah bayar / belum
            if ($validator > 0) {
                return response()->json(['response' => 'fail']);
            }else{
                $periodeDefaultSet = Periode::whereStatus('aktif')->first();
                $start_date = Carbon::parse($periodeDefaultSet['start_date'])->format('Y-m-d');
                $end_date = Carbon::parse($periodeDefaultSet['end_date'])->format('Y-m-d');

                $getTotalUang = DB::table('total_uang')->where('periode', $periodeDefaultSet['nama_periode'])->first();
                $defaultUang = Pemasukan::whereBetween('tgl_pemasukan', [$start_date, $end_date])->sum('jumlah_pemasukan');
                $masukanUang =  $defaultUang + $request->jumlah_pemasukan;
                $updateTotalUang = TotalUang::find($getTotalUang->id);
                $updateTotalUang->total_nominal = $masukanUang;
                $updateTotalUang->update();

                $storepemasukan->save();
                return response()->json(['response' => 'success']);
            }
    }

    public function storeSyariah(Request $request)
    {
        $this->validate($request, [
            'metode_pembayaran' => 'required'
        ]);

        $storepemasukan = new Pemasukan();
        $storepemasukan->tgl_pemasukan = date('Y-m-d', strtotime($request->tgl_pemasukan));
        $storepemasukan->santri_id = $request->santri_id;
        $storepemasukan->jumlah_pemasukan = $request->jumlah_pemasukan == null ? '300000' : $request->jumlah_pemasukan; // nanti mah ada master
        $storepemasukan->jenis_pemasukan = 'syariah';
        $storepemasukan->metode_pembayaran = $request->metode_pembayaran;
        if ($storepemasukan->jumlah_pemasukan >= 300000) {
            $storepemasukan->status_tunggakan = 1; // menyatakan lunas
        }else{
            $total_tunggakan = 300000 - $request->jumlah_pemasukan; // nanti akan  di masterkan
            $storepemasukan->jumlah_tunggakan = $total_tunggakan;
        }
        // Push to datatabase!
        $validator = Pemasukan::whereSantriId($request->santri_id)
                                ->where('jenis_pemasukan', 'syariah')
                                ->where('tgl_pemasukan', Carbon::parse($request->tgl_pemasukan)->format('Y-m-d'))
                                ->count(); // ngecek apabila dia sudah bayar / belum
        if ($validator > 0) {
            $message['messageAlert'] = true;
            return response()->json(['response' => $message]);
        }else{
            $periodeDefaultSet = Periode::whereStatus('aktif')->first();
            $start_date = Carbon::parse($periodeDefaultSet['start_date'])->format('Y-m-d');
            $end_date = Carbon::parse($periodeDefaultSet['end_date'])->format('Y-m-d');

            $getTotalUang = DB::table('total_uang')->where('periode', $periodeDefaultSet['nama_periode'])->first();
            $defaultUang = Pemasukan::whereBetween('tgl_pemasukan', [$start_date, $end_date])->sum('jumlah_pemasukan');
            $jumlahPemasukan = $request->jumlah_pemasukan == null ? 300000 : $request->jumlah_pemasukan; // wadah pemasukan
            $masukanUang =  $defaultUang + $jumlahPemasukan;
            $updateTotalUang = TotalUang::find($getTotalUang->id);
            $updateTotalUang->total_nominal = $masukanUang;
            $updateTotalUang->update();

            $storepemasukan->save();
            $message['message'] = 'success';
            return response()->json(['response' => $message]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Pemasukan::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $this->validate($request, [
            'tgl_pemasukan' => 'required',
            'jenis_pemasukan' => 'required',
            // 'santri_id' => 'required',
            'jumlah_pemasukan' => 'required',
            'nama_donatur' => 'required',
        ]);

        $storepemasukan = Pemasukan::find($id);
            if ($request->jenis_pemasukan == 'donatur') {
                $storepemasukan->nama_donatur = $request->nama_donatur;
                $storepemasukan->tgl_pemasukan = date('Y-m-d', strtotime($request->tgl_pemasukan));
                $storepemasukan->jumlah_pemasukan = $request->jumlah_pemasukan;
                $storepemasukan->jenis_pemasukan = 'donatur';
            }else if($request->jenis_pemasukan == 'infaq'){
                $storepemasukan->santri_id = $request->santri_id;
                $storepemasukan->tgl_pemasukan = date('Y-m-d', strtotime($request->tgl_pemasukan));
                $storepemasukan->jumlah_pemasukan = $request->jumlah_pemasukan;
                $storepemasukan->jenis_pemasukan = 'infaq';
            }
            // Push to datatabase!


            $periodeDefaultSet = Periode::whereStatus('aktif')->first();
            $start_date = Carbon::parse($periodeDefaultSet['start_date'])->format('Y-m-d');
            $end_date = Carbon::parse($periodeDefaultSet['end_date'])->format('Y-m-d');

            $getTotalUang = DB::table('total_uang')->where('periode', $periodeDefaultSet['nama_periode'])->first();
            $defaultUang = Pemasukan::whereBetween('tgl_pemasukan', [$start_date, $end_date])->sum('jumlah_pemasukan');
            $masukanUang =  $defaultUang + $request->jumlah_pemasukan;
            $updateTotalUang = TotalUang::find($getTotalUang->id);
            $updateTotalUang->total_nominal = $masukanUang;
            $updateTotalUang->update();

            $storepemasukan->save();
        return response()->json(['response' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletepemasukan = Pemasukan::find($id);
        $getDefaultPeriode = Periode::whereStatus('aktif')->first();
        $getTotalUang = TotalUang::where('periode', $getDefaultPeriode['nama_periode'])->value('total_nominal');
        $tambahinUangnya = $getTotalUang - $deletepemasukan['jumlah_pemasukan'];
        $updateTotalUang = TotalUang::wherePeriode($getDefaultPeriode['nama_periode'])->update(['total_nominal' => $tambahinUangnya]);
        $deletepemasukan->delete();

        return response()->json(['response' => 'success']);
    }

    public function laporan(Request $request)
    {
        if ($request->jenis_pemasukan == 'all') {
            $pemasukans = Pemasukan::orderBy('jumlah_pemasukan', 'DESC')->whereIn('jenis_pemasukan', ['infaq', 'donatur'])->whereBetween('tgl_pemasukan', [$request->start_date, $request->end_date])->get();

            $sum_pemasukan = Pemasukan::orderBy('jumlah_pemasukan', 'DESC')->whereIn('jenis_pemasukan', ['infaq', 'donatur'])->whereBetween('tgl_pemasukan', [$request->start_date, $request->end_date])->sum('jumlah_pemasukan');
            $money_convert = "Rp. " . number_format($sum_pemasukan,2,',','.');
        }else{
            $pemasukans = Pemasukan::orderBy('jumlah_pemasukan', 'DESC')->whereJenisPemasukan($request->jenis_pemasukan)->whereBetween('tgl_pemasukan', [$request->start_date, $request->end_date])->get();

            $sum_pemasukan = Pemasukan::orderBy('jumlah_pemasukan', 'DESC')->whereJenisPemasukan($request->jenis_pemasukan)->whereBetween('tgl_pemasukan', [$request->start_date, $request->end_date])->sum('jumlah_pemasukan');
            $money_convert = "Rp. " . number_format($sum_pemasukan,2,',','.');
        }

        return view('keuangan.laporan-pemasukan', compact('pemasukans', 'money_convert'));
    }

    public function laporanSyariah(Request $request)
    {
        $classes = Kelas::all();
        $asrama = Asrama::with('ngaran')->get();
        $syariah = SyariahSantriResource::collection(Santri::orderBy('nama_santri', 'ASC')->whereStatus('aktif')->where('kelas_id', $request->kelas_id)->orWhere('asrama_id', $request->asrama_id)->get());
        // return response()->json($syariah);
        $kelasId = $request->kelas_id == null ? null : $request->kelas_id;
        $asramaId = $request->asrama_id == null ? null : $request->asrama_id;
        $bulan = $request->bulan == null ? '1900-10-10' : $request->bulan;
        return view('keuangan.laporan-syariah', compact('classes', 'asrama', 'syariah', 'kelasId', 'asramaId', 'bulan'));
    }

    public function getSantriForReport(Request $request)
    {
        if ($request->kelas_id == 'all' && $request->asrama_id == 'all') {
            $santris = SyariahSantriResource::collection(Santri::orderBy('nama_santri', 'ASC')->whereStatus('aktif')->get());
        }else{
            $santris = SyariahSantriResource::collection(Santri::orderBy('nama_santri', 'ASC')->whereStatus('aktif')->where('kelas_id', $request->kelas_id)->orWhere('asrama_id', $request->asrama_id)->get());
        }
        return $santris;
    }
}

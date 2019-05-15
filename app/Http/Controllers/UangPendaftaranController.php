<?php

namespace App\Http\Controllers;

use App\UangPendaftaran;
use App\Santri;
use Yajra\Datatables\Datatables;
use App\Notifikasi;
use App\Events\RefreshNotification;
use Illuminate\Http\Request;

class UangPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('keuangan.index-uang-pendaftaran');
    }

    public function studentsDataTables()
    {
        $query_students = Santri::where('status', 'belum_membayar')
                                ->get();

        return Datatables::of($query_students)
                        ->addColumn('action', function($data){
                            return '
                            <a href='. route("keuangan.uang-pendaftaran.edit", $data->id) .' class="btn btn-sm btn-warning">Bayar</a>
                            ';
                        })
                        ->editColumn('created_at', function($data){
                            return $data->created_at->format('d-m-Y');
                        })
                        ->rawColumns(['action'])
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UangPendaftaran  $uangPendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(UangPendaftaran $uangPendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UangPendaftaran  $uangPendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $santri = Santri::findOrFail($id);
        return view('keuangan.edit-uang-pendaftaran', compact('santri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UangPendaftaran  $uangPendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newSantri = Santri::findOrFail($id);
        
        $storeUangPendaftaran = UangPendaftaran::create([
                'santri_id' => $id,
                'nominal' => '100000' // bisa di set di master
            ]);
        if ($storeUangPendaftaran) {
            $updateStatus = Santri::findOrFail($id)
                                ->update(['status' => 'tidak_aktif']);
            if ($updateStatus) {

                // Make a notification to notices the pendidikan.
                Notifikasi::create([
                   'judul' => 'Pendaftaran Santri baru',
                   'pesan' => 'Sekretariat menambahkan santri baru dengan NIS ' . $newSantri->nis . ', segera konfirmasi kelas yg akan ditempatkan',
                   'tipe' => 'sekretariat',
                   'status' => 'unread',
                   'santri_id' => $newSantri->id
                ]);

                event(new RefreshNotification());

                // Fungsi ini akan menggenerate NIS setelah didapatkannya parameters
                $this->generateNis($newSantri->id, $newSantri->nis, $request->provinsi, $request->kabupaten_kota, $request->kecamatan, $request->tgl_masuk);

            }
        }

        return redirect()->route('keuangan.uang-pendaftaran.index')->with('messageSuccess', 'Berhasil di lakukan pembayaran!');
    }


    public function generateNis(int $id, $nis, $provinsi, $kabupaten_kota, $kecamatan, $tgl_masuk)
    {
        $hitung = Santri::whereDate('created_at', Carbon::now()->format('Y-m-d'))
                  ->count();

        $increment = $hitung;
        $generate = $provinsi.substr($kabupaten_kota, -2).substr($kecamatan, -2).date('dmy', strtotime($tgl_masuk)).$increment;

        return Santri::find($id)->update(['nis' => $generate]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UangPendaftaran  $uangPendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(UangPendaftaran $uangPendaftaran)
    {
        //
    }
}

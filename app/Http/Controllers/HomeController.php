<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Santri;
use App\Keamanan;
use App\Pemasukan;
use App\Notifikasi;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $notifikasi;

    public function __construct(Notifikasi $notifikasi)
    {
        $this->middleware('auth');
        $this->notifikasi = $notifikasi;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getTotalSantri = Santri::whereStatus('aktif')->count();
        $getSantriPutra = Santri::whereStatus('aktif')->whereJenisKelamin('L')->count();
        $getSantriPutri = Santri::whereStatus('aktif')->whereJenisKelamin('P')->count();

        $getSantriIbtida = Santri::whereStatus('aktif')->whereHas('tingkat', function($query){
                $query->where('nama_tingkatan', 'Ibtida');
        })->count();

        $getSantriTsanawi = Santri::whereStatus('aktif')->whereHas('tingkat', function($query){
                $query->where('nama_tingkatan', 'Tsanawi');
        })->count();

        $getSantriMahadAly = Santri::whereStatus('aktif')->whereHas('tingkat', function($query){
                $query->where('nama_tingkatan', "Ma'had Aly");
        })->count();

        $keamanans = Keamanan::all();

        $pendapatan = Pemasukan::whereYear('tgl_pemasukan', Carbon::now()->format('Y'))->whereMonth('tgl_pemasukan', Carbon::now()->format('m'));
        $sum = Pemasukan::whereYear('tgl_pemasukan', Carbon::now()->format('Y'))->whereMonth('tgl_pemasukan', Carbon::now()->format('m'))->sum('jumlah_pemasukan');


        return view('home', compact('getTotalSantri', 'getSantriPutra', 'getSantriPutri', 'getSantriIbtida', 'getSantriTsanawi', 'getSantriMahadAly', 'keamanans', 'pendapatan', 'sum'));
    }

    public function sekretariatHome(Request $request)
    {
        return view('home-sekretariat');
    }

    public function pendidikanHome(Request $request)
    {
        return view('home-pendidikan');
    }

    public function keuanganHome(Request $request)
    {
        return view('home-keuangan');
    }

    public function keamananHome(Request $request)
    {
        // Check if entri has category "Dekat"
        $checknotifOnes = Keamanan::whereKategori('dekat')->whereStatus('belum_kembali')->get();

        // Check if entri has category "Jauh"
        $checknotifTwos = Keamanan::whereKategori('jauh')->whereStatus('belum_kembali')->get();

        foreach ($checknotifOnes as $value1) {
            if ($value1->jam_berakhir > Carbon::today()->format('H:i:s')) {

                // Trigger the notification

                // Before triggering the notification system will checking for each record if they're exists or not in our database!

                // if ($this->notifikasi->where('')) {
                //     # code...
                // }

                $reminder = Carbon::now()->addHours(2);

                $checkIfExist = Notifikasi::whereKeamananId($value1->id)->first();

                $notify = $this->notifikasi;

                if (count($checkIfExist) > 0) {

                    if (Carbon::now() > $checkIfExist['reminder']) {

                        $notify->find($checkIfExist['id'])->delete();
                    
                        $notify->create([
                            'judul' => 'Santri ' . $value1->santri['nama_santri'] . ' belum kembali',
                            'pesan' => 'Santri  bernama '. $value1->santri['nama_santri'] .' belum dinyatakan kembali dengan alasan izin ' . $value1->alasan . ', tujuan ' . $value1->tujuan . '. Terakhir izin pada pukul ' . $value1->jam_berakhir . '',
                            'tipe' => 'keamanan',
                            'status' => 'unread',
                            'reminder' => $reminder,
                            'keamanan_id' => $value1->id
                        ]);

                    }

                }else{
                    
                    $notify->create([
                        'judul' => 'Santri ' . $value1->santri['nama_santri'] . ' belum kembali',
                        'pesan' => 'Santri  bernama '. $value1->santri['nama_santri'] .' belum dinyatakan kembali dengan alasan izin ' . $value1->alasan . ', tujuan ' . $value1->tujuan . '. Terakhir izin pada pukul ' . $value1->jam_berakhir . '',
                        'tipe' => 'keamanan',
                        'status' => 'unread',
                        'reminder' => $reminder,
                        'keamanan_id' => $value1->id
                    ]);

                }

            }
        }

        foreach ($checknotifTwos as $value2) {
            if ($value2->tgl_berakhir_izin > Carbon::today()->format('Y-m-d')) {

                // Trigger the notification

                // Before triggering the notification system will checking for each record if they're exists or not in our database!

                // if ($this->notifikasi->where('')) {
                //     # code...
                // }

                $reminder = Carbon::now()->addHours(2);

                $checkIfExist = Notifikasi::whereKeamananId($value2->id)->first();

                $notify = $this->notifikasi;

                if (count($checkIfExist) > 0) {

                    if (Carbon::now() > $checkIfExist['reminder']) {

                        $notify->find($checkIfExist['id'])->delete();

                        $notify->create([
                            'judul' => 'Santri ' . $value2->santri['nama_santri'] . ' belum kembali',
                            'pesan' => 'Santri  bernama '. $value2->santri['nama_santri'] .' belum dinyatakan kembali dengan alasan izin ' . $value2->alasan . ', tujuan ' . $value2->tujuan . '. Terakhir izin pada tanggal ' . $value2->tgl_berakhir_izin . '',
                            'tipe' => 'keamanan',
                            'status' => 'unread',
                            'reminder' => $reminder,
                            'keamanan_id' => $value2->id
                        ]);

                    }

                }else{

                    $notify->create([
                        'judul' => 'Santri ' . $value2->santri['nama_santri'] . ' belum kembali',
                        'pesan' => 'Santri  bernama '. $value2->santri['nama_santri'] .' belum dinyatakan kembali dengan alasan izin ' . $value2->alasan . ', tujuan ' . $value2->tujuan . '. Terakhir izin pada tanggal ' . $value2->tgl_berakhir_izin . '',
                        'tipe' => 'keamanan',
                        'status' => 'unread',
                        'reminder' => $reminder,
                        'keamanan_id' => $value2->id
                    ]);

                }

            }
        }
        return view('home-keamanan');
    }
}

<?php

namespace App\Http\Controllers;

use App\Santri;
use App\Kelas;
use App\Tingkat;
use App\DewanKyai;
use App\Kobong;
use App\Location\Province;
use App\Location\Regency;
use App\Location\District;
use App\Location\Village;
use Illuminate\Http\Request;
use App\DataNamaAsrama;
use App\Asrama;
use Carbon\Carbon;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sekretariat.santri.santri');   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pendaftaran()
    {

        $asramaPutra = Asrama::whereKategoriAsrama('Putra')->get();
        $asramaPutri = Asrama::whereKategoriAsrama('Putri')->get();
        $tingkats = Tingkat::orderBy('nama_tingkatan')->get();
        $dewankyai = DewanKyai::all();
        return view('sekretariat.santri.pendaftaran', compact('asramaPutra', 'asramaPutri', 'tingkats', 'dewankyai'));
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
        // $this->validate($request, [
        //     'nik' => 'required', 
        //     'nama_santri' => 'string|required', 
        //     'tgl_lahir' => 'required|date', 
        //     'jenis_kelamin' => 'required', 
        //     'provinsi' => 'required', 
        //     'kabupaten_kota' => 'required', 
        //     'kecamatan' => 'required', 
        //     'kelurahan' => 'required', 
        //     'alamat' => 'required', 
        //     'kode_pos' => 'required', 
        //     'nama_ortu' => 'required', 
        //     'nama_wali' => 'required', 
        //     'no_telp' => 'required', 
        //     'pendidikan_terakhir' => 'required', 
        //     'asrama_id' => 'required', 
        //     'kobong_id' => 'required', 
        //     'tingkat_id' => 'required', 
        //     'kelas_id' => 'required', 
        //     'tgl_masuk' => 'required|date', 
        //     'himpunan' => 'required', 
        //     'dewan_id' => 'required', 
        //     'pesantren_sebelumnya' => 'required', 
        //     // 'foto'
        // ]);

        $newSantri = new Santri();
        $newSantri->nik = $request->nik;
        $newSantri->nama_santri = $request->nama_santri;
        $newSantri->tgl_lahir = date('Y-m-d',strtotime($request->tgl_lahir));
        $newSantri->jenis_kelamin = $request->jenis_kelamin;
        $newSantri->provinsi = $request->provinsi;
        $newSantri->kabupaten_kota = $request->kabupaten_kota;
        $newSantri->kecamatan = $request->kecamatan;
        $newSantri->kelurahan = $request->kelurahan;
        $newSantri->alamat = $request->alamat;
        $newSantri->kode_pos = $request->kode_pos;
        $newSantri->nama_ortu = $request->nama_ortu;
        $newSantri->nama_wali = $request->nama_wali;
        $newSantri->no_telp = $request->no_telp;
        $newSantri->pendidikan_terakhir = $request->pendidikan_terakhir;
        $newSantri->asrama_id = $request->asrama_id;
        $newSantri->kobong_id = $request->kobong_id;
        $newSantri->tingkat_id = $request->tingkat_id;
        $newSantri->kelas_id = $request->kelas_id;
        $newSantri->tgl_masuk = date('Y-m-d',strtotime($request->tgl_masuk));
        $newSantri->himpunan = $request->himpunan;
        $newSantri->dewan_id = $request->dewan_id;
        $newSantri->pesantren_sebelumnya = $request->pesantren_sebelumnya;
        if ($request->file('foto')) {
            $imageName = time().'_'.$request->nama_santri.'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/storage/santri_pic/'), $imageName);
            $newSantri->foto = $imageName;
        }else{
            $newSantri->foto = null;
        }
        $newSantri->save();

        $getSantri = Santri::find($newSantri->nis);
        $kodeProvinsi = $request->provinsi;
        $kodeKabupatenKota = $request->kabupaten_kota;
        $kodeKecamatan = $request->kecamatan;
        $kodeKelurahan = $request->kelurahan;
        $getSantri->nis = $kodeProvinsi.substr($kodeKabupatenKota, -2).substr($kodeKecamatan, -2).date('dmy', strtotime($request->tgl_masuk));
        $getSantri->provinsi = Province::whereId($kodeProvinsi)->value('name');
        $getSantri->kabupaten_kota = Regency::find($kodeKabupatenKota)->value('name');
        $getSantri->kecamatan = District::find($kodeKecamatan)->value('name');
        $getSantri->kelurahan = Village::find($kodeKelurahan)->value('name');
        $getSantri->update();


        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function show(Santri $santri)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function edit(Santri $santri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Santri $santri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Santri $santri)
    {
        //
    }
}

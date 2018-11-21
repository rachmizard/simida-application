<?php

namespace App\Http\Controllers;

use App\Santri;
use App\Location\Province;
use App\Location\Regency;
use App\Location\District;
use Illuminate\Http\Request;
use App\DataNamaAsrama;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sekretariat.santri.santri', 'asramaPutra');   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pendaftaran()
    {

        $asramaPutra = DataNamaAsrama::whereKategori('Putra')->get();
        $asramaPutri = DataNamaAsrama::whereKategori('Putri')->get();
        return view('sekretariat.santri.pendaftaran', compact('asramaPutra', 'asramaPutri'));
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
        $this->validate($request, [
            'nik' => 'required', 
            'nama_santri' => 'string|required', 
            'tgl_lahir' => 'required|date', 
            'jenis_kelamin' => 'required', 
            'provinsi' => 'required', 
            'kabupaten_kota' => 'required', 
            'kecamatan' => 'required', 
            'kelurahan' => 'required', 
            'alamat' => 'required', 
            'kode_pos' => 'required', 
            'nama_ortu' => 'required', 
            'nama_wali' => 'required', 
            'no_telp' => 'required', 
            'pendidikan_terakhir' => 'required', 
            'asrama_id' => 'required', 
            'kobong_id' => 'required', 
            'tingkat_id' => 'required', 
            'kelas_id' => 'required', 
            'tgl_masuk' => 'required|date', 
            'himpunan' => 'required', 
            'dewan_id' => 'required', 
            'pesantren_sebelumnya' => 'required', 
            // 'foto'
        ]);

        $newSantri = Santri::create($request->all());

        $getSantri = Santri::find($newSantri->nis);
        $kodeProvinsi = $request->provinsi;
        $kodeKabupatenKota = $request->kabupaten_kota;
        $kodeKecamatan = $request->kecamatan;
        $kodeKelurahan = $request->kelurahan;
        $getSantri->nis = $kodeProvinsi.substr($kodeKabupatenKota, -2).substr($kodeKecamatan, -2).Carbon::parse()->format('dmY');
        $getSantri->provinsi = Province::whereId($kodeProvinsi)->value('id');
        $getSantri->kabupaten_kota = Regency::whereId($kodeKabupatenKota)->value('id');
        $getSantri->kecamatan = District::whereId($kodeKecamatan)->value('id');
        $getSantri->kelurahan = Village::whereId($kodeKelurahan)->value('id');
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

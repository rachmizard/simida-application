<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/penempatankelas/storePenempatanKelas', 'PenempatanKelasController@storePenempatanKelas');

Route::post('/store/entri/izin', 'KeamananController@store');

Route::post('/pemasukan/storeSyariah', 'PemasukanController@storeSyariah');

Route::post('/pengeluaran/store', 'PengeluaranController@store');

Route::post('/pengeluaran/jenispengeluaran/store', 'PengeluaranController@storeJenisPengeluaran');

Route::post('/pemasukan/store', 'PemasukanController@store')->name('pemasukan.store');

Route::post('/jadwalpelajaran/store', 'JadwalPelajaranController@store')->name('jadwalpelajaran.store');

Route::post('/absen/store', 'AbsenController@store')->name('absen.store');

Route::post('/mutasi/{id}/mutasi', 'MutasiController@update')->name('mutasi.update');

Route::post('/pendaftaran/store', function(Request $request){
    $this->validate($request, [
            'nik' => 'required', 
            'nama_santri' => 'string|required', 
            'tgl_lahir' => 'required', 
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
            'tgl_masuk' => 'required', 
            'himpunan' => 'required', 
            'dewan_id' => 'required', 
            'pesantren_sebelumnya' => 'required', 
            // 'foto'
        ]);

        $newSantri = new App\Santri();
        $newSantri->nis = $request->provinsi.substr($request->kabupaten_kota, -2).substr($request->kecamatan, -2).date('dmy', strtotime($request->tgl_masuk));
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
        $newSantri->tgl_masuk = Carbon\Carbon::parse($request->tgl_masuk)->format('Y-m-d');
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

        // $getSantri = Santri::find($newSantri->id);
        // $getSantri->provinsi = Province::whereId($request->provinsi)->value('name');
        // $getSantri->kabupaten_kota = Regency::whereId($request->kabupaten_kota)->value('name');
        // $getSantri->kecamatan = District::whereId($request->kecamatan)->value('name');
        // $getSantri->update();


        return response()->json(['message' => 'success']);
})->name('store');


Route::post('/asrama/store', 'AsramaController@store')->name('asrama.store');

Route::post('/dewankyai/{id}/update', 'DewanKyaiController@update')->name('dewankyai.update');

Route::post('/dewankyai/store', 'DewanKyaiController@store')->name('dewankyai.store');

Route::get('file_exists', function(){
    if (file_exists(public_path('storage/dewan_pic/1543310566.jpg'))) {
        unlink(public_path('storage/dewan_pic/Capture.png'));
        dd('File is exists.');
    }else{
        dd('File is not exists.');
    }
});

Route::post('debug', function(Request $request){
				$newKelas = new App\Kelas();   
                $newKelas->nama_kelas = $request->tingkat.$request->lokal.' '.$request->tingkat_id. ' '.$request->jk;
                
                // INSERT
                $newKelas->tingkat = $request->tingkat;
                $newKelas->lokal = $request->lokal;
                $newKelas->tingkat_id = $request->tingkat_id;
                $newKelas->jk = $request->jk;
                $newKelas->guru_id = $request->guru_id;
                $newKelas->badal_id = $request->badal_id;
                $newKelas->save();

                // UPDATE
                $updateKelas = App\Kelas::find($newKelas->id);
                $updateKelas->nama_kelas = $request->tingkat.$request->lokal.' '.$newKelas['tingkatKelas']['nama_tingkatan']. ' '.$request->jk;

                return response()->json($updateKelas);
});
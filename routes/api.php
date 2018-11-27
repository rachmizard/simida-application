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

Route::post('/asrama/store', 'AsramaController@store')->name('asrama.store');

Route::put('/dewankyai/{id}/update', 'DewanKyaiController@update')->name('dewankyai.update');

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
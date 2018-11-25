<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('event', function(){
	event(new App\Events\DrawTable());
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home')->middleware('is_murobbi');

Route::middleware(['auth', 'is_murobbi'])->group(function(){
	Route::prefix('admin')->group(function(){
		Route::name('admin.')->group(function(){
			Route::get('/home', 'HomeController@index')->name('home');
		});
	});
});

Route::middleware(['auth', 'is_sekretariat'])->group(function(){
	Route::prefix('sekretariat')->group(function(){
		Route::name('sekretariat.')->group(function(){
			Route::get('/home', 'HomeController@sekretariatHome')->name('home');
			// Pendaftaran
				// Get Location API
					Route::get('provinces', 'Location\LocationController@province')->name('province');
					Route::get('province/regencies/{provinceId}', 'Location\LocationController@regency')->name('regency');
					Route::get('province/regency/districts/{regencyId}', 'Location\LocationController@district')->name('district');
					Route::get('province/regency/district/villages/{districtId}', 'Location\LocationController@village')->name('village');
				// End Get Location API
			Route::get('/pendaftaran', 'SantriController@pendaftaran')->name('pendaftaran');
			Route::post('/pendaftaran/store', 'SantriController@store')->name('store');
			// End Pendaftaran

			// Santri
			Route::get('/santri', 'SantriController@index')->name('santri');
			// End Santri

			// Kelas
			Route::get('/kelas', 'KelasController@index')->name('kelas');
			Route::get('/kelas/getKelasDatatables', 'KelasController@getKelasDatatables')->name('kelas.getKelasDatatables');
			Route::get('/kelas/JSON', 'KelasController@getKelasJSON')->name('kelas.getKelasJSON');
			Route::post('/kelas/store', 'KelasController@store')->name('kelas.store');
			Route::get('/kelas/{id}/show', 'KelasController@show')->name('kelas.show');
			Route::put('/kelas/{id}/update', 'KelasController@update')->name('kelas.update');
			Route::get('/kelas/tambah', 'KelasController@create')->name('kelas.tambah_kelas');
			Route::get('/kelas/tambah', 'KelasController@create')->name('kelas.tambah_kelas');
			Route::delete('/kelas/{id}/destroy', 'KelasController@destroy')->name('kelas.destroy');
			// End Kelas

			// Tingkatan
			Route::get('/tingkatan/getJSON', 'TingkatController@getJSON')->name('tingkat.getJSON');
			Route::post('/tingkatan/store', 'TingkatController@store')->name('tingkat.store');
			// End TIngkatan

			// Asrama
			Route::get('/asrama', 'AsramaController@index')->name('asrama');
			Route::get('/asrama/tambah', 'AsramaController@create')->name('asrama.create');
			Route::get('/asrama/getAsramaDataTables', 'AsramaController@getAsramaDataTables')->name('asrama.getAsramaDataTables');
			Route::get('/asrama/getAsrama/{kategori}', 'AsramaController@getAsramaKategori')->name('asrama.getAsramaKategori');
			Route::get('/asrama/get/allKategori', 'AsramaController@getAsramaAllKategori')->name('asrama.getAsramaAllKategori');
			Route::get('/asrama/get/putra', 'AsramaController@getAsramaPutra')->name('asrama.getAsramaPutra');
			Route::get('/asrama/get/putri', 'AsramaController@getAsramaPutri')->name('asrama.getAsramaPutri');
			Route::post('/asrama/storeNamaAsrama', 'AsramaController@storeNamaAsrama')->name('asrama.storeNamaAsrama');
			Route::post('/asrama/store', 'AsramaController@store')->name('asrama.store');
			Route::get('/asrama/{id}/show', 'AsramaController@show')->name('asrama.show');
			Route::get('/asrama/{id}/kobong', 'AsramaController@kobong')->name('asrama.kobong');
			Route::get('/asrama/{id}/kobongJSON', 'AsramaController@kobongJSON')->name('asrama.kobongJSON');
			Route::put('/asrama/{id}/update', 'AsramaController@update')->name('asrama.update');
			Route::post('/asrama/{id}/destroy', 'AsramaController@destroy')->name('asrama.destroy');
			// End Asrama

			// KOBONG
			// Route::get('/kobong/', 'KobongController@index')->name('kobong');
			// Route::get('/kobong/getKobongDataTables', 'KobongController@getKobongDataTables')->name('kobong.getKobongDataTables');
			Route::get('/kobong/getJSON', 'KobongController@getJSON')->name('kobong.getJSON');
			Route::post('/kobong/storeJSON', 'KobongController@storeJSON')->name('kobong.storeJSON');
			Route::post('/kobong/{id}/storeByAsramaId', 'KobongController@storeByAsramaId')->name('kobong.storeByAsramaId');
			Route::get('/kobong/{id}/show', 'KobongController@show')->name('kobong.show');
			Route::get('/kobong/{id}/showJSON', 'KobongController@showJSON')->name('kobong.showJSON');
			Route::put('/kobong/{id}/update', 'KobongController@update')->name('kobong.update');
			Route::post('/kobong/{id}/destroy', 'KobongController@destroy')->name('kobong.destroy');
			// END KOBONG

			// GURU
			Route::get('/guru', 'GuruController@index')->name('guru');
			Route::get('/guru/getGuruDataTables', 'GuruController@getGuruDataTables')->name('guru.getGuruDataTables');
			Route::get('/guru/tambah', 'GuruController@create')->name('guru.create');
			Route::get('/guru/getGuruDataTables', 'GuruController@getGuruDataTables')->name('guru.getGuruDataTables');
			Route::get('/guru/{id}/show', 'GuruController@show')->name('guru.show');
			Route::post('/guru/store', 'GuruController@store')->name('guru.store');
			Route::put('/guru/{id}/update', 'GuruController@update')->name('guru.update');
			Route::delete('/guru/{id}/destroy', 'GuruController@destroy')->name('guru.destroy');

			// END GURU
		});
	});
});

Route::middleware(['auth', 'is_pendidikan'])->group(function(){
	Route::prefix('pendidikan')->group(function(){
		Route::name('pendidikan.')->group(function(){
			Route::get('/home', 'HomeController@pendidikanHome')->name('home');
		});
	});
});
Route::middleware(['auth', 'is_keuangan'])->group(function(){
	Route::prefix('keuangan')->group(function(){
		Route::name('keuangan.')->group(function(){
			Route::get('/home', 'HomeController@keuanganHome')->name('home');
		});
	});
});

Route::middleware(['auth', 'is_keamanan'])->group(function(){
	Route::prefix('keamanan')->group(function(){
		Route::name('keamanan.')->group(function(){
			Route::get('/home', 'HomeController@keamananHome')->name('home');
		});
	});
});

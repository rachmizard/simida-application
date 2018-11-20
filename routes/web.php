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
			// End Pendaftaran
			// Santri
			Route::get('/santri', 'SantriController@index')->name('santri');
			// End Santri
			// Kelas
			Route::get('/kelas', 'KelasController@index')->name('kelas');
			// End Kelas
			Route::get('/kelas/tambah', 'KelasController@tambah_kelas')->name('tambah_kelas');
			Route::get('/asrama', 'AsramaController@index')->name('asrama');
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

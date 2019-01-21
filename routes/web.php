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
			Route::get('/user_management', 'UserLevelController@index')->name('userManagement');
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
			Route::post('/santri/getSantriDataTables', 'SantriController@getSantriDataTables')->name('santri.getSantriDataTables');
			Route::post('/santri/getSantriAktifDataTables', 'SantriController@getSantriAktifDataTables')->name('santri.getSantriAktifDataTables');
			Route::get('/santri/santri_aktif', 'SantriController@santri_aktif')->name('santri.santri_aktif');
			Route::get('/santri/getSantriJSON', 'SantriController@getSantriJSON')->name('santri.getSantriJSON');
			Route::get('/santri/{id_kelas}/kelas', 'SantriController@showByClass')->name('santri.showByClass');
			Route::get('/santri/{id}/show', 'SantriController@show')->name('santri.show');
			Route::get('/santri/{id}/edit', 'SantriController@edit')->name('santri.edit');
			Route::post('/santri/{id}/update', 'SantriController@update')->name('santri.update');
			Route::delete('/santri/{id}/destroy', 'SantriController@destroy')->name('santri.destroy');

				// Export Report Santri
					Route::post('/santri/export', 'SantriController@export')->name('export');
				// End Export Report Santri
			// End Santri

			// Kelas
			Route::get('/kelas', 'KelasController@index')->name('kelas');
			Route::get('/kelas/getKelasDatatables', 'KelasController@getKelasDatatables')->name('kelas.getKelasDatatables');
			Route::get('/kelas/JSON', 'KelasController@getKelasJSON')->name('kelas.getKelasJSON');
			Route::get('/kelas/KelasSelect2', 'KelasController@KelasSelect2')->name('kelas.KelasSelect2');
			Route::post('/kelas/store', 'KelasController@store')->name('kelas.store');
			Route::get('/kelas/{id}/show', 'KelasController@show')->name('kelas.show');
			Route::get('/kelas/{id}/tingkat', 'KelasController@showByTingkat')->name('tingkat.showByTingkat');
			Route::put('/kelas/{id}/update', 'KelasController@update')->name('kelas.update');
			Route::get('/kelas/tambah', 'KelasController@create')->name('kelas.tambah_kelas');
			Route::get('/kelas/tambah', 'KelasController@create')->name('kelas.tambah_kelas');
			Route::delete('/kelas/{id}/destroy', 'KelasController@destroy')->name('kelas.destroy');
			// End Kelas

			// Tingkatan
			Route::get('/tingkatan/getJSON', 'TingkatController@getJSON')->name('tingkat.getJSON');
			Route::get('/tingkatan/TingkatanSelect2', 'TingkatController@TingkatanSelect2')->name('tingkat.TingkatanSelect2');
			Route::post('/tingkatan/store', 'TingkatController@store')->name('tingkat.store');
			// End TIngkatan

			// Asrama
			Route::get('/asrama', 'AsramaController@index')->name('asrama');
			Route::get('/asrama/tambah', 'AsramaController@create')->name('asrama.create');
			Route::get('/asrama/getAsramaDataTables', 'AsramaController@getAsramaDataTables')->name('asrama.getAsramaDataTables');
			Route::get('/asrama/getAsrama/{kategori}', 'AsramaController@getAsramaKategori')->name('asrama.getAsramaKategori');
			Route::get('/asrama/get/allKategori', 'AsramaController@getAsramaAllKategori')->name('asrama.getAsramaAllKategori');
			Route::get('/asrama/AsramaSelect2', 'AsramaController@AsramaSelect2')->name('asrama.AsramaSelect2');
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
			Route::get('/guru/getJSON', 'GuruController@getJSON')->name('guru.getJSON');
			Route::get('/guru/GuruSelect2', 'GuruController@GuruSelect2')->name('guru.GuruSelect2');
			Route::get('/guru/tambah', 'GuruController@create')->name('guru.create');
			Route::get('/guru/{id}/show', 'GuruController@show')->name('guru.show');
			Route::post('/guru/store', 'GuruController@store')->name('guru.store');
			Route::put('/guru/{id}/update', 'GuruController@update')->name('guru.update');
			Route::delete('/guru/{id}/destroy', 'GuruController@destroy')->name('guru.destroy');

				// GURU EXPORT
					Route::post('/guru/export', 'GuruController@export')->name('guru.export');
				// END GURU
			// END GURU

			// DEWAN KYAI
			Route::get('/dewankyai', 'DewanKyaiController@index')->name('dewankyai');
			Route::get('/dewankyai/getDewanKyaiDataTables', 'DewanKyaiController@getDewanKyaiDataTables')->name('dewankyai.getDewanKyaiDataTables');
			Route::get('/dewankyai/getDewanKyaiJSON', 'DewanKyaiController@getDewanKyaiJSON')->name('dewankyai.getDewanKyaiJSON');
			Route::post('/dewankyai/{id}/aktif', 'DewanKyaiController@active')->name('dewankyai.active');
			Route::get('/dewankyai/tambah', 'DewanKyaiController@create')->name('dewankyai.create');
			Route::get('/dewankyai/{id}/show', 'DewanKyaiController@show')->name('dewankyai.show');
			Route::post('/dewankyai/store', 'DewanKyaiController@store')->name('dewankyai.store');
			Route::post('/dewankyai/{id}/update', 'DewanKyaiController@update')->name('dewankyai.update');
			Route::delete('/dewankyai/{id}/destroy', 'DewanKyaiController@destroy')->name('dewankyai.destroy');
			// END DEWAN KYAI

			// MUTASI ASRAMA / KOBONG
			Route::get('/mutasi', 'MutasiController@index')->name('mutasi');
			Route::get('/mutasi/getSantriDataTables', 'MutasiController@getSantriDataTables')->name('mutasi.getSantriDataTables');
			Route::post('/mutasi/{id}/mutasi', 'MutasiController@update')->name('mutasi.update');
			// END MUTASI ASRAMA / KOBONG
		});
	});
});

Route::middleware(['auth', 'is_pendidikan'])->group(function(){
	Route::prefix('pendidikan')->group(function(){
		Route::name('pendidikan.')->group(function(){
			Route::get('/home', 'HomeController@pendidikanHome')->name('home');
			// Master Periode
			Route::get('/periode', 'PeriodeController@index')->name('periode');
			Route::get('/getPeriodeForSelect2', 'PeriodeController@getPeriodeForSelect2')->name('periode.getPeriodeForSelect2');
			Route::get('/periode/getPeriodeDataTables', 'PeriodeController@getPeriodeDataTables')->name('periode.getPeriodeDataTables');
			Route::put('/periode/{id}/aktif', 'PeriodeController@aktif')->name('periode.aktif');
			Route::get('/periode/{id}/show', 'PeriodeController@show')->name('periode.show');
			Route::get('/periode/isactived', 'PeriodeController@isactived')->name('periode.isactived');
			Route::post('/periode/store', 'PeriodeController@store')->name('periode.store');
			Route::put('/periode/{id}/update', 'PeriodeController@update')->name('periode.update');
			Route::delete('/periode/{id}/delete', 'PeriodeController@destroy')->name('periode.destroy');
			// End Master Periode

			// Master Mata Pelajaran
			Route::get('/matapelajaran', 'MataPelajaranController@index')->name('matapelajaran');
			Route::get('/matapelajaran/getMataPelajaranDataTables', 'MataPelajaranController@getMataPelajaranDataTables')->name('matapelajaran.getMataPelajaranDataTables');
			Route::get('/matapelajaran/JSON', 'MataPelajaranController@JSON')->name('matapelajaran.JSON');
			Route::get('/matapelajaran/	', 'MataPelajaranController@MataPelajaranSelect2')->name('matapelajaran.MataPelajaranSelect2');
			Route::post('/matapelajaran/store', 'MataPelajaranController@store')->name('matapelajaran.store');
			Route::get('/matapelajaran/{id}/show', 'MataPelajaranController@show')->name('matapelajaran.show');
			Route::put('/matapelajaran/{id}/update', 'MataPelajaranController@update')->name('matapelajaran.update');
			Route::delete('/matapelajaran/{id}/destroy', 'MataPelajaranController@destroy')->name('matapelajaran.destroy');

			Route::get('/matapelajaran/{id}/tingkat', 'MataPelajaranController@showMapelByTingkat')->name('matapelajaran.showMapelByTingkat');

				// Export Mata Pelajaran
					Route::get('/matapelajaran/export', 'MataPelajaranController@export')->name('matapelajaran.export');
				// End Export Mata Pelajaran
			// End Master Mata Pelajaran


			// Master Kegiatan
			Route::get('/kegiatan', 'KegiatanController@index')->name('kegiatan');
			Route::get('/kegiatan/getKegiatanDataTables', 'KegiatanController@getKegiatanDataTables')->name('kegiatan.getKegiatanDataTables');
			Route::get('/kegiatan/JSON', 'KegiatanController@JSON')->name('kegiatan.JSON');
			Route::post('/kegiatan/store', 'KegiatanController@store')->name('kegiatan.store');
			Route::get('/kegiatan/{id}/show', 'KegiatanController@show')->name('kegiatan.show');
			Route::put('/kegiatan/{id}/update', 'KegiatanController@update')->name('kegiatan.update');
			Route::delete('/kegiatan/{id}/destroy', 'KegiatanController@destroy')->name('kegiatan.destroy');
			Route::get('/kegiatan/export', 'KegiatanController@export')->name('kegiatan.export');
			// End Master Mata Pelajaran

			// Penempatan Kelas & Tingkat
			Route::get('/penempatankelas', 'PenempatanKelasController@penempatankelas')->name('penempatankelas');
			Route::get('/penempatankelas/listSantri', 'PenempatanKelasController@listSantri');
			Route::post('/penempatankelas/storePenempatanKelas', 'PenempatanKelasController@storePenempatanKelas');
			Route::post('/penempatankelas/{id}/oneByOne', 'PenempatanKelasController@oneByOne');
			// End Penempatan Kelas & Tingkat

			// Kelas In Pendidikan
			Route::get('/KelasSelect2', 'KelasController@KelasSelect2')->name('kelas.KelasSelect2');

			// Tingkat In Pendidikan
			Route::get('/TingkatanSelect2', 'TingkatController@TingkatanSelect2')->name('tingkat.TingkatanSelect2');

			// Absen
			Route::get('/absen', 'AbsenController@index')->name('absen');
			Route::get('/absen/reportview', 'AbsenController@reportView')->name('absen.reportview');
			Route::get('/absen/getSantriDataTables', 'AbsenController@getSantriDataTables')->name('absen.getSantriDataTables');
			Route::post('/absen/store', 'AbsenController@store')->name('absen.store');
			Route::delete('/absen/{id}/destroy', 'AbsenController@destroy')->name('absen.destroy');

				// Report Absensi
				Route::get('/absen/report', 'AbsenController@report')->name('absen.report'); // API
				Route::get('/absen/santri', 'AbsenController@santri')->name('absen.santri'); // API
				Route::get('/absen/listKegiatan', 'AbsenController@listKegiatan')->name('absen.listKegiatan'); // API
				// End Report Absensi
			// End Absen

			// Semester

			Route::get('/semester', 'SemesterController@index')->name('semester.index');
			Route::get('/semester/getSemesterDataTables', 'SemesterController@getSemesterDataTables')->name('semester.getSemesterDataTables');
			Route::get('/semester/{id}/show', 'SemesterController@show')->name('semester.show');
			Route::post('/semester/store', 'SemesterController@store')->name('semester.store');
			Route::put('/semester/{id}/update', 'SemesterController@update')->name('semester.update');
			Route::delete('/semester/{id}/destroy', 'SemesterController@destroy')->name('semester.destroy');
			Route::put('/semester/{id}/statusActive', 'SemesterController@statusActive')->name('semester.statusActive');
			Route::get('/semester/semesterSelect2', 'SemesterController@semesterSelect2')->name('semester.select2');

			// End Semester

			// Jadwal Pelajaran
			Route::get('/jadwalpelajaran', 'JadwalPelajaranController@index')->name('jadwalpelajaran');
			Route::post('/jadwalpelajaran/getJadwal', 'JadwalPelajaranController@getJadwal')->name('jadwalpelajaran.getJadwal');
			Route::post('/jadwalpelajaran/store', 'JadwalPelajaranController@store')->name('jadwalpelajaran.store');
			Route::get('/jadwalpelajaran/{id}/show', 'JadwalPelajaranController@show')->name('jadwalpelajaran.show');
			Route::put('/jadwalpelajaran/{id}/update', 'JadwalPelajaranController@update')->name('jadwalpelajaran.update');
			Route::delete('/jadwalpelajaran/{id}/destroy', 'JadwalPelajaranController@destroy')->name('jadwalpelajaran.destroy');
			// End Jadwal Pelajaran

			// Predikat
			Route::get('/predikat', 'PredikatController@index')->name('predikat.index');
			Route::get('/predikat/{id}/show', 'PredikatController@show');
			Route::post('/predikat/store', 'PredikatController@store');
			Route::put('/predikat/{id}/update', 'PredikatController@update');
			Route::delete('/predikat/{id}/destroy', 'PredikatController@destroy');
			Route::get('/getPredikatAll', 'PredikatController@getPredikatAll');
			// End Predikat

			// Nilai & Rekap Nilai

			Route::get('/nilai', 'NilaiController@index')->name('nilai.index');
			Route::get('/nilai/getSantri', 'NilaiController@getSantri');

			// End Nilai & Rekap Nilai

			// Kelas by tingkat di dalam pendidikan
			Route::get('/kelas/{id}/tingkat', 'NilaiController@showClassByTingkat');

			// Santri detail di dalam pendidikan
			Route::get('/santri/{id}/show', 'SantriController@show');

		});
	});
});
Route::middleware(['auth', 'is_keuangan'])->group(function(){
	Route::prefix('keuangan')->group(function(){
		Route::name('keuangan.')->group(function(){

			// No Access Page
			Route::get('/blocked-access', 'KeuanganController@blockedAccess')->name('blocked-access')->middleware('is_keuangan');
			// End No Access Page

			// Get Kelas
			Route::get('/kelas/JSON', 'KelasController@getKelasJSON')->name('kelas.getKelasJSON');
			// End Get Kelas

			// Get Asrama
			Route::get('/asrama/AsramaSelect2', 'AsramaController@AsramaSelect2')->name('asrama.AsramaSelect2');
			// End Get Asrama

			// Pemasukan
			Route::get('/', 'KeuanganController@index')->name('home');
			Route::get('/cashNow', 'KeuanganController@cashNow');
			Route::get('/pemasukan/getPemasukanDataTables', 'PemasukanController@getPemasukanDataTables');
			Route::get('/pemasukan', 'PemasukanController@index')->name('pemasukan.home');
			Route::get('/pemasukan/totalPemasukan', 'PemasukanController@totalPemasukan')->name('pemasukan.totalPemasukan');
			Route::get('/pemasukan/sekilasKeuangan', 'PemasukanController@sekilasKeuangan')->name('pemasukan.sekilasKeuangan');
			Route::post('/pemasukan/store', 'PemasukanController@store')->name('pemasukan.store');
			Route::post('/pemasukan/storeSyariah', 'PemasukanController@storeSyariah')->name('pemasukan.storeSyariah');
			Route::get('/pemasukan/{id}/show', 'PemasukanController@show')->name('pemasukan.show');
			Route::put('/pemasukan/{id}/update', 'PemasukanController@update')->name('pemasukan.update');
			Route::delete('/pemasukan/{id}/destroy', 'PemasukanController@destroy')->name('pemasukan.destroy');
			Route::get('/pemasukan/laporan', 'PemasukanController@laporan')->name('pemasukan.laporan')->middleware('is_murobbi');
			// End Pemasukan

			// Pengeluaran
			Route::post('/pengeluaran/store', 'PengeluaranController@store');
			Route::get('/pengeluaran/getPengeluaranDataTables', 'PengeluaranController@getPengeluaranDataTables');
			Route::get('/pengeluaran/getNamaJenisPengeluaran', 'PengeluaranController@getNamaJenisPengeluaran');
			Route::get('/pengeluaran/totalpengeluaran', 'PengeluaranController@totalpengeluaran')->name('pengeluaran.totalpengeluaran');
			Route::get('/pengeluaran/sekliaspengeluaran', 'PengeluaranController@sekliaspengeluaran')->name('pengeluaran.sekliaspengeluaran');
			Route::post('/pengeluaran/jenispengeluaran/post', 'PengeluaranController@post');
			Route::get('/pengeluaran/jenispengeluaran/{id}/showJenisPengeluaran', 'PengeluaranController@showJenisPengeluaran');
			Route::put('/pengeluaran/jenispengeluaran/{id}/updateJenisPengeluaran', 'PengeluaranController@updateJenisPengeluaran');
			Route::delete('/pengeluaran/jenispengeluaran/{id}/destroy', 'PengeluaranController@jenispengeluaranDestroy');
			Route::put('/pengeluaran/{id}/update', 'PengeluaranController@update');
			Route::delete('/pengeluaran/{id}/destroy', 'PengeluaranController@destroy');
			Route::get('/pengeluaran/laporan', 'PengeluaranController@laporan')->name('pengeluaran.laporan')->middleware('is_murobbi');
			// End Pengeluaran

			// Syariah
			Route::get('/syariah/getSantriForSyariah', 'PemasukanController@getSantriForSyariah'); // API
			Route::get('/syariah/getSantriForReport', 'PemasukanController@getSantriForReport'); // API
			Route::get('/syariah/{id}/getOnceSantri', 'PemasukanController@getOnceSantri'); // API
			Route::get('/syariah/checkingofpaid', 'PemasukanController@checkingofpaid'); // API
			Route::get('/syariah/{id}/riwayatPembayaranPerSantri', 'PemasukanController@riwayatPembayaranPerSantri'); // API
			Route::get('/syariah/parseBulan', 'PemasukanController@parseBulan'); // API
			Route::get('/syariah/laporan', 'PemasukanController@laporanSyariah')->name('pemasukan.laporan-syariah'); 
			// End Syariah
		});
	});
});

Route::middleware(['auth', 'is_keamanan'])->group(function(){
	Route::prefix('keamanan')->group(function(){
		Route::name('keamanan.')->group(function(){
			Route::get('/', 'HomeController@keamananHome')->name('home');
			Route::get('/listSantriIzin', 'KeamananController@listSantriIzin');
			Route::get('/listSantriIzinWithFilter', 'KeamananController@listSantriIzinWithFilter');
			Route::get('/getListSantriIzinDataTables', 'KeamananController@getListSantriIzinDataTables');
			Route::get('/getListKeamanan', 'KeamananController@getListKeamanan');
			Route::get('{id}/getSantri', 'KeamananController@getSantri');
			Route::get('{id}/historyByKeamananId', 'KeamananController@historyByKeamananId');

			// CRUD KEAMANAN
			Route::post('/store/entri/izin', 'KeamananController@store');
			Route::get('{id}/show', 'KeamananController@show');
			Route::post('{id}/update', 'KeamananController@update');
			Route::delete('{id}/destroy', 'KeamananController@destroy');
			// END CRUD KEAMANAN

			// UPDATE STATUS
			Route::put('{id}/update/status', 'KeamananController@ceklisSantriKembali');
			// END UPDATE STATUS

			// NOTIFIKASI KEAMANAN
			Route::get('getPemberitahuanWhereIsUnRead', 'KeamananController@getPemberitahuanWhereIsUnRead');
			Route::get('getPemberitahuan', 'KeamananController@getPemberitahuan');
			Route::get('countingNotifications', 'KeamananController@countingNotifications');
			Route::post('/notifikasi/{id}/markAsRead', 'KeamananController@markAsRead');
			// END NOTIFIKASI KEAMANAN

			// CRUD MASTER LIMIT IZIN
			Route::post('/store', 'MasterLimitIzinController@store');
			Route::get('masterlimitizin/{id}/show', 'MasterLimitIzinController@show');
			Route::put('masterlimitizin/{id}/update', 'MasterLimitIzinController@update');
			Route::put('masterlimitizin/{id}/setAktif', 'MasterLimitIzinController@setAktif');
			Route::delete('masterlimitizin/{id}/destroy', 'MasterLimitIzinController@destroy');
			// END CRUD MASTER LIMIT IZIN
		});
	});
});

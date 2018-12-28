
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.moment = require('moment');
window.moment.locale('id');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('example-component', require('./components/ExampleComponent.vue'));

// ASRAMA
Vue.component('form-asrama-component', require('./components/Sekretariat/Asrama/FormAsramaComponent.vue'));
Vue.component('list-asrama-component', require('./components/Sekretariat/Asrama/ListAsramaComponent.vue'));
Vue.component('list-kobong-asrama-component', require('./components/Sekretariat/Asrama/ListAsramaKobongComponent.vue'));

// KELAS
Vue.component('form-kelas-component', require('./components/Sekretariat/Kelas/FormKelasComponent.vue'));
Vue.component('list-kelas-component', require('./components/Sekretariat/Kelas/ListKelasComponent.vue'))

// GURU
Vue.component('form-guru-component', require('./components/Sekretariat/Guru/FormGuruComponent.vue'));
Vue.component('list-guru-component', require('./components/Sekretariat/Guru/ListGuruComponent.vue'));

// LIST NOTIFIKASI IN KEAMANAN
Vue.component('list-notifikasi', require('./components/Keamanan/ListNotifikasiKeamananComponent.vue'));
Vue.component('notifikasi-keamanan', require('./components/Keamanan/NotifikasiKeamananComponent.vue'));

// SYARIAH LAPORAN
Vue.component('list-laporan-syariah', require('./components/Keuangan/Syariah/ListLaporanSyariahComponent.vue'));




/**
* Vue Router
*
* @link http://router.vuejs.org/en/installation.html
*/

 // Including Plugin

import Vue from 'vue';
import VueGoodWizard from 'vue-good-wizard';
Vue.use(VueGoodWizard);

// End Including Plugin

import VueRouter from 'vue-router';
Vue.use(VueRouter);
// define routes for users
const routes = [

		// SANTRI
		{
		  path: '/pendaftaran',
		  name: 'pendaftaran',
		  component: require('./components/Sekretariat/Santri/PendaftaranFormComponent.vue')
		},
		// END SANTRI


		// SANTRI
		{
		  path: '/santriaktif',
		  name: 'santriAktif',
		  component: require('./components/Sekretariat/Santri/ListSantriAktifComponent.vue')
		},
		// END SANTRI

		// KELAS
		{
		  path: '/list_kelas',
		  name: 'listKelas',
		  component: require('./components/Sekretariat/Kelas/ListKelasComponent.vue')
		},

		{
		  path: '/kelas/list_santri/:id',
		  name: 'kelasListSantri',
		  component: require('./components/Sekretariat/Kelas/ListSantriKelasComponent.vue')
		},

		{
		  path: '/kelas/hapus/:id',
		  name: 'hapusKelas',
		  component: require('./components/Sekretariat/Kelas/DeleteKelasComponent.vue')
		},

		// GURU
		{
		  path: '/edit/guru/:id',
		  name: 'editGuruForm',
		  component: require('./components/Sekretariat/Guru/FormEditGuruComponent.vue')
		},
		{
		  path: '/hapus/guru/:id',
		  name: 'hapusGuru',
		  component: require('./components/Sekretariat/Guru/DeleteGuruComponent.vue') 
		},
		// END GURU

		// DEWAN KYAI
		{
		  path: '/list_dewankyai',
		  name: 'listDewanKyai',
		  component: require('./components/Sekretariat/DewanKyai/ListDewanKyaiComponent.vue') 
		},

		{
		  path: '/tambah_dewankyai',
		  name: 'tambahDewanKyai',
		  component: require('./components/Sekretariat/DewanKyai/FormDewanKyaiComponent.vue') 
		},

		{
		  path: '/dewankyai/edit/:id',
		  name: 'editDewanKyai',
		  component: require('./components/Sekretariat/DewanKyai/FormEditDewanKyaiComponent.vue') 
		},

		{
		  path: '/dewankyai/aktif/:id',
		  name: 'aktifDewanKyai',
		  component: require('./components/Sekretariat/DewanKyai/AktifDewanKyaiComponent.vue') 
		},
		{
		  path: '/dewankyai/hapus/:id',
		  name: 'hapusDewanKyai',
		  component: require('./components/Sekretariat/DewanKyai/DeleteDewanKyaiComponent.vue') 
		},
		// END DEWAN KYAI

		// SANTRI
		{
		  path: '/list_santri',
		  name: 'listSantri',
		  component: require('./components/Sekretariat/Santri/ListSantriComponent.vue') 
		},

		{
		  path: '/list_santri_aktif',
		  name: 'listSantriAktif',
		  component: require('./components/Sekretariat/Santri/ListSantriAktifComponent.vue')
		},

		{
	 	  path: '/detail/santri/:id',
		  name: 'detailSantri',
		  component: require('./components/Sekretariat/Santri/DetailSantriComponent.vue') 
		},


		{
		  path: '/edit/santri/:id',
		  name: 'editSantri',
		  component: require('./components/Sekretariat/Santri/FormEditSantriComponent.vue') 
		},


		{
		  path: '/hapus/santri/:id',
		  name: 'hapusSantri',
		  component: require('./components/Sekretariat/Santri/DeleteSantriComponent.vue') 
		},
		// END SANTRI

		// MUTASI
		{
		  path: '/mutasi/santri',
		  name: 'mutasiSantri',
		  component: require('./components/Sekretariat/Mutasi/MutasiComponent.vue') 
		},


		{
		  path: '/mutasi/santri/:id',
		  name: 'pindahSantri',
		  component: require('./components/Sekretariat/Mutasi/PilihAsramaComponent.vue') 
		},
		// END MUTASI


		// -------------------------------------PENDIDIKAN----------------------------------------- //

		// Periode

		{
		  path: '/list_periode',
		  name: 'listPeriode',
		  component: require('./components/Pendidikan/Periode/ListPeriodeComponent.vue') 
		},


		{
		  path: '/aktif/periode/:id',
		  name: 'aktifPeriode',
		  component: require('./components/Pendidikan/Periode/AktifPeriodeComponent.vue') 
		},


		{
		  path: '/tambah/periode',
		  name: 'tambahPeriode',
		  component: require('./components/Pendidikan/Periode/TambahFormPeriodeComponent.vue') 
		},


		{
		  path: '/edit/periode/:id',
		  name: 'editPeriode',
		  component: require('./components/Pendidikan/Periode/EditFormPeriodeComponent.vue') 
		},


		{
		  path: '/hapus/periode/:id',
		  name: 'hapusPeriode',
		  component: require('./components/Pendidikan/Periode/DeletePeriodeComponent.vue') 
		},

		// End Periode

		// Mata Pelajaran
		{
		  path: '/list_matapelajaran',
		  name: 'listMataPelajaran',
		  component: require('./components/Pendidikan/MataPelajaran/ListMataPelajaranComponent.vue') 
		},

		{
		  path: '/mata_pelajaran/tambah',
		  name: 'tambahMataPelajaran',
		  component: require('./components/Pendidikan/MataPelajaran/TambahMataPelajaran.vue') 
		},

		{
		  path: '/mata_pelajaran/detail/:id',
		  name: 'detailMataPelajaran',
		  component: require('./components/Pendidikan/MataPelajaran/DetailMataPelajaranComponent.vue') 
		},

		{
		  path: '/mata_pelajaran/edit/:id',
		  name: 'editMataPelajaran',
		  component: require('./components/Pendidikan/MataPelajaran/EditMataPelajaranComponent.vue') 
		},

		{
		  path: '/mata_pelajaran/hapus/:id',
		  name: 'hapusMataPelajaran',
		  component: require('./components/Pendidikan/MataPelajaran/HapusMataPelajaranComponent.vue')  
		},
		// End Mata Pelajaran

		// Master Kegiatan
		{
		  path: '/list_kegiatan',
		  name: 'listKegiatan',
		  component: require('./components/Pendidikan/Kegiatan/ListKegiatanComponent.vue') 
		},

		{
		  path: '/kegiatan/tambah',
		  name: 'tambahKegiatan',
		  component: require('./components/Pendidikan/Kegiatan/TambahKegiatan.vue') 
		},

		{
		  path: '/kegiatan/detail/:id',
		  name: 'detailKegiatan',
		  component: require('./components/Pendidikan/Kegiatan/DetailKegiatanComponent.vue') 
		},

		{
		  path: '/kegiatan/edit/:id',
		  name: 'editKegiatan',
		  component: require('./components/Pendidikan/Kegiatan/EditKegiatanComponent.vue') 
		},

		{
		  path: '/kegiatan/hapus/:id',
		  name: 'hapusKegiatan',
		  component: require('./components/Pendidikan/Kegiatan/HapusKegiatanComponent.vue') 
		},
		// End Master Kegiatan

		{
		  path: '/penempatankelas',
		  name: 'penempatankelas',
		  component: require('./components/Pendidikan/PenempatanKelas/PenempatanKelasComponent.vue') 
		},

		{
		  path: '/konfirmasipenempatan/:id',
		  name: 'konfirmasipenempatan',
		  component: require('./components/Pendidikan/PenempatanKelas/KonfirmasiPenempatanComponent.vue') 
		},

		// Absen
		{
		  path: '/absen',
		  name: 'absen',
		  component: require('./components/Pendidikan/Absen/AbsenComponent.vue') 
		},

			// Report Absensi

			{
			  path: '/absen/report',
			  name: 'absenReport',
			  component: require('./components/Pendidikan/Absen/AbsenReportComponent.vue') 
			},

			// End Report Absensi
		// End Absen

		// Semester

		{
		  path: '/list_semester',
		  name: 'listSemester',
		  component: require('./components/Pendidikan/Semester/ListSemesterComponent.vue') 
		},

		{
		  path: '/tambah/semester',
		  name: 'tambahSemester',
		  component: require('./components/Pendidikan/Semester/TambahSemesterComponent.vue') 
		},

		{
		  path: '/edit/semester/:id',
		  name: 'editSemester',
		  component: require('./components/Pendidikan/Semester/EditSemesterComponent.vue') 
		},

		{
		  path: '/aktifkan_semester/:id',
		  name: 'aktifKanSemester',
		  component: require('./components/Pendidikan/Semester/AktifkanSemesterComponent.vue') 
		},

		{
		  path: '/perubahan_semester',
		  name: 'perubahanSemester',
		  component: require('./components/Pendidikan/Semester/PerubahanSemesterComponent.vue') 
		},

		{
		  path: '/hapus/semester/:id',
		  name: 'haspuSemester',
		  component: require('./components/Pendidikan/Semester/HapusSemesterComponent.vue') 
		},

		// End Semester

		// Jadwal Pelajaran
		{
		  path: '/jadwalpelajaran',
		  name: 'jadwalPelajaran',
		  component: require('./components/Pendidikan/JadwalPelajaran/JadwalPelajaranComponent.vue') 
		},

		{
		  path: '/jadwalpelajaran/tambah',
		  name: 'tambahJadwalPelajaran',
		  component: require('./components/Pendidikan/JadwalPelajaran/TambahJadwalPelajaranComponent.vue') 
		},

		{
		  path: '/jadwalpelajaran/edit/:id',
		  name: 'editJadwalPelajaran',
		  component: require('./components/Pendidikan/JadwalPelajaran/EditJadwalPelajaranComponent.vue') 
		},

		{
		  path: '/jadwalpelajaran/hapus/:id',
		  name: 'hapusJadwalPelajaran',
		  component: require('./components/Pendidikan/JadwalPelajaran/HapusJadwalPelajaranComponent.vue') 
		},
		// End Jadwal Pelajaran

		// Keuangan

			// Pemasukan
			{
			  path: '/keuangan',
			  name: 'keuangan',
			  component: require('./components/Keuangan/KeuanganComponent.vue') 
			},


			{
			  path: '/keuangan/pemasukan',
			  name: 'keuanganPemasukan',
			  component: require('./components/Keuangan/PemasukanComponent.vue') 
			},

			{
			  path: '/keuangan/tambahpemasukan/donatur',
			  name: 'keuanganTambahPemasukanDonatur',
			  component: require('./components/Keuangan/TambahPemasukanDonaturComponent.vue') 
			},
			// End Pemasukan

			// Pengeluaran

			{
			  path: '/keuangan/pengeluaran',
			  name: 'keuanganPengeluaran',
			  component: require('./components/Keuangan/PengeluaranComponent.vue')
			},


			{
			  path: '/keuangan/pengeluaran/edit/:id',
			  name: 'keuanganPengeluaranEdit',
			  component: require('./components/Keuangan/EditPengeluaranComponent.vue')
			},


			{
			  path: '/keuangan/pengeluaran/hapus/:id',
			  name: 'keuanganPengeluaranHapus',
			  component: require('./components/Keuangan/HapusPengeluaranComponent.vue')
			},


			{
			  path: '/keuangan/pengeluaran/jenispengeluaran/hapus/:id',
			  name: 'keuanganPengeluaranJenisPengeluaranHapus',
			  component: require('./components/Keuangan/HapusPengeluaranJenisPengeluaranComponent.vue')
			},


			{
			  path: '/keuangan/pengeluaran/jenispengeluaran/edit/:id',
			  name: 'keuanganPengeluaranJenisPengeluaranEdit',
			  component: require('./components/Keuangan/EditJenisPengeluaranComponent.vue')
			},

			// End Pengeluaran

			// Syariah
			{
			  path: '/keuangan/syariah',
			  name: 'keuanganSyariah',
			  component: require('./components/Keuangan/Syariah/SyariahComponent.vue')
			},

			{
			  path: '/keuangan/syariah/bayar/:id/:tgl',
			  name: 'keuanganSyariahBayar',
			  component: require('./components/Keuangan/Syariah/PembayaranSyariahComponent.vue')
			},


			{
			  path: '/keuangan/syariah/riwayat/:id',
			  name: 'keuanganRiwayat',
			  component: require('./components/Keuangan/Syariah/RiwayatPembayaranSyariahPerSantriComponent.vue')
			},
			// End Syariah

		// End Kuangan

		// Keamanan

			{
			  path: '/keamanan',
			  name: 'keamanan',
			  component: require('./components/Keamanan/KeamananComponent.vue')
			},

			{
			  path: '/list_entri',
			  name: 'listEntri',
			  component: require('./components/Keamanan/ListEntriComponent.vue')
			},

			{
			  path: '/pemberitahuan',
			  name: 'pemberitahuan',
			  component: require('./components/Keamanan/PemberitahuanComponent.vue')
			},


			{
			  path: '/edit/keamanan/:id',
			  name: 'editKeamanan',
			  component: require('./components/Keamanan/EditKeamananComponent.vue')
			},


			{
			  path: '/laporan/entri_izin',
			  name: 'laporanEntriIzin',
			  component: require('./components/Keamanan/LaporanEntriIzinComponent.vue')
			},


			{
			  path: '/pengaturan',
			  name: 'pengaturan',
			  component: require('./components/Keamanan/PengaturanKeamananComponent.vue')
			},

		// End Keamanan


]
const router = new VueRouter({ routes });
const app = new Vue({
  router
}).$mount('#app');
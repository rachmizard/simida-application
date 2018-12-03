<template>
  <div class="panel">
      <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
          <div class="row row-lg">
              <div class="col-md-12">
                  <!-- Panel Wizard Form -->
                  <div class="panel">
                    <div class="panel-heading">
                      <h3 class="panel-title">Form Pendaftaran</h3>
                    </div>
                    <div class="panel-body">

                      <!-- Example -->

                      <div>
                      <form action="/sekretariat/pendaftaran/store" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" :value="csrf">
                        <vue-good-wizard 
                          :steps="steps"
                          :onNext="nextClicked" 
                          :onBack="backClicked">
                            <div slot="page1">
                              <h4>Step 1</h4>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div :class="['form-group', errors.nama_santri ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Nama</label>
                                        <input type="text" class="form-control" id="" name="nama_santri" placeholder="Nama Santri" autocomplete="off" required="" />
                                        <span v-if="errors.nama_santri" class="label label-danger">{{ errors.nama_santri[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.tgl_lahir ? 'has-error' : '']">
                                        <label class="form-control-label">Tanggal Lahir</label>
                                        <datepicker name="tgl_lahir" :bootstrap-styling="true" required=""></datepicker>
                                        <span v-if="errors.tgl_lahir" class="label label-danger">{{ errors.tgl_lahir[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.nik ? 'has-error' : '']">
                                        <label class="form-control-label" for="">NIK / No.KTP</label>
                                        <input type="text" class="form-control" placeholder="Nomor Induk Kartu Keluarga/Nomor" name="nik" autocomplete="off" required=""/>
                                        <span v-if="errors.nik" class="label label-danger">{{ errors.nik[0] }}</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div :class="['form-group', errors.jenis_kelamin ? 'has-error' : '']">
                                       <label class="form-control-label">Jenis Kelamin</label>
                                       <select class="form-control" name="jenis_kelamin" required="">
                                            <option disabled selected value="">Pilih Jenis Kelamin</option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <span v-if="errors.jenis_kelamin" class="label label-danger">{{ errors.jenis_kelamin[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.nama_ortu ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Nama Ayah <b>Kandung</b></label>
                                        <input type="text" class="form-control" name="nama_ortu" id="" placeholder="Nama Ayah Kandung" autocomplete="off" required=""/>
                                        <span v-if="errors.nama_ortu" class="label label-danger">{{ errors.nama_ortu[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.nama_wali ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Nama Orangtua <b>Wali</b></label>
                                        <input type="text" class="form-control" id="" name="nama_wali" placeholder="Nama Wali Bila Ada" autocomplete="off" required=""/>
                                        <span v-if="errors.nama_wali" class="label label-danger">{{ errors.nama_wali[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.no_telp ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Nomor Telepon Aktif</label>
                                        <input type="text" class="form-control" id="" name="no_telp" placeholder="Nomor Handphone Aktif" autocomplete="off" required=""/>
                                        <span v-if="errors.no_telp" class="label label-danger">{{ errors.no_telp[0] }}</span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div slot="page2">
                              <h4>Step 2</h4>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div :class="['form-group', errors.provinsi ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Provinsi</label>
                                        <select name="provinsi" class="form-control col-md-12" style="width: 100%;" required="" id="provinces" v-model="santri.provinsi" @change="getRegenciesByProvince()">
                                            <option disabled selected value="">Nama Provinsi</option>
                                            <option v-for="province in provinces.data" :value="province.id">{{ province.name }}</option>
                                        </select>
                                        <span v-if="errors.provinsi" class="label label-danger">{{ errors.provinsi[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.kabupaten_kota ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Kabupaten</label>
                                        <select name="kabupaten_kota"v-model="santri.kabupaten_kota" class="form-control col-md-12" style="width: 100%;" required="" @change="getDistrictsByRegency()">
                                            <option disabled selected value="">Nama Kabupaten</option>
                                            <option v-for="regency in regencies.data" :value="regency.id">{{ regency.name }}</option>
                                        </select>
                                        <span v-if="errors.kabupaten_kota" class="label label-danger">{{ errors.kabupaten_kota[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.kecamatan ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Kecamatan</label>
                                        <select name="kecamatan" class="form-control col-md-12" v-model="santri.kecamatan" style="width: 100%;" required="" @change="getVillagesByDistrict()">
                                            <option disabled selected value="">Nama Kecamatan..</option>
                                            <option v-for="district in districts.data" :value="district.id">{{ district.name }}</option>
                                        </select>
                                        <span v-if="errors.kecamatan" class="label label-danger">{{ errors.kecamatan[0] }}</span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div :class="['form-group', errors.kelurahan ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Kelurahan</label>
                                        <select name="kelurahan" v-model="santri.kelurahan" class="form-control col-md-12" style="width: 100%;" required="">
                                            <option disabled selected value="">Kelurahan setempat...</option>
                                            <option v-for="village in villages.data" :value="village.id">{{ village.name }}</option>
                                        </select>
                                        <span v-if="errors.kelurahan" class="label label-danger">{{ errors.kelurahan[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.kode_pos ? 'has-error' : '']">
                                       <label class="form-control-label" for="">Kode Pos</label>
                                       <input type="text" name="kode_pos" class="form-control" id="" placeholder="Kode Pos" autocomplete="off" required="numeric" />
                                       <span v-if="errors.kode_pos" class="label label-danger">{{ errors.kode_pos[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.alamat ? 'has-error' : '']">
                                       <label class="form-control-label" for="">Alamat</label>
                                       <input type="text" name="alamat" class="form-control" id="" placeholder="Alamat Santri" required="" autocomplete="off" />
                                       <span v-if="errors.alamat" class="label label-danger">{{ errors.alamat[0] }}</span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div slot="page3">
                              <h4>Step 3</h4>
                                <div class="row">
                                  <div class="col-md-4">
                                    <div :class="['form-group', errors.pendidikan_terakhir ? 'has-error' : '']">
                                       <label class="form-control-label" for="">Pendidikan Terakhir</label>
                                       <select name="pendidikan_terakhir" class="form-control">
                                            <option disabled selected>Pendidikan Terakhir</option>
                                            <option>SD</option>
                                            <option>SMP</option>
                                            <option>SMA</option>
                                            <option>SMK</option>
                                        </select>
                                        <span v-if="errors.pendidikan_terakhir" class="label label-danger">{{ errors.pendidikan_terakhir[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.pesantren_sebelumnya ? 'has-error' : '']">
                                       <label class="form-control-label" for="">Pesantren Sebelumnya</label>
                                       <input type="text" name="pesantren_sebelumnya" class="form-control" id="" placeholder="Nama Pesantren Sebelumnya..." autocomplete="off" />
                                       <span v-if="errors.pesantren_sebelumnya" class="label label-danger">{{ errors.pesantren_sebelumnya[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.dewan_id ? 'has-error' : '']">
                                       <label class="form-control-label" for="">Dewan Yang Menerima</label>
                                       <select name="dewan_id" class="form-control">
                                            <option disabled selected value="">Nama Dewan Kyai</option>
                                            <option v-for="dewan in dewans.data" :value="dewan.id">{{ dewan.nama_dewan_kyai }}</option>
                                        </select>
                                        <span v-if="errors.dewan_id" class="label label-danger">{{ errors.dewan_id[0] }}</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div :class="['form-group', errors.tgl_masuk ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Tanggal Masuk</label>
                                        <datepicker name="tgl_masuk" :bootstrap-styling="true" required=""></datepicker>
                                        <span v-if="errors.tgl_masuk" class="label label-danger">{{ errors.tgl_masuk[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.asrama_id ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Asrama</label>
                                        <select name="asrama_id" id="asrama" v-model="santri.asrama_id" @change="getKobongByAsrama" class="form-control" style="width: 100%;">
                                            <option disabled selected value="">Asrama</option>
                                            <option v-for="asrama in asramas.data" :value="asrama.asrama_id">{{ asrama.nama_asrama }}</option>
                                        </select>
                                        <span v-if="errors.asrama_id" class="label label-danger">{{ errors.asrama_id[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.kobong_id ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Kobong</label>
                                        <select name="kobong_id" class="form-control" style="width: 100%;">
                                            <option disabled selected value="">Kobong</option>
                                            <option v-for="kobong in kobongs.data" :value="kobong.id">{{ kobong.nama_kobong }}</option>
                                        </select>
                                        <span v-if="errors.kobong_id" class="label label-danger">{{ errors.kobong_id[0] }}</span>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div :class="['form-group', errors.tingkat_id ? 'has-error' : '']">
                                       <label class="form-control-label" for="">Tingkat</label>
                                       <select name="tingkat_id" class="form-control" style="width: 100%;">
                                            <option disabled selected value="">Tingkat</option>
                                            <option v-for="tingkat in tingkats.data" :value="tingkat.id">{{ tingkat.nama_tingkatan }}</option>
                                        </select>
                                        <span v-if="errors.tingkat_id" class="label label-danger">{{ errors.tingkat_id[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.kelas_id ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Kelas</label>
                                        <select name="kelas_id" class="form-control" style="width: 100%;">
                                            <option disabled selected value="">Kelas</option>
                                            <option v-for="kelasque in kelas.data" :value="kelasque.id">{{ kelasque.nama_kelas }}</option>
                                        </select>
                                        <span v-if="errors.kelas_id" class="label label-danger">{{ errors.kelas_id[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.himpunan ? 'has-error' : '']">
                                       <label class="form-control-label" for="">Himpunan</label>
                                       <input type="text" class="form-control" id="" name="himpunan" placeholder="Himpunan" autocomplete="off" />
                                       <span v-if="errors.himpunan" class="label label-danger">{{ errors.himpunan[0] }}</span>
                                    </div>
                                    <div :class="['form-group', errors.foto ? 'has-error' : '']">
                                        <label class="form-control-label" for="">Foto Santri</label>
                                      <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                        <input type="text" class="form-control" readonly="">
                                        <span class="input-group-btn">
                                          <span class="btn btn-success btn-file">
                                            <i class="icon wb-upload" aria-hidden="true"></i>
                                            <input type="file" name="foto">
                                          </span>
                                        </span>
                                      </div>
                                      <span v-if="errors.foto" class="label label-danger">{{ errors.foto[0] }}</span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div slot="page4">
                              <h4>Step 4</h4>
                              <div class="text-center my-20">
                                <i class="icon wb-check font-size-40" aria-hidden="true"></i>
                                <h4>Data sudah lengkap, klik tombol kirim untuk melakukan pengiriman data.</h4>
                                <button type="submit" class="btn btn-sm btn-success">Kirim</button>
                              </div>
                            </div>
                        </vue-good-wizard>
                      </form>
                      </div>
                    </div>
                  </div>
                  <!-- End Panel Wizard One Form -->
                </div>
              </div><!--/.col-->
          </div>
      </div>
  </div>
</template>
<script>

  import Datepicker from 'vuejs-datepicker';

  export default {

    components: {
      Datepicker
    },

    mounted(){
      axios.get('/sekretariat/provinces').then(response => {
        this.provinces = response.data;
      })

      axios.get('/sekretariat/dewankyai/getDewanKyaiJSON').then(response => {
        this.dewans = response.data;
      })

      axios.get('/sekretariat/asrama/get/allKategori').then(response => {
        this.asramas = response.data;
      })

      axios.get('/sekretariat/tingkatan/getJSON').then(response => {
        this.tingkats = response.data;
      })

      axios.get('/sekretariat/kelas/JSON').then(response => {
        this.kelas = response.data;
      })
    },

    data(){
      return {
        errors: [],
        provinces: [],
        regencies: [],
        districts: [],
        villages: [],
        dewans: [],
        asramas : [],
        kobongs: [],
        tingkats: [],
        kelas: [],
        santri: {
          nama_santri: '',
          tgl_lahir: '',
          nik: '',
          jenis_kelamin: '',
          nama_ortu: '',
          nama_wali: '',
          no_telp: '',
          provinsi: '',
          kabupaten_kota: '',
          kecamatan: '',
          kelurahan: '',
          kode_pos: '',
          alamat: '',
          pendidikan_terakhir: '',
          pesantren_sebelumnya: '',
          dewan_id : '',
          tgl_masuk: '',
          asrama_id : '',
          kobong_id: '',
          tingkat_id: '',
          kelas_id: '',  
          himpunan: ''
        },
        image : '',
        steps: [
        {
          label: 'Identitas Santri',
          slot: 'page1',
        },
        {
          label: 'Lokasi & Alamat',
          slot: 'page2',
        },
        {
          label: 'Data Lanjutan',
          slot: 'page3',
        },
        {
          label: 'Verifikasi',
          slot: 'page4',
          options: {
            nextDisabled: true,
          }
        }
      ],
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    },

    methods: {
      getRegenciesByProvince(){
          let app = this;
          var id = app.santri.provinsi;
          axios.get('/sekretariat/province/regencies/'+ id).then(response => {
              app.regencies = response.data;
          })
      },

      getDistrictsByRegency(){
          let app = this;
          var id_regency = app.santri.kabupaten_kota;
          axios.get('/sekretariat/province/regency/districts/'+ id_regency).then(response => {
            app.districts = response.data;
          })
      },

      getVillagesByDistrict(){
          let app = this;
          var id_district = app.santri.kecamatan;
          axios.get('/sekretariat/province/regency/district/villages/'+ id_district).then(response => {
              app.villages = response.data;
          })
      },


      getKobongByAsrama(){
        let app = this;
        var id = app.santri.asrama_id;
        axios.get('/sekretariat/asrama/'+ id +'/kobongJSON').then(response => {
          app.kobongs = response.data;
        })
      },

      store:function(e){
        e.preventDefault();
        let app = this;
        var formData = app.santri;

        const config = {
            headers: { 'Content-Type': 'multipart/form-data' }
        }

        axios.post('/sekretariat/pendaftaran/store', { params: formData}, config).
        then(response => {
          app.$router.push('/list_santri');
        }).catch((error) => {
            app.errors = error.response.data.errors;
            console.log(error.response.data.errors);
        })
      },

       nextClicked(currentPage) {
          console.log('next clicked', currentPage)
          return true; //return false if you want to prevent moving to next page
      },
        backClicked(currentPage) {
          console.log('back clicked', currentPage);
          return true; //return false if you want to prevent moving to previous page
        }

    }
  }
</script>
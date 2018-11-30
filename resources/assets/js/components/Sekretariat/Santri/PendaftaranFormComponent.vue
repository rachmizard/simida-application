<template>
  <div class="panel">
      <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
          <div class="row row-lg">
              <div class="col-md-12">
                  <!-- Panel Wizard Form -->
                  <div class="panel" id="exampleWizardForm">
                    <div class="panel-heading">
                      <h3 class="panel-title">Form Pendaftaran</h3>
                    </div>
                    <div class="panel-body">
                      <!-- Steps -->
                      <div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
                        <div class="step col-lg-3 current" data-target="#exampleAccount" role="tab">
                          <span class="step-number">1</span>
                          <div class="step-desc">
                            <span class="step-title">Data Santri</span>
                            <p>Input identitas santri</p>
                          </div>
                        </div>

                        <div class="step col-lg-3" data-target="#exampleBilling" role="tab">
                          <span class="step-number">2</span>
                          <div class="step-desc">
                            <span class="step-title">Alamat</span>
                            <p>Lokasi dan Alamat santri</p>
                          </div>
                        </div>

                        <div class="step col-lg-3" data-target="#exampleVerification" role="tab">
                          <span class="step-number">3</span>
                          <div class="step-desc">
                            <span class="step-title">Data Lanjutan</span>
                            <p>Penempatan kelas, asrama, & foto santri </p>
                          </div>
                        </div>

                        <div class="step col-lg-3" data-target="#exampleGetting" role="tab">
                          <span class="step-number">4</span>
                          <div class="step-desc">
                            <span class="step-title">Verifikasi</span>
                            <p>Kirim Data</p>
                          </div>
                        </div>
                      </div>
                      <!-- End Steps -->

                      <!-- Wizard Content -->

                        <div class="wizard-content">
                          <div class="wizard-pane active" id="exampleAccount" role="tabpanel">
                            <form id="exampleAccountForm">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="inputBasicFirstName">Nama</label>
                                    <input type="text" class="form-control" v-model="santri.nama_santri" id="inputBasicFirstName" name="nama_santri" placeholder="Nama Santri" autocomplete="off" required="required" />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="inputBasicLastName">Tanggal Lahir</label>
                                    <input type="text" class="form-control datelahir" v-model="santri.tgl_lahir" name="tgl_lahir" placeholder="DD/MM/YYYY" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="inputBasicLastName">NIK / No.KTP</label>
                                    <input type="text" class="form-control" v-model="santri.nik" id="nik" name="nik" placeholder="Nomor Induk Kartu Keluarga/Nomor" autocomplete="off" required="required"/>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                   <label class="form-control-label" for="inputBasicFirstName">Jenis Kelamin</label>
                                   <select name="jenis_kelamin" class="form-control" v-model="santri.jenis_kelamin" required="required">
                                        <option disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="">Nama Ayah <b>Kandung</b></label>
                                    <input type="text" class="form-control" id="inputBasicFirstName" name="nama_ortu" placeholder="Nama Ayah Kandung" autocomplete="off" required="required"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="inputBasicLastName">Nama Orangtua <b>Wali</b></label>
                                    <input type="text" class="form-control" id="inputBasicLastName" v-model="santri.nama_wali" name="nama_wali" placeholder="Nama Wali Bila Ada" autocomplete="off" required="required"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="">Nomor Telepon Aktif</label>
                                    <input type="text" class="form-control" v-model="santri.no_telp" id="inputBasicFirstName" name="no_telp" placeholder="Nomor Handphone Aktif" autocomplete="off" required="required"/>
                                </div>
                              </div>
                            </div>
                            </form>
                          </div>
                          <div class="wizard-pane" id="exampleBilling" role="tabpanel">
                            <form id="exampleBillingForm">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicFirstName">Provinsi</label>
                                      <select name="provinsi" v-model="santri.provinsi" class="form-control col-md-12" style="width: 100%;" required="required" id="provinces" @change="getRegenciesByProvince()">
                                          <option disabled selected value="">Nama Provinsi</option>
                                          <option v-for="province in provinces.data" :value="province.id">{{ province.name }}</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicLastName">Kabupaten</label>
                                      <select name="kabupaten_kota" v-model="santri.kabupaten_kota" class="form-control col-md-12" style="width: 100%;" required="required" @change="getDistrictsByRegency()">
                                          <option disabled selected value="">Nama Kabupaten</option>
                                          <option v-for="regency in regencies.data" :value="regency.id">{{ regency.name }}</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicFirstName">Kecamatan</label>
                                      <select name="kecamatan" v-model="santri.kecamatan" class="form-control col-md-12" style="width: 100%;" required="required" @change="getVillagesByDistrict()">
                                          <option disabled selected value="">Nama Kecamatan..</option>
                                          <option v-for="district in districts.data" :value="district.id">{{ district.name }}</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicLastName">Kelurahan</label>
                                      <select name="kelurahan" v-model="santri.kelurahan" class="form-control col-md-12" style="width: 100%;" required="required">
                                          <option disabled selected value="">Kelurahan setempat...</option>
                                          <option v-for="village in villages.data" :value="village.id">{{ village.name }}</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Kode Pos</label>
                                     <input type="text" name="kode_pos" class="form-control" id="inputBasicFirstName" placeholder="Kode Pos" v-model="santri.kode_pos" autocomplete="off" required="numeric" />
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Alamat</label>
                                     <input type="text" name="alamat" v-model="santri.alamat" class="form-control" id="inputBasicFirstName" placeholder="Alamat Santri" required="required" autocomplete="off" />
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="wizard-pane" id="exampleVerification" role="tabpanel">
                            <form id="exampleVerificationForm">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Pendidikan Terakhir</label>
                                     <select name="pendidikan_terakhir" v-model="santri.pendidikan_terakhir" class="form-control">
                                          <option disabled selected>Pendidikan Terakhir</option>
                                          <option>SD</option>
                                          <option>SMP</option>
                                          <option>SMA</option>
                                          <option>SMK</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Pesantren Sebelumnya</label>
                                     <input type="text" name="pesantren_sebelumnya" class="form-control" id="inputBasicFirstName" placeholder="Nama Pesantren Sebelumnya..." autocomplete="off" />
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Dewan Yang Menerima</label>
                                     <select name="dewan_id" v-model="santri.dewan_id" class="form-control">
                                          <option disabled selected value="">Nama Dewan Kyai</option>
                                          <option v-for="dewan in dewans.data" :value="dewan.id">{{ dewan.nama_dewan_kyai }}</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicLastName">Tanggal Masuk</label>
                                      <input type="text" class="form-control datepicker" name="tgl_masuk" placeholder="DD/MM/YYYY" autocomplete="off" />
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicFirstName">Asrama</label>
                                      <select name="asrama_id" id="asrama" v-model="santri.asrama_id" @change="getKobongByAsrama" class="form-control selectTo" style="width: 100%;">
                                          <option disabled selected>Asrama</option>
                                          <option v-for="asrama in asramas.data" :value="asrama.asrama_id">{{ asrama.nama_asrama }}</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicLastName">Kobong</label>
                                      <select name="kobong_id" v-model="santri.kobong_id" class="form-control selectTo" style="width: 100%;">
                                          <option disabled selected>Kobong</option>
                                          <option v-for="kobong in kobongs.data" :value="kobong.id">{{ kobong.nama_kobong }}</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Tingkat</label>
                                     <select name="tingkat_id" class="form-control" v-model="santri.tingkat_id" style="width: 100%;">
                                          <option disabled selected value="">Tingkat</option>
                                          <option v-for="tingkat in tingkats.data" :value="tingkat.id">{{ tingkat.nama_tingkatan }}</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicFirstName">Kelas</label>
                                      <select name="kelas_id" class="form-control selectTo" v-model="santri.kelas_id" style="width: 100%;">
                                          <option disabled selected value="">Kelas</option>
                                          <option v-for="kelasque in kelas.data" :value="kelasque.id">{{ kelasque.nama_kelas }}</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Himpunan</label>
                                     <input type="text" class="form-control" v-model="santri.himpunan" id="inputBasicFirstName" name="himpunan" placeholder="Himpunan" autocomplete="off" />
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicFirstName">Foto Santri</label>
                                    <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                      <input type="text" class="form-control" readonly="">
                                      <span class="input-group-btn">
                                        <span class="btn btn-success btn-file">
                                          <i class="icon wb-upload" aria-hidden="true"></i>
                                          <input type="file" name="foto">
                                        </span>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="wizard-pane" id="exampleGetting" role="tabpanel">
                            <div class="text-center my-20">
                              <i class="icon wb-check font-size-40" aria-hidden="true"></i>
                              <h4>Data sudah lengkap, klik tombol kirim untuk melakukan pengiriman data.</h4>
                              <button @click="store" class="btn btn-sm btn-success">Kirim</button>
                            </div>
                          </div>
                        </div>
                      <!-- End Wizard Content -->
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
  export default {
    mounted(){
      this.function()
      axios.get('/sekretariat/provinces').then(response => {
        this.provinces = response.data;
      })
    },

    data(){
      return {
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
        image : ''
      }
    },

    methods: {
      function(){

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
        const formData = app.santri;

        const config = {
            headers: { 'Content-Type': 'multipart/form-data' }
        }

        axios.post('/sekretariat/pendaftaran/store', formData, config)
        then(response => {
          app.$router.push('/list_santri');
        })
      }

    }
  }
</script>
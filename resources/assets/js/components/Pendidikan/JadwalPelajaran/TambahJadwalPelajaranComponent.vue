<template>
    <div class="panel">
        <div class="panel col-md-12">
            <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                <div class="row row-lg">
                    <div class="col-md-12">
                        <div v-if="message" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <i class="icon wb-check" aria-hidden="true"></i> {{ message }}
                        </div>
                        <div v-if="messageWarning" class="alert dark alert-icon alert-warning alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <i class="icon wb-check" aria-hidden="true"></i> {{ messageWarning }}
                        </div>
                        <div v-if="messageWarningKegiatan" class="alert dark alert-icon alert-warning alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <i class="icon wb-check" aria-hidden="true"></i> {{ messageWarningKegiatan }}
                        </div>
                        <form @submit.prevent="storejadwalpelajaran" action="/pendidikan/jadwalpelajaran/store"  autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                <h4 class="example-title"><i class="icon wb-time"></i> Tambah Jadwal Pelajaran</h4>
                                    <div class="example">
                                        <div class="form-row">
                                        	<div class="row">
                                        		<div class="col-md-3">
	                                                <div class="form-group">
	                                                   <label class="form-control-label" for="inputBasicFirstName">Guru</label>
                                                        <Select2 v-model="jadwalpelajaran.guru_id" :options="guruOptions"/>
	                                                   <span v-if="errors.guru_id" class="badge badge-danger">{{ errors.guru_id[0] }}</span>
	                                                </div>
                                        		</div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                       <label class="form-control-label" for="inputBasicFirstName">Kelas</label>
                                                        <Select2 v-model="jadwalpelajaran.kelas_id" :options="kelasOptions"/>
                                                       <span v-if="errors.kelas_id" class="badge badge-danger">{{ errors.kelas_id[0] }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                       <label class="form-control-label" for="inputBasicFirstName">Mata Pelajaran</label>
                                                        <Select2 v-model="jadwalpelajaran.mata_pelajaran_id" :options="mataPelajaranOptions"/>
                                                       <span v-if="errors.mata_pelajaran_id" class="badge badge-danger">{{ errors.mata_pelajaran_id[0] }}</span>
                                                    </div>
                                                </div>
                                        		<div class="col-md-3">
	                                                <div class="form-group">
	                                                    <label class="form-control-label" for="inputBasicFirstName">Hari</label>
	                                                    <select v-model="jadwalpelajaran.hari" class="form-control">
                                                            <option value="" disabled="" selected="">Pilih Hari</option>      
                                                            <option value="Senin">Senin</option>
                                                            <option value="Selasa">Selasa</option>
                                                            <option value="Rabu">Rabu</option>
                                                            <option value="Kamis">Kamis</option>
                                                            <option value="Jumat">Jum'at</option>
                                                            <option value="Sabtu">Sabtu</option>
                                                            <option value="Minggu">Minggu</option>
                                                        </select>
	                                                    <span v-if="errors.hari" class="badge badge-danger">{{ errors.hari[0] }}</span>
	                                                </div>
                                        		</div>
                                        		<div class="col-md-3">
	                                                <div class="form-group">
	                                                    <label class="form-control-label" for="inputBasicFirstName">Jam Masuk</label>
                                                        <input type="time" v-model="jadwalpelajaran.jam_masuk" class="form-control" placeholder="H:m">
	                                                    <span v-if="errors.jam_masuk" class="badge badge-danger">{{ errors.jam_masuk[0] }}</span>
	                                                </div>
	                                            </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="inputBasicFirstName">Jam Selesai</label>
                                                        <input type="time" v-model="jadwalpelajaran.jam_selesai" class="form-control" placeholder="H:m">
                                                        <span v-if="errors.jam_selesai" class="badge badge-danger">{{ errors.jam_selesai[0] }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="inputBasicFirstName">Periode</label>
                                                        <input type="text" disabled v-model="periode" class="form-control">
                                                    </div>
                                                </div>
                                        	</div>
                                        </div>
                                        <div class="form-row">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Tambah</button>
                                                <router-link to="/jadwalpelajaran" class="btn btn-warning">Kembali</router-link>
                                            </div>
                                       </div>
                                    </div><!--/Example-->
                            </div><!--/.form-group
                            =========================-->
                         </div><!--/.form-row-->
                        </form>
                    </div><!--/.col-->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
	import Datepicker from 'vuejs-datepicker';
    import Select2 from 'v-select2-component';

    export default {
	  components: {
	    Datepicker,
        Select2
	  },

        mounted() {
        	this.function();
        },

        data(){
            return {
                errors: [],
                guruOptions: [],
                kelasOptions: [],
                mataPelajaranOptions: [],
                jadwalpelajaran: {
                    mata_pelajaran_id: '',
                    guru_id: '',
                    kelas_id: '',
                    hari: '',
                    semester_id: '',
                    jam_masuk: '',
                    jam_selesai: '',
                    periode: ''
                },
                periode: '',
                message: '',
                messageError: '',
                messageWarning: '',
                messageWarningKegiatan: ''
            }
        },

        methods: {
        	function(){
        		axios.get('/sekretariat/tingkatan/getJSON').then(response => {
        			this.tingkats = response.data;
        		})

                axios.get('/pendidikan/periode/isactived').then(response => {
                    this.periode = response.data.nama_periode;
                })

                axios.get('/sekretariat/guru/GuruSelect2').then(response => {
                    this.guruOptions = response.data.data
                })

                axios.get('/sekretariat/kelas/KelasSelect2').then(response => {
                    this.kelasOptions = response.data.data
                })

                axios.get('/pendidikan/matapelajaran/MataPelajaranSelect2').then(response => {
                    this.mataPelajaranOptions = response.data.data
                })
        	},

            storejadwalpelajaran:function(e){
                let app = this;
                var body = app.jadwalpelajaran;
                axios.post(e.target.action, body)
                .then(function (resp) {
                  app.errors = [];
                  app.message = resp.data.response.message;
                  if (app.message == false) {
                	app.messageWarning = resp.data.response.messageWarning;
                    app.messageWarningKegiatan = resp.data.response.messageWarningKegiatan;
	                    setTimeout(() => {
	                        app.messageError = false;
	                        app.message = false;
	                        app.messageWarning = false;
                            app.messageWarningKegiatan = false;
	                    }, 14000);	
                  }else{
	                app.$router.replace('/jadwalpelajaran'); // redirect to url "/"
	                    setTimeout(() => {
	                        app.messageError = false;
	                        app.message = false;
	                    }, 14000);	
                  }
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.message = false;
                });
            },

            filterForTingkat(){
            	axios.get('/sekretariat/kelas/'+ this.jadwalpelajaran.mulai_jadwalpelajaran  +'/tingkat').then(response => {
            		this.kelass = response.data;
            	});
            }
        }

    }
</script>
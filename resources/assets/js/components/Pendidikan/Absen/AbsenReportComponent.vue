<template>
    <div id="app">
        <div class="row">
            <div class="col-md-12">                
                <div class="panel">
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
                                <form @submit.prevent="storekegiatan" action="/pendidikan/kegiatan/store"  autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                        <h4 class="example-title"><i class="icon wb-search"></i> Filter Data Absen</h4>
                                            <div class="example">
                                                <div class="form-row">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                               <label class="form-control-label" for="inputBasicFirstName">Kelas</label>
                                                                <Select2 v-model="rekapabsen.kelas_id"  :options="kelass"/> 
                                                                    <span v-if="errors.kelas_id" class="label label-danger">{{ errors.kelas_id[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                               <label class="form-control-label" for="inputBasicFirstName">Asrama</label>
                                                                <Select2 v-model="rekapabsen.asrama_id"  :options="asramas" />    
                                                                <span v-if="errors.asrama_id" class="label label-danger">{{ errors.asrama_id[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="inputBasicFirstName">Tanggal Awal</label>
                                                                <datepicker v-model="rekapabsen.start_date" :bootstrap-styling="true" required="" :format="customFormatter" placeholder="Tanggal Awal"></datepicker>
                                                                <span v-if="errors.start_date" class="label label-danger">{{ errors.start_date[0] }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="inputBasicFirstName">Tanggal Akhir</label>
                                                                <datepicker v-model="rekapabsen.end_date" :bootstrap-styling="true" required="" :format="customFormatter" placeholder="Tanggal Akhir"></datepicker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Rekap</button>
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
            <div class="col-md-12">                
                <div class="panel">
                    <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                        <div class="row row-lg">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th rowspan="2">NIS</th>
                                        <th rowspan="2">Nama Santri</th>
                                        <th v-for="kegiatan in kegiatans.data" colspan="3" class="text-center">
                                            {{ kegiatan.nama_kegiatan }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <td v-for="kegiatan in kegiatans.data" border="0">Izin</td>
                                        <td v-for="kegiatan in kegiatans.data" border="0">Sakit</td>
                                        <td v-for="kegiatan in kegiatans.data" border="0">Hadir</td>
                                    </tr>
                                    <tr v-for="santri in santris.data">
                                        <td>{{ santri.nis }}</td>
                                        <td>{{ santri.nama_santri }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
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
            this.fetchKelas();
            this.fetchAsrama();
            this.fetchSantri();
            this.fetchKegiatan();
        },

        data(){
            return {
                errors: [],
                santris: [],
                kegiatans: [],
                tingkats: [],
                kelass: [],
                asramas: [],
                rekapabsen: {
                    kelas_id: '',
                    asrama_id: '',
                    start_date: '',
                    end_date: ''
                },
                periode: '',
                message: '',
                messageError: '',
                messageWarning: ''
            }
        },

        methods: {

            customFormatter(date) {
                  return moment(date).format('DD-MM-YYYY');
            },

            fetchKegiatan(){
                axios.get('/pendidikan/absen/listKegiatan').then(response => {
                    this.kegiatans = response.data;
                })
            },

            fetchSantri(){
                axios.get('/pendidikan/absen/santri', { params: { kelas_id: 1 } }).then(response => {
                    this.santris = response.data;
                })
            },

            fetchKelas(){
                axios.get('/sekretariat/kelas/KelasSelect2').then(response => {
                    this.kelass = response.data.data;
                })
            },

            fetchAsrama(){
                axios.get('/sekretariat/asrama/AsramaSelect2').then(response => {
                    this.asramas = response.data.data;
                })
            },

        	function(){
        		axios.get('/sekretariat/tingkatan/getJSON').then(response => {
        			this.tingkats = response.data;
        		})

                axios.get('/pendidikan/periode/isactived').then(response => {
                    this.periode = response.data.nama_periode;
                })

        		// axios.get('/sekretariat/kelas/JSON').then(response => {
        		// 	this.kelass = response.data;
        		// })
        	},

            storekegiatan:function(e){
                let app = this;
                var body = app.kegiatan;
                axios.post(e.target.action, body)
                .then(function (resp) {
                  app.errors = [];
                  app.message = resp.data.response.message;
                  if (app.message == false) {
                	app.messageWarning = resp.data.response.messageWarning;
	                    setTimeout(() => {
	                        app.messageError = false;
	                        app.message = false;
	                        app.messageWarning = false;
	                    }, 5000);	
                  }else{
	                app.$router.replace('/list_kegiatan'); // redirect to url "/"
	                    setTimeout(() => {
	                        app.messageError = false;
	                        app.message = false;
	                    }, 5000);	
                  }
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.message = false;
                });
            },

            filterForTingkat(){
            	axios.get('/sekretariat/kelas/'+ this.kegiatan.mulai_kegiatan  +'/tingkat').then(response => {
            		this.kelass = response.data;
            	});
            }
        }

    }
</script>
<template>
    <div id="app">
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
                            <form @submit.prevent="storekegiatan" action="/pendidikan/kegiatan/store"  autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                    <h4 class="example-title"><i class="icon wb-book"></i> Tambah Kegiatan</h4>
                                        <div class="example">
                                            <div class="form-row">
                                            	<div class="row">
                                            		<div class="col-md-4">
		                                                <div class="form-group">
		                                                   <label class="form-control-label" for="inputBasicFirstName">Nama Kegiatan</label>
		                                                   <input v-model="kegiatan.nama_kegiatan" type="text" class="form-control" placeholder="Nama Kegiatan.." autocomplete="off" />
		                                                        <span v-if="errors.nama_kegiatan" class="label label-danger">{{ errors.nama_kegiatan[0] }}</span>
		                                                </div>
                                            		</div>
                                            		<div class="col-md-4">
		                                                <div class="form-group">
		                                                    <label class="form-control-label" for="inputBasicFirstName">Jam Mulai</label>
		                                                    <input type="time" v-model="kegiatan.mulai_kegiatan" class="form-control" placeholder="H:m">
		                                                    <span v-if="errors.mulai_kegiatan" class="label label-danger">{{ errors.mulai_kegiatan[0] }}</span>
		                                                </div>
                                            		</div>
                                            		<div class="col-md-4">
		                                                <div class="form-group">
		                                                    <label class="form-control-label" for="inputBasicFirstName">Jam Akhir</label>
                                                            <input type="time" v-model="kegiatan.akhir_kegiatan" class="form-control" placeholder="H:m">
		                                                    <span v-if="errors.akhir_kegiatan" class="label label-danger">{{ errors.akhir_kegiatan[0] }}</span>
		                                                </div>
		                                            </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName">Periode Kegiatan</label>
                                                            <input type="text" disabled v-model="periode" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName">Poin Kegiatan</label>
                                                            <input type="number" v-model="kegiatan.nilai_kegiatan" class="form-control" placeholder='Contoh: "5" / atau lebih'>
                                                        </div>
                                                    </div>
                                            	</div>
                                            </div>
                                            <div class="form-row">
                                                <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Tambah</button>
                                                <router-link :to="{ name: 'listKegiatan' }" class="btn btn-warning">Kembali</router-link>
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
    </div>
</template>
<script>
	import Datepicker from 'vuejs-datepicker';

    export default {
	  components: {
	    Datepicker
	  },

        mounted() {
        	this.function();
        },

        data(){
            return {
                errors: [],
                tingkats: [],
                kelass: [],
                kegiatan: {
                    nama_kegiatan: '',
                    mulai_kegiatan: '',
                    akhir_kegiatan: '',
                    nilai_kegiatan: ''
                },
                periode: '',
                message: '',
                messageError: '',
                messageWarning: ''
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
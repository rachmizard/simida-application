<template>
    <div id="app">
        <div class="panel">
        <div class="page-header">
            <h3 class="page-title"><i class="icon wb-book"></i> Mata Pelajaran</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="">Pendidikan</a></li>
                <li class="breadcrumb-item"><a href="">Mata Pelajaran</a></li>
                <li class="breadcrumb-item active">Tambah Mata Pelajaran</li>
            </ol>
        </div>
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
                            <form @submit.prevent="storematapelajaran" action="/pendidikan/matapelajaran/store"  autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                    <h4 class="example-title"><i class="icon wb-book"></i> Tambah Mata Pelajaran</h4>
                                        <div class="example">
                                            <div class="form-row">
                                            	<div class="row">
                                            		<div class="col-md-6">
		                                                <div class="form-group">
		                                                   <label class="form-control-label" for="inputBasicFirstName">Nama Mata Pelajaran</label>
		                                                   <input v-model="matapelajaran.nama_mata_pelajaran" type="text" class="form-control" placeholder="Nama Mata Pelajaran" autocomplete="off" />
		                                                        <span v-if="errors.nama_mata_pelajaran" class="label label-danger">{{ errors.nama_mata_pelajaran[0] }}</span>
		                                                </div>
                                            		</div>
                                            		<div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="form-control-label" for="inputBasicFirstName">Tingkat Mata Pelajaran</label>
		                                                    <select @change="filterForTingkat" v-model="matapelajaran.tingkat_id" class="form-control">
		                                                    	<option value="" selected disabled>Pilih tingkat pada mata pelajaran</option>
		                                                    	<option v-for="tingkat in tingkats.data" :value="tingkat.id">{{ tingkat.nama_tingkatan }}</option>
		                                                    </select>
		                                                    <span v-if="errors.tingkat_id" class="label label-danger">{{ errors.tingkat_id[0] }}</span>
		                                                </div>
                                            		</div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                           <label class="form-control-label" for="inputBasicFirstName">Bobot Mata Pelajaran</label>
                                                           <input v-model="matapelajaran.bobot" type="text" class="form-control" placeholder="Contoh: 5" autocomplete="off" />
                                                                <span v-if="errors.bobot" class="label label-danger">{{ errors.bobot[0] }}</span>
                                                        </div>
                                                    </div>
                                            		<!-- <div class="col-md-4">
		                                                <div class="form-group">
		                                                    <label class="form-control-label" for="inputBasicFirstName">Kelas</label>
		                                                    <select v-model="matapelajaran.kelas_id" class="form-control">
		                                                    	<option value="" selected disabled>Pilih tingkat pada mata pelajaran</option>
		                                                    	<option v-for="kelas in kelass.data" :value="kelas.id">{{ kelas.nama_kelas }}</option>
		                                                    </select>
		                                                    <span v-if="errors.kelas_id" class="label label-danger">{{ errors.kelas_id[0] }}</span>
		                                                </div>
		                                            </div> -->
                                            	</div>
                                            </div>
                                            <div class="form-row">
                                                <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Tambah</button>
                                                <router-link :to="{ name: 'listMataPelajaran' }" class="btn btn-warning">Kembali</router-link>
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
                matapelajaran: {
                    nama_mata_pelajaran: '',
                    tingkat_id: '',
                    bobot: ''
                    // kelas_id: ''
                },
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
        		// axios.get('/sekretariat/kelas/JSON').then(response => {
        		// 	this.kelass = response.data;
        		// })
        		// axios.get('/sekretariat/kelas/JSON').then(response => {
        		// 	this.kelass = response.data;
        		// })
        	},

            storematapelajaran:function(e){
                let app = this;
                var body = app.matapelajaran;
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
	                app.$router.replace('/list_matapelajaran'); // redirect to url "/"
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
            	axios.get('/sekretariat/kelas/'+ this.matapelajaran.tingkat_id  +'/tingkat').then(response => {
            		this.kelass = response.data;
            	});
            }
        }

    }
</script>
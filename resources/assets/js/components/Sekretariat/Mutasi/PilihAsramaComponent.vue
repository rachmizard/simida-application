<template>
    <div id="app">
        <div class="panel">
		<div class="page-header">
			<h3 class="page-title"><i class="icon wb-home"></i> Perpindahan Asrama Santri</h3>
		    <ol class="breadcrumb">
		        <li class="breadcrumb-item"><a href="">Home</a></li>
		        <li class="breadcrumb-item"><router-link to="/mutasi/santri">Perpindahan Asrama Santri</router-link></li>
		        <li class="breadcrumb-item active">{{ santri.nama_santri }}</li>
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
                            <form @submit.prevent="mutasiExecute" action="/pendidikan/santri/store"  autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                    <!-- <h4 class="example-title">Mutasi Asrama Santri</h4> -->
                                        <div class="example">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                   <label class="form-control-label" for="inputBasicFirstName">Asrama Sekarang</label>
                                                   <select v-model="santri.asrama_id" disabled class="form-control" id="">
                                                   		<option v-for="asrama in asramas.data" disabled :value="asrama.asrama_id" >{{ asrama.nama_asrama }}</option>
                                                   </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                   <label class="form-control-label" for="inputBasicFirstName">Kobong Sekarang</label>
                                                   <select v-model="santri.kobong_id" disabled class="form-control" id="">
                                                   		<option selected :value="santri.kobong.id">{{ santri.kobong.nama_kobong }}</option>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                   <label class="form-control-label" for="inputBasicFirstName">Pindah ke Asrama</label>
                                                   <select v-on:change="getKobongForAsrama" v-model="mutasi.asrama_id" class="form-control" id="">
                                                   		<option value="" disabled="" selected="">Pilih Asrama Yang Dituju</option>
                                                   		<option v-for="asrama in asramas.data" :value="asrama.asrama_id" >{{ asrama.nama_asrama }}</option>
                                                   </select>
                                                        <span v-if="errors.asrama_id" class="label label-danger">{{ errors.asrama_id[0] }}</span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                   <label class="form-control-label" for="inputBasicFirstName">Kobong</label>
                                                   <select v-model="mutasi.kobong_id" class="form-control" id="">
                                                   		<option value="" disabled="" selected>Pilih Asrama Terlebih Dahulu</option>
                                                   		<option v-for="kobong in kobongs.data" :value="kobong.id" >{{ kobong.nama_kobong }}</option>
                                                   </select>
                                                        <span v-if="errors.kobong_id" class="label label-danger">{{ errors.kobong_id[0] }}</span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-control-label" for="inputBasicFirstName">Alasan Mutasi</label>
													<input type="text" class="form-control" v-model="mutasi.alasan_mutasi">
                                                    <span v-if="errors.alasan_mutasi" class="label label-danger">{{ errors.alasan_mutasi[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Mutasi</button>
                                                <router-link :to="{ name: 'mutasiSantri' }" class="btn btn-warning">Batal</router-link>
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
        	let app = this;
        	var id_santri = app.$route.params.id;
        	axios.get('/sekretariat/santri/'+ id_santri +'/show').then(response => {
        		app.santri = response.data;
        	})

        	axios.get('/sekretariat/asrama/get/allKategori').then(response => {
        		app.asramas = response.data;
        	})
        },

        data(){
            return {
                errors: [],
                santri: [],
                kobongs: [],
                mutasi: {
                	asrama_id: '',
                	kobong_id: '',
                	alasan_mutasi: '',	
                },
                asramas: [],
                message: '',
                messageError: '',
                messageWarning: ''
            }
        },

        methods: {
        	mutasiExecute:function(e){
        		let app = this;
        		var body = app.mutasi;
        		let id = app.$route.params.id;
        		axios.post('/sekretariat/mutasi/'+ id +'/mutasi', body).then(response => {
        			app.$router.push('/mutasi/santri');
        		}).catch((error) => {
        			app.errors = error.response.data.errors;
        		});
        	},

        	getKobongForAsrama(){
        		var kobong_id = this.mutasi.asrama_id;
        		axios.get('/sekretariat/asrama/'+ kobong_id +'/kobongJSON').then(response => {
        			this.kobongs = response.data;
        		})
        	}
        }

    }
</script>
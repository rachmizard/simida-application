<template>
    <div id="app">
        <div class="page-header">
            <h1 class="page-title">Edit Periode</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
                <li class="breadcrumb-item"><a href="#">Periode</a></li>
                <li class="breadcrumb-item active">Edit Periode</li>
            </ol>
        </div>
        <div class="panel">
            <div class="panel col-md-6">
                <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                    <div class="row row-lg">
                        <div class="col-md-12">
                            <div v-if="message" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <i class="icon wb-check" aria-hidden="true"></i> {{ message }}
                            </div>
                            <form @submit.prevent="updateperiode" action="/pendidikan/periode/store"  autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                    <h4 class="example-title">Edit Periode</h4>
                                        <div class="example">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                   <label class="form-control-label" for="inputBasicFirstName">Tahun</label>
                                                   <input v-model="periode.nama_periode" type="text" class="form-control" placeholder="Tahun baru.." autocomplete="off" />
                                                        <span v-if="errors.nama_periode" class="label label-danger">{{ errors.nama_periode[0] }}</span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-control-label" for="inputBasicFirstName">Tanggal Mulai</label>
                                                    <datepicker v-model="periode.start_date"  :bootstrap-styling="true" placeholder="Pilih tanggal awal"></datepicker>
                                                    <span v-if="errors.start_date" class="label label-danger">{{ errors.start_date[0] }}</span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-control-label" for="inputBasicFirstName">Tanggal Akhir</label>
                                                    <datepicker v-model="periode.end_date"  :bootstrap-styling="true" placeholder="Pilih tanggal akhir"></datepicker>
                                                    <span v-if="errors.end_date" class="label label-danger">{{ errors.end_date[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Edit</button>
                                                <router-link :to="{ name: 'listPeriode' }" class="btn btn-warning">Batal</router-link>
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
        	var id_periode = app.$route.params.id;
        	axios.get('/pendidikan/periode/'+ id_periode +'/show').then(response => {
        		app.periode.nama_periode = response.data.nama_periode;
        		app.periode.start_date = response.data.start_date;
        		app.periode.end_date = response.data.end_date;
        		app.periode.status = response.data.status;
        	})
        },

        data(){
            return {
                errors: [],
                periode: {
                    nama_periode: '',
                    start_date: '',
                    end_date: '',
                    status: '',
                },
                message: '',
                messageError: '',
                messageWarning: ''
            }
        },

        methods: {
            updateperiode:function(e){
                let app = this;
                var periode = app.periode;
                axios.put('/pendidikan/periode/'+ app.$route.params.id +'/update', periode)
                .then(function (resp) {
                  app.errors = [];
                  app.message = resp.data.response.message;
                    // app.messageError = false; // showing result
                  app.periode.nama_periode = ''; // clear form
                  app.periode.kategori = ''; // clear form
                  app.$router.replace('/list_periode'); // redirect to url "/"
                    setTimeout(() => {
                        app.messageError = false;
                        app.message = false;
                    }, 5000);
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.message = false;
                });
            }
        }

    }
</script>
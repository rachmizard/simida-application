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
                            <form @submit.prevent="storepemasukan" action="/keuangan/pemasukan/store"  autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                    <h4 class="example-title"><i class="icon wb-graph-up"></i> Tambah Pemasukan Via Donatur</h4>
                                        <div class="example">
                                            <div class="form-row">
                                            	<div class="row">
                                            		<div class="col-md-4">
		                                                <div class="form-group">
                                                            <div class="input-group input-group-icon">
                                                                <span class="input-group-addon"><i class="icon wb-user"></i></span>
                                                                <input v-model="pemasukan.nama_donatur" type="text" class="form-control" placeholder="Nama Donatur.." autocomplete="off" />
                                                            </div>
                                                                <span v-if="errors.nama_donatur" class="badge badge-sm badge-danger">{{ errors.nama_donatur[0] }}</span>
		                                                </div>
                                            		</div>
                                            		<div class="col-md-4">
		                                                <div class="form-group">
                                                            <div class="input-group input-group-icon">
                                                                <span class="input-group-addon"><i class="icon wb-calendar"></i></span>
                                                                <datepicker v-model="pemasukan.tgl_pemasukan" :bootstrap-styling="true" required="" :format="customFormatter" placeholder="Tanggal Pemasukan"></datepicker>
                                                            </div>
                                                                <span v-if="errors.tgl_pemasukan" class="badge badge-sm badge-danger">{{ errors.tgl_pemasukan[0] }}</span>
		                                                </div>
                                            		</div>
                                            		<div class="col-md-4">
		                                                <div class="form-group">
                                                            <div class="input-group input-group-icon">
                                                                <span class="input-group-addon">Rp.</span>
                                                                <input v-model="pemasukan.jumlah_pemasukan" type="text" class="form-control" placeholder="Contoh: 1890000" autocomplete="off" />
                                                            </div>
                                                                <span v-if="errors.jumlah_pemasukan" class="badge badge-sm badge-danger">{{ errors.jumlah_pemasukan[0] }}</span>
		                                                </div>
		                                            </div>
                                            	</div>
                                            </div>
                                            <div class="form-row">
                                                <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Tambah</button>
                                                <router-link :to="{ name: 'keuangan' }" class="btn btn-warning">Kembali</router-link>
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
        },

        data(){
            return {
                errors: [],
                tingkats: [],
                kelass: [],
                pemasukan: {
                    nama_donatur: '',
                    tgl_pemasukan: '',
                    jumlah_pemasukan: '',
                    jenis_pemasukan: 'donatur'
                },
                message: ''
            }
        },

        methods: {

            customFormatter(date) {
                  return moment(date).format('DD-MM-YYYY');
            },

            storepemasukan:function(e){
                let app = this;
                var body = app.pemasukan;
                console.log(body);
                axios.post(e.target.action, body)
                .then(function (resp) {
                  app.errors = [];
                  app.message = resp.data.response;
                  app.pemasukan.tgl_pemasukan = '';
                  app.pemasukan.nama_donatur = '';
                  app.pemasukan.jumlah_pemasukan = '';
                  app.pemasukan.jenis_pemasukan = '';
                  if (app.message == 'success') {   
                    app.message = 'Pemasukan berhasil ditambahkan ke database!';
                  }
                  setTimeout(() => {
                    app.message = false;
                  }, 8000);
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.message = false;
                });
            }
        }

    }
</script>
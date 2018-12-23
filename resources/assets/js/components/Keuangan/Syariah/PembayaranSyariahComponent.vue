<template>
    <div id="app">
      <div class="row row-lg">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-4">
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
                                  <div v-if="messageAlert" class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                        <i class="icon wb-check" aria-hidden="true"></i> {{ messageAlert }}
                                  </div>
                                  <div class="form-row">
                                      <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                          <h4 class="example-title"><i class="icon wb-check text-success"></i> Konfirmasi Pembayaran</h4>
                                              <div class="example">
                                                  <div class="form-row">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div class="form-group text-center">
                                                          	<img :src="'/storage/santri_pic/'+ santri.foto" alt="Foto Santri" class="img-responsive img-circle" width="100" height="100">
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label for=""><i class="icon wb-payment"></i> Bulan Pembayaran</label>
                                                                <div class="input-group input-group-icon">
                                                                    <input type="text" v-model="bulan" class="form-control" disabled>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                          	<label for="">NIS</label>
                                                                <div class="input-group input-group-icon">
                                                                    <input type="text" v-model="santri.nis" class="form-control" disabled>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                          	<label for="">Nama Santri</label>
                                                                <div class="input-group input-group-icon">
                                                                    <input type="text" v-model="santri.nama_santri" class="form-control" disabled>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                          	<label for="">Kelas</label>
                                                                <div class="input-group input-group-icon">
                                                                    <input type="text" disabled v-model="santri.kelas" class="form-control">
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                          	<label for="">Asrama</label>
                                                                <div class="input-group input-group-icon">
                                                                    <input type="text" v-model="santri.asrama" class="form-control" disabled>
                                                                </div>
                                                          </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="form-row">
                                                  	<div class="form-group">
                                                      <router-link to="/keuangan/syariah/" class="btn btn-sm btn-warning">Batal</router-link>
                                                      <button v-if="santri.status_pembayaran == 'Belum'" @click="bayar" class="btn btn-success">Bayar</button>
                                                      <button v-if="santri.status_pembayaran == 'Sudah'" class="btn btn-info" disabled>Sudah melakukan pembayaran</button>
                                                  	</div>
                                                 </div>
                                              </div><!--/Example-->
                                      </div><!--/.form-group
                                      =========================-->
                                   </div><!--/.form-row-->
                              </div><!--/.col-->
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-md-8">
              <!-- Panel Kitchen Sink -->
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">
                    <i class="icon wb-time"></i> Riwayat Pembayaran 
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">

                  <table id="pengeluaranTable" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Bulan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
						<tr v-if="santris.length != 0" v-for="santri in santris.data">
							<td>{{ santri.bulan }}</td>
							<td>{{ santri.tgl_transaksi }}</td>
							<td>{{ formatPrice(santri.nominal) }}</td>
							<td>a</td>
						</tr>
						<tr v-else>
							<td colspan="6">Data Kosong</td>
						</tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- End Panel Kitchen Sink -->
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
	    	var id = this.$route.params.id;
	    	axios.get('/keuangan/syariah/'+ id +'/getOnceSantri').then(response => {
	    		this.santri.santri_id = response.data.data.santri_id;
	    		this.santri.nis = response.data.data.nis;
	    		this.santri.nama_santri = response.data.data.nama_santri;
	    		this.santri.kelas = response.data.data.kelas;
	    		this.santri.asrama = response.data.data.asrama;
	    		this.santri.bulan = response.data.data.bulan;
	    		this.santri.status_pembayaran = response.data.data.status_pembayaran;
	    		this.santri.foto = response.data.data.foto;
	    		console.log(this.santri);
	    	});
        this.parseBulan();
	    	this.getRiwayatPembayaranPerSantri();
        },

        data(){
            return {
                errors: [],
                errorsJenis: [],
                asramas: [],
                kelass: [],
                santris: [],
                pengeluarans: [],
                nama_jenis_pengeluarans: [],
                bulan: '',
                santri: {
                	santri_id: '',
                	nis: '',
                	nama_santri: '',
                	kelas: '',
                	asrama: '',
                	status_pembayaran: '',
                	bulan: '',
                	foto: '',
                  tgl_pemasukan: this.$route.params.tgl,
                  jumlah_pemasukan: '',
                  jenis_pengeluaran: ''
                },
                total_uang: '',
                cool_decreased_cash: '',
                message: '',
                messageAlert: ''	
            }
        },

        methods: { 
            formatPrice(value) {
                return "Rp." + value.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1\.")
            },

            customFormatter(date) {
                  return moment(date).format('MM-YYYY');
            },

            parseBulan(){
              axios.get('/keuangan/syariah/parseBulan', { params: { bulan: this.$route.params.tgl } }).then(response => {
                this.bulan = response.data.bulan;
              })
            },

            getRiwayatPembayaranPerSantri(){
            	var id = this.$route.params.id;
		    	axios.get('/keuangan/syariah/'+ id +'/riwayatPembayaranPerSantri').then(response => {
		    		this.santris = response.data;
		    	})
            },

            bayar:function(e){
                let app = this;
                var body = app.santri;
                // console.log(body);
                axios.post('/keuangan/pemasukan/storeSyariah', body)
                .then(response => {
                  app.errors = [];
                  app.message = response.data.response.message;
                  app.messageAlert = response.data.response.messageAlert;
                  app.getRiwayatPembayaranPerSantri();
                  if (app.message == 'success') {   
                    app.message = 'Syariah berhasil ditambahkan ke database!';
                    app.cool_decreased_cash = true;
                  }else if(app.messageAlert){
                    app.messageAlert = 'Santri tersebut sudah melakukan bulanan!';
                    app.cool_decreased_cash = true;
                  }
                  setTimeout(() => {
                    app.cool_decreased_cash = false;
                  }, 3000);
                  setTimeout(() => {
                    app.message = false;
                    app.messageAlert = false;
                  }, 8000);
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     console.log(app.errors);
                     app.message = false;
                });
            }
        },

    }
</script>
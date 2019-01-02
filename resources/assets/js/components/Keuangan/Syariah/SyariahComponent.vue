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
                                  <div v-if="messageSuccess" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                        <i class="icon wb-check" aria-hidden="true"></i> {{ messageSuccess }}
                                  </div>
                                  <div v-if="messageAlert" class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                        <i class="icon wb-check" aria-hidden="true"></i> {{ messageAlert }}
                                  </div>
                                  <div class="form-row">
                                      <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                          <h4 class="example-title"><i class="icon wb-search text-success"></i> Filter Santri</h4>
                                              <div class="example">
                                                  <div class="form-row">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName">NIS</label>
                                                            <input type="text" v-model="filter.nis" class="form-control" placeholder="NIS Santri, Contoh : 293000022332">
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                          		<label class="form-control-label" for="inputBasicFirstName">Kelas</label>
                                                                <select v-model="filter.kelas" class="form-control">
                                                                  <option value="" selected disabled>Pilih Kelas</option>
                                                                  <option v-for="kelas in kelass.data" :value="kelas.id">{{ kelas.nama_kelas }}</option>
                                                                </select>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                       		<label class="form-control-label" for="inputBasicFirstName">Pilih Asrama</label>
                                                        	<Select2 v-model="filter.asrama" :options="asramas" placeholder="Pilih Asrama" />
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                              <label class="form-control-label" for="inputBasicFirstName">Bulan</label>
                                                              <datepicker v-model="filter.bulan" :bootstrap-styling="true" required="" :format="customFormatter" placeholder="Bulan Syariah"></datepicker>
                                                          		<span v-if="errors.bulan" class="badge badge-danger">{{ errors.bulan[0] }}</span>
                                                          </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="form-row">
                                                      <button @click="getSantriForSyariahWithRequest" class="btn btn-primary"><i class="icon wb-search"></i> Filter</button>
                                                      <button @click="resetFilter" class="btn btn-warning">Reset Pencarian</button>
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
                    <i class="icon wb-payment"></i> Syariah 
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">

                  <table id="pengeluaranTable" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>NIS</th>
                        <th>Nama Santri</th>
                        <th>Kelas</th>
                        <th>Asrama</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<tr v-if="santris.length == 0">
                    		<td colspan="6" class="text-center"><i class="icon wb-search"></i> Data belum ditampilkan, silahkan cari santri berdasarkan kelas/asrama.</td>
                    	</tr>
                    	<tr v-else v-for="santri in santris.data">
                    		<td>{{ santri.nis }}</td>
                    		<td>{{ santri.nama_santri }}</td>
                    		<td>{{ santri.kelas }}</td>
                    		<td>{{ santri.asrama }}</td>
                    		<td v-if="santri.status_pembayaran == 'Belum'" ><span class="badge badge-round badge-warning text-white">Belum melakukan pembayaran</span></td>
                    		<td v-else-if="santri.status_pembayaran == 'Sudah'" ><span class="badge badge-round badge-success">Sudah</span></td>
                    		<td>
                    			<router-link v-if="santri.status_pembayaran == 'Belum'" :to="{ path: '/keuangan/syariah/bayar/'+ santri.id +'/'+ santri.bulan }" class="btn btn-xs btn-success"><i class="icon wb-payment"></i> Pembayaran</router-link>
                    			<router-link v-else-if="santri.status_pembayaran == 'Sudah'" to="" class="btn btn-xs btn-info" disabled><i class="icon wb-check"></i></router-link>
                    			<router-link :to="{ path: '/keuangan/syariah/riwayat/'+ santri.id }" class="btn btn-warning btn-xs"><i class="icon wb-time"></i> Riwayat Pembayaran</router-link>
                    		</td>
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

				axios.get('/keuangan/kelas/JSON').then(response => {
					this.kelass = response.data;
				})

				axios.get('/keuangan/asrama/AsramaSelect2').then(response => {
					this.asramas = response.data.data;
				})
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
                syariah: {
                    tgl_pemasukan: '',
                    jumlah_pemasukan: '',
                    jenis_pengeluaran: ''
                },
                filter: {
                	nis: '',
                	kelas: '',
                	asrama: '',
                	bulan: ''
                },
                total_uang: '',
                cool_decreased_cash: '',
                message: '',
                messageAlert: '',
                messageSuccess: '',
                messageJenis: ''	
            }
        },

        methods: {
            formatPrice(value) {
                return "Rp." + value.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1\.")
            },

            customFormatter(date) {
                  return moment(date).format('MM-YYYY');
            },

            getSantriForSyariahWithRequest(){
            	axios.get('/keuangan/syariah/getSantriForSyariah', { params: { nis: this.filter.nis, kelas: this.filter.kelas, asrama: this.filter.asrama, bulan: this.filter.bulan  } }).then(response => {
            		this.santris = response.data;
            	}).catch((error) => {
            		this.errors = error.response.data.errors
            		setTimeout(() => {
            			this.errors = false;
            		}, 4000)
            	})
            },

            resetFilter(){
            	this.filter.nis = '';
            	this.filter.kelas = '';
            	this.filter.asrama = '';
            	this.filter.bulan = '';
            },

            storesyariah:function(e){
                let app = this;
                var body = app.syariah;
                // console.log(body);
                axios.post(e.target.action, body)
                .then(response => {
                  app.errors = [];
                  app.messageSuccess = response.data.response.messageSuccess;
                  app.messageAlert = response.data.response.messageAlert;
                  app.syariah.tgl_pemasukan = '';
                  app.syariah.jumlah_pemasukan = '';
                  app.syariah.jenis_pengeluaran = '';
                  if (app.messageSuccess == 'success') {   
                    app.messageSuccess = 'Syariah berhasil ditambahkan ke database!';
                    app.cool_decreased_cash = true;
                  }
                  setTimeout(() => {
                    app.cool_decreased_cash = false;
                  }, 3000);
                  setTimeout(() => {
                    app.messageSuccess = false;
                    app.messageAlert = false;
                  }, 8000);
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.messageSuccess = false;
                });
            }
        },

    }
</script>
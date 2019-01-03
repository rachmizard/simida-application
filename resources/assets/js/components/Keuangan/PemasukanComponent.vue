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
                                  <form @submit.prevent="storepemasukan" action="/keuangan/pemasukan/store"  autocomplete="off">
                                  <div class="form-row">
                                      <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                          <h4 class="example-title"><i class="icon wb-graph-up text-success"></i> Tambah Pemasukan</h4>
                                              <div class="example">
                                                  <div class="form-row">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div :class="['form-group', cool_decreased_cash == true ? 'has-error' : '']">
                                                                <div class="input-group input-group-icon">
                                                                    <input type="text" disabled="" class="form-control" :value="total_uang">
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon"><i class="icon wb-payment"></i></span>
                                                                    <select v-model="pemasukan.jenis_pemasukan" @change="checkIfSyariahWillBeRedirected" class="form-control">
                                                                      <option selected disabled>Pilih Jenis Pemasukan</option>
                                                                      <option value="infaq">Infaq</option>
                                                                      <option value="donatur">Donatur</option>
                                                                      <option value="syariah">Syariah</option>
                                                                    </select>
                                                                </div>
                                                                    <span v-if="errors.jenis_pemasukan" class="badge badge-sm badge-danger">{{ errors.jenis_pemasukan[0] }}</span>
                                                          </div>
                                                      </div>
                                                      <div v-if="pemasukan.jenis_pemasukan == 'donatur'" class="col-md-12">
                                                          <div class="form-group">
                                                                  <div class="input-group input-group-icon">
                                                                      <span class="input-group-addon"><i class="icon wb-user"></i></span>
                                                                      <input v-model="pemasukan.nama_donatur" type="text" class="form-control" placeholder="Nama Donatur.." autocomplete="off" />
                                                                  </div>
                                                                      <span v-if="errors.nama_donatur" class="badge badge-sm badge-danger">{{ errors.nama_donatur[0] }}</span>
                                                          </div>
                                                      </div>
                                                      <div v-if="pemasukan.jenis_pemasukan == 'infaq'" class="col-md-12">
                                                          <div class="form-group">
                                                                  <div class="input-group input-group-icon">
                                                                      <span class="input-group-addon"><i class="icon wb-user"></i></span>
                                                                      <input v-model="pemasukan.nama_donatur" type="text" class="form-control" placeholder="Nama Pemberi Infaq.." autocomplete="off" />
                                                                  </div>
                                                                      <span v-if="errors.nama_donatur" class="badge badge-sm badge-danger">{{ errors.nama_donatur[0] }}</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                                  <div class="input-group input-group-icon">
                                                                      <span class="input-group-addon"><i class="icon wb-calendar"></i></span>
                                                                      <datepicker v-model="pemasukan.tgl_pemasukan" :bootstrap-styling="true" required="" :format="customFormatter" placeholder="Tanggal pemasukan"></datepicker>
                                                                  </div>
                                                                      <span v-if="errors.tgl_pemasukan" class="badge badge-sm badge-danger">{{ errors.tgl_pemasukan[0] }}</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
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
            <div class="col-md-8">
              <!-- Panel Kitchen Sink -->
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">
                    <i class="icon wb-payment"></i> Pemasukan
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">

                	<div class="row">
                		<div class="col-md-4">
                			<div class="form-group">
                				<div class="input-group input-group-icon">
                					<span class="input-group-addon"><i class="icon wb-search"></i></span>
	                				<select name="filter_jenis_pemasukan" class="form-control" id="filter_jenis_pemasukan">
	                					<option value="" selected="" disabled="">Cari berdasarkan jenis</option>
	                					<option value="donatur">Donatur</option>
	                					<option value="syariah">Syariah</option>
	                				</select>
                				</div>
                			</div>
                		</div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="input-group input-group-icon">
                          <span class="input-group-addon"><i class="icon wb-calendar"></i></span>
                          <input type="text" placeholder="Contoh: 2019" name="filter_tahun" class="form-control" id="filter_tahun">
                        </div>
                      </div>
                    </div>
                		<div class="col-md-4">
                			<div class="form-group">
                				<div class="input-group input-group-icon">
                					<span class="input-group-addon"><i class="icon wb-calendar"></i></span>
	                				<select name="filter_bulan" class="form-control" id="filter_bulan">
	                					<option selected disabled>Tampilkan berdasar bulan</option>
	                					<option value="1">Januari</option>
	                					<option value="2">Februari</option>
	                					<option value="3">Maret</option>
	                					<option value="4">April</option>
	                					<option value="5">Mei</option>
	                					<option value="6">Juni</option>
	                					<option value="7">Juli</option>
	                					<option value="8">Agustus</option>
	                					<option value="9">September</option>
	                					<option value="10">Oktober</option>
	                					<option value="11">November</option>
	                					<option value="12">Desember</option>
	                				</select>
                				</div>
                			</div>
                		</div>
                	</div>

                  <table id="pemasukanTable" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No. Urut</th>
                        <th>Tanggal Pemasukan</th>
                        <th>Jenis Pemasukan</th>
                        <th>Nominal Pemasukan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
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

    export default {
    components: {
      Datepicker
    },

        mounted() {
            this.getTablepemasukan()
            // this.getNamaJenispemasukan()
            this.getTotalUangSekarang()
        },

        data(){
            return {
                errors: [],
                errorsJenis: [],
                tingkats: [],
                kelass: [],
                pemasukans: [],
                nama_jenis_pemasukans: [],
                pemasukan: {
                    tgl_pemasukan: '',
                    jumlah_pemasukan: '',
                    jenis_pemasukan: '',
                },
                nama_jenis_pemasukannya: {
                  name: '',
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

            getTotalUangSekarang(){
              axios.get('/keuangan/cashNow').then(response => {
                if (response.data.total == null) {
                 this.total_uang = this.formatPrice(0);
                }else{
                 this.total_uang = this.formatPrice(response.data.total); 
                }
              })
            },

            getTablepemasukan(){
                    $(function() {
                     var table = $('#pemasukanTable').DataTable({
                           "destroy": true,
                          "stateSave": true,
                          "processing": true,
                          "serverSide": true,
                          "ajax": {
                            url: "/keuangan/pemasukan/getPemasukanDataTables",
                            data:function(e){
                              e.filter_jenis_pemasukan = $('select[name="filter_jenis_pemasukan"]').val();
                              e.filter_bulan = $('select[name="filter_bulan"]').val();
                              e.filter_tahun = $('input[name="filter_tahun"]').val();
                            }
                          },
                          columns: [
                              { data: 'id', name: 'id' },
                              { data: 'tgl_pemasukan', name: 'tgl_pemasukan', orderable: true },
                              { data: 'jenis_pemasukan', name: 'jenis_pemasukan' },
                              { data: 'jumlah_pemasukan', name: 'jumlah_pemasukan'},
                              { data: 'action', name: 'action', orderable: false, searchable: false }
                          ]
                      }); 

                     // Auto reload when getting result 
                    $('#filter_jenis_pemasukan').on('change', function(e) {
                        table.draw();
                        e.preventDefault();
                    });


                     // Auto reload when getting result 
                    $('#filter_bulan').on('change', function(go) {
                        table.draw();
                        go.preventDefault();
                    });

                    // Trigger auto refresh
                    Echo.channel('draw-table')
                    .listen('DrawTable', (e) => {
                      table.draw();
                    });
              });
            },

            getNamaJenispemasukan(){
              axios.get('/keuangan/pemasukan/getNamaJenispemasukan').then(response => {
                this.nama_jenis_pemasukans = response.data;
              })
            },

            customFormatter(date) {
                  return moment(date).format('DD-MM-YYYY');
            },

            storepemasukan:function(e){
                let app = this;
                var body = app.pemasukan;
                // console.log(body);
                axios.post(e.target.action, body)
                .then(response => {
                  app.errors = [];
                  app.messageSuccess = response.data.response.messageSuccess;
                  app.messageAlert = response.data.response.messageAlert;
                  app.pemasukan.tgl_pemasukan = '';
                  app.pemasukan.jumlah_pemasukan = '';
                  app.pemasukan.nama_donatur = '';
                  app.pemasukan.jenis_pemasukan = '';
                  app.getTablepemasukan();
                  app.getTotalUangSekarang();
                  if (app.messageSuccess == 'success') {   
                    app.messageSuccess = 'pemasukan berhasil ditambahkan ke database!';
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
            },

            postnamajns:function(a){
              var wadahna = this.nama_jenis_pemasukannya;
              // console.log(this.wadahna);
              axios.post(a.target.action, wadahna).then(response => {
                this.errorsJenis = [];
                this.messageJenis = response.data.response;
                this.getNamaJenispemasukan();
                if (this.messageJenis == 'success') {
                  this.messageJenis = 'Jenis pemasukan berhasil di tambahkan'
                }
                setTimeout(() => {
                  this.messageJenis = false;
                }, 8000);
              }).catch((error) => {
                     this.errorsJenis = error.response.data.errors;
                     this.message = false;
              });
            },

            checkIfSyariahWillBeRedirected(){
            	let app = this;
            	if (app.pemasukan.jenis_pemasukan == 'syariah') {
            		app.$router.push('/keuangan/syariah');
            	}
            }
        },

    }
</script>
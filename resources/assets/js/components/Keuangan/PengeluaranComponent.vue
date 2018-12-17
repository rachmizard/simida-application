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
                                  <div v-if="messageJenis" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                        <i class="icon wb-check" aria-hidden="true"></i> {{ messageJenis }}
                                  </div>
                                  <form @submit.prevent="postnamajns" action="/keuangan/pengeluaran/jenispengeluaran/post"  autocomplete="off">
                                  <div class="form-row">
                                      <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                          <h4 class="example-title"><i class="icon wb-plus text-info"></i> Tambah Jenis Pengeluaran</h4>
                                              <div class="example">
                                                  <div class="form-row">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                                  <div class="input-group input-group-icon">
                                                                      <input v-model="nama_jenis_pengeluarannya.name" type="text" class="form-control" placeholder="Contoh: Atk/Bangunan/Kesehatan" autocomplete="off" />
                                                                  </div>
                                                                      <span v-if="errorsJenis.nama_jenis_pengeluaran" class="badge badge-sm badge-danger">{{ errorsJenis.nama_jenis_pengeluaran[0] }}</span>
                                                          </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="form-row">
                                                      <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Tambah</button>
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
                    <i class="icon wb-table"></i> Master Jenis Pengeluaran
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body">

                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No. Urut</th>
                        <th>Nama Jenis Pengeluaran</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="nama_jenis_pengeluarans.length == 0">
                        <td class="text-center" colspan="4">Jenis Pengeluaran masih kosong.</td>
                      </tr>
                      <tr v-else v-for="(jenis_pengeluaran, index) in nama_jenis_pengeluarans.data">
                        <td>{{ index+1 }}</td>
                        <td>{{ jenis_pengeluaran.nama_jenis_pengeluaran }}</td>
                        <td>
                          <div class="btn-group">
                            <router-link :to="{ path: '/keuangan/pengeluaran/jenispengeluaran/edit/'+ jenis_pengeluaran.id }" class="btn btn-warning btn-sm btn-round"><i class="icon wb-edit"></i></router-link>
                            <router-link :to="{ path: '/keuangan/pengeluaran/jenispengeluaran/hapus/'+ jenis_pengeluaran.id }" class="btn btn-danger btn-sm btn-round"><i class="icon wb-trash"></i></router-link>
                          </div>
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
                                  <form @submit.prevent="storepengeluaran" action="/keuangan/pengeluaran/store"  autocomplete="off">
                                  <div class="form-row">
                                      <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                          <h4 class="example-title"><i class="icon wb-graph-down text-danger"></i> Tambah Pengeluaran</h4>
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
                                                                    <span class="input-group-addon"><i class="icon wb-user"></i></span>
                                                                    <select v-model="pengeluaran.jenis_pengeluaran" class="form-control">
                                                                      <option value="" selected disabled>Pilih jenis pengeluaran</option>
                                                                      <option v-for="jenis_pengeluaran in nama_jenis_pengeluarans.data" :value="jenis_pengeluaran.id">{{ jenis_pengeluaran.nama_jenis_pengeluaran }}</option>
                                                                    </select>
                                                                </div>
                                                                    <span v-if="errors.jenis_pengeluaran" class="badge badge-sm badge-danger">{{ errors.jenis_pengeluaran[0] }}</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                                  <div class="input-group input-group-icon">
                                                                      <span class="input-group-addon"><i class="icon wb-calendar"></i></span>
                                                                      <datepicker v-model="pengeluaran.tgl_pengeluaran" :bootstrap-styling="true" required="" :format="customFormatter" placeholder="Tanggal pengeluaran"></datepicker>
                                                                  </div>
                                                                      <span v-if="errors.tgl_pengeluaran" class="badge badge-sm badge-danger">{{ errors.tgl_pengeluaran[0] }}</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                                  <div class="input-group input-group-icon">
                                                                      <span class="input-group-addon">Rp.</span>
                                                                      <input v-model="pengeluaran.jumlah_pengeluaran" type="text" class="form-control" placeholder="Contoh: 1890000" autocomplete="off" />
                                                                  </div>
                                                                      <span v-if="errors.jumlah_pengeluaran" class="badge badge-sm badge-danger">{{ errors.jumlah_pengeluaran[0] }}</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                                  <div class="input-group input-group-icon">
                                                                      <input v-model="pengeluaran.keterangan" type="text" class="form-control" placeholder="Keterangan Pengeluaran..." autocomplete="off" />
                                                                  </div>
                                                                      <span v-if="errors.keterangan" class="badge badge-sm badge-danger">{{ errors.keterangan[0] }}</span>
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
                    <i class="icon wb-payment"></i> Pengeluaran Bulan Ini
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">

                  <table id="pengeluaranTable" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No. Urut</th>
                        <th>Tanggal Pengeluaran</th>
                        <th>Jenis Pengeluaran</th>
                        <th>Nominal Pengeluaran</th>
                        <th>Keterangan</th>
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
            $(function() {
                     var table = $('#pengeluaranTable').DataTable({
                          "destroy": true,
                          "stateSave": true,
                          "processing": true,
                          "serverSide": true,
                          "ajax": {
                            url: "/keuangan/pengeluaran/getPengeluaranDataTables",
                            data:function(e){
                              e.filter_kelas = $('select[name="filter_kelas"]').val();
                              e.filter_asrama = $('select[name="filter_asrama"]').val();
                            }
                          },
                          columns: [
                              { data: 'id', name: 'id' },
                              { data: 'tgl_pengeluaran', name: 'tgl_pengeluaran', orderable: true },
                              { data: 'jenispengeluaran.nama_jenis_pengeluaran', name: 'jenispengeluaran.nama_jenis_pengeluaran' },
                              { data: 'jumlah_pengeluaran', name: 'jumlah_pengeluaran'},
                              { data: 'keterangan', name: 'keterangan'},
                              { data: 'action', name: 'action', orderable: false, searchable: false }
                          ]
                      }); 

                     // Auto reload when getting result 
                    $('#filter_kelas').on('change', function(e) {
                        table.draw();
                        e.preventDefault();
                    });


                     // Auto reload when getting result 
                    $('#filter_asrama').on('change', function(e) {
                        table.draw();
                        e.preventDefault();
                    });

                    // Trigger auto refresh
                    Echo.channel('draw-table')
                    .listen('DrawTable', (e) => {
                      table.draw();
                    });
              });
            this.getNamaJenisPengeluaran()
            this.getTotalUangSekarang()
        },

        data(){
            return {
                errors: [],
                errorsJenis: [],
                tingkats: [],
                kelass: [],
                pengeluarans: [],
                nama_jenis_pengeluarans: [],
                pengeluaran: {
                    tgl_pengeluaran: '',
                    jumlah_pengeluaran: '',
                    jenis_pengeluaran: '',
                    keterangan: '',
                },
                nama_jenis_pengeluarannya: {
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

            getTablePengeluaran(){
                    $(function() {
                     var table = $('#pengeluaranTable').DataTable({
                           "destroy": true,
                          "stateSave": true,
                          "processing": true,
                          "serverSide": true,
                          "ajax": {
                            url: "/keuangan/pengeluaran/getPengeluaranDataTables",
                            data:function(e){
                              e.filter_kelas = $('select[name="filter_kelas"]').val();
                              e.filter_asrama = $('select[name="filter_asrama"]').val();
                            }
                          },
                          columns: [
                              { data: 'id', name: 'id' },
                              { data: 'tgl_pengeluaran', name: 'tgl_pengeluaran', orderable: true },
                              { data: 'jenis_pengeluaran', name: 'jenis_pengeluaran' },
                              { data: 'jumlah_pengeluaran', name: 'jumlah_pengeluaran'},
                              { data: 'keterangan', name: 'keterangan'},
                              { data: 'action', name: 'action', orderable: false, searchable: false }
                          ]
                      }); 

                     // Auto reload when getting result 
                    $('#filter_kelas').on('change', function(e) {
                        table.draw();
                        e.preventDefault();
                    });


                     // Auto reload when getting result 
                    $('#filter_asrama').on('change', function(e) {
                        table.draw();
                        e.preventDefault();
                    });

                    // Trigger auto refresh
                    Echo.channel('draw-table')
                    .listen('DrawTable', (e) => {
                      table.draw();
                    });
              });
            },

            getNamaJenisPengeluaran(){
              axios.get('/keuangan/pengeluaran/getNamaJenisPengeluaran').then(response => {
                this.nama_jenis_pengeluarans = response.data;
              })
            },

            customFormatter(date) {
                  return moment(date).format('DD-MM-YYYY');
            },

            storepengeluaran:function(e){
                let app = this;
                var body = app.pengeluaran;
                // console.log(body);
                axios.post(e.target.action, body)
                .then(response => {
                  app.errors = [];
                  app.messageSuccess = response.data.response.messageSuccess;
                  app.messageAlert = response.data.response.messageAlert;
                  app.pengeluaran.tgl_pengeluaran = '';
                  app.pengeluaran.jumlah_pengeluaran = '';
                  app.pengeluaran.jenis_pengeluaran = '';
                  app.pengeluaran.keterangan = '';
                  app.getTablePengeluaran();
                  app.getTotalUangSekarang();
                  if (app.messageSuccess == 'success') {   
                    app.messageSuccess = 'Pengeluaran berhasil ditambahkan ke database!';
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
              var wadahna = this.nama_jenis_pengeluarannya;
              // console.log(this.wadahna);
              axios.post(a.target.action, wadahna).then(response => {
                this.errorsJenis = [];
                this.messageJenis = response.data.response;
                this.getNamaJenisPengeluaran();
                if (this.messageJenis == 'success') {
                  this.messageJenis = 'Jenis pengeluaran berhasil di tambahkan'
                }
                setTimeout(() => {
                  this.messageJenis = false;
                }, 8000);
              }).catch((error) => {
                     this.errorsJenis = error.response.data.errors;
                     this.message = false;
              });
            }
        },

    }
</script>
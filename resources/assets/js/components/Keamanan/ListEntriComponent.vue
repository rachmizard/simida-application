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
                                          <h4 class="example-title"><i class="icon wb-search text-success"></i> Filter Entri</h4>
                                              <div class="example">
                                                  <div class="form-row">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName">Tanggal Awal</label>
                                                            <input type="date" class="form-control" name="start_date" id="start_date">
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName">Tanggal Akhir</label>
                                                            <input type="date" class="form-control" name="end_date" id="end_date">
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                            <button id="filter_trigger" class="btn btn-sm btn-info">
                                                              <i class="icon wb-search"></i>
                                                              Filter
                                                            </button>
                                                          </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <!-- <div class="form-row">
                                                      <button @click="resetFilter" class="btn btn-warning">Reset Pencarian</button>
                                                 </div> -->
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
                    <i class="icon wb-user"></i> Entri Izin Santri
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">
                  <div class="form-group">
                    <router-link :to="{ path: '/keamanan' }" class="btn btn-sm btn-info"><i class="icon wb-plus"></i>  Tambah Entri Izin</router-link>
                    <router-link :to="{ path: '/pemberitahuan' }" class="btn btn-sm btn-danger"><i class="icon wb-bell"></i>  Pemberitahuan <span class="badge bg-yellow-800 text-white">4</span></router-link>
                    <router-link :to="{ path: '/laporan/entri_izin' }" class="btn btn-sm btn-primary"><i class="icon wb-book"></i> Laporan Entri</router-link>
                  </div>
                  <table id="listEntriIzinTable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>NIS</th>
                        <th>Nama Santri</th>
                        <th>Tujuan</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Kategori</th>
                        <th>Tanggal Izin</th>
                        <!-- <th>Aksi</th> -->
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
  import Select2 from 'v-select2-component';
    export default {
    components: {
      Datepicker,
      Select2
    },

        mounted() {
    			this.getKeamananDatatables();
    			this.getDewanKyai();
        },

        data(){
            return {
                errors: [],
                errorsJenis: [],
                santris: [],
                dewankyais: [],
                filter: {
                	id: '',
                	nis: '',
                	nama_santri: ''
                },
                entri: {
                	santri_id: '',
                	kategori: '',
                	alasan: '',
                	status: '',
                	pemberi_izin: ''
                },
                resultsearch: '',
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

            getIdSantri(id){
            	axios.get('/sekretariat/santri/'+ id +'/show').then(response => {
            		this.entri.santri_id = response.data.id;
            		this.filter.nis = response.data.nis;
            		this.filter.nama_santri = response.data.nama_santri;
            	});
            },

            getDewanKyai(){
            	axios.get('/sekretariat/dewankyai/getDewanKyaiJSON').then(response => {
            		this.dewankyais = response.data;
            	});
            },

            getKeamananDatatables(){
            	$(function(){
            		var table = $('#listEntriIzinTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		                url: "/keamanan/getListSantriIzinDataTables",
		                data:function(e){
                      e.start_date = $('input[name="start_date"]').val();
		                  e.end_date = $('input[name="end_date"]').val();
		                }
		              },
		              columns: [
		                  { data: 'santri.nis', name: 'santri.nis' },
		                  { data: 'santri.nama_santri', name: 'santri.nama_santri' },
                      { data: 'tujuan', name: 'tujuan' },
		                  { data: 'alasan', name: 'alasan' },
                      { data: 'status', name: 'status'},
		                  { data: 'kategori', name: 'kategori'},
		                  { data: 'created_at', name: 'created_at'}
		                  // { data: 'action', name: 'action'},
		              ]
		          }); 

			         // Auto reload when getting result 
  			        $('#filter_trigger').on('click', function(e) {
  			            table.draw();
  			            e.preventDefault();
  			        });

            	});
    		},

            filterSantriForEntriIzin(){
        		axios.get('/keamanan/listSantriIzinWithFilter', { params: { nis: this.filter.nis, nama_santri: this.filter.nama_santri } }).then(response => {
        			this.santris = response.data;
            		this.resultsearch = response.data.available;
            		console.log(this.resultsearch);
            	}).catch((error) => {
            		this.errors = error.response.data.errors
            		setTimeout(() => {
            			this.errors = false;
            		}, 4000)
            	})
            },

            resetFilter(){
                this.filter.nis = '';
                this.filter.nama_santri = '';
            },

            dismissModal(){
            	$(function(){

					  // $("#exampleNifty3dSlit").removeClass("in");
					  $(".modal-backdrop").remove();
					  // $('body').removeClass('modal-open');
					  // $('body').css('padding-right', '');
					  $("#exampleNifty3dSlit").hide();
				})
            },

            storeentriizin:function(e){
                let app = this;
                var body = app.entri;
                // console.log(body);
                axios.post('/keamanan/store', body)
                .then(response => {
                  app.errors = [];
                  app.messageSuccess = response.data.response;
                  app.messageAlert = response.data.response;
                  app.entri = null;
                  app.dismissModal();
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
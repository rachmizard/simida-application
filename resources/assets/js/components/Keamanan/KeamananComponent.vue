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
                                          <h4 class="example-title"><i class="icon wb-search text-success"></i> Cari Santri</h4>
                                              <div class="example">
                                                  <div class="form-row">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName">Cari berdasarkan NIS</label>
                                                            <input v-if="filter.nama_santri" disabled @change="filterSantriForEntriIzin()" type="text" v-model="filter.nis" class="form-control" placeholder="NIS Santri, Contoh : 293000022332">
                                                            <input v-if="!filter.nama_santri" @change="filterSantriForEntriIzin()" type="text" v-model="filter.nis" class="form-control" placeholder="NIS Santri, Contoh : 293000022332">
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName">Cari berdasarkan Nama Santri</label>
                                                            <input v-if="filter.nis" disabled @change="filterSantriForEntriIzin()" type="text" v-model="filter.nama_santri" class="form-control" placeholder="Nama Santri, Contoh : Rifqi Subagja">
                                                            <input v-if="!filter.nis" @change="filterSantriForEntriIzin()" type="text" v-model="filter.nama_santri" class="form-control" placeholder="Nama Santri, Contoh : Rifqi Subagja">
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
                    <i class="icon wb-payment"></i> Sekilas Entri Izin 
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">

                  <table id="keamananTable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>NIS</th>
                        <th>Nama Santri</th>
                        <th>Tujuan & Alasan</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Jam Izin</th>
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
            <div v-if="santris" class="col-md-12">

                  <!-- Modal -->
                  <div class="modal fade modal-3d-slit" id="exampleNifty3dSlit" data-backdrop="static" data-keyboard="false" aria-hidden="true"
                    aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-simple">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title">Tambah Entri Izin</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row row-lg">
				            <div class="col-lg-12">
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
				                                          <!-- <h4 class="example-title"><i class="icon wb-plus text-success"></i> Cari Santri</h4> -->
				                                              <div class="example">
				                                                  <div class="form-row">
				                                                    <div class="row">
				                                                      <div class="col-md-12">
				                                                          <div class="form-group">
				                                                            <label class="form-control-label" for="inputBasicFirstName">ID</label>
				                                                            <input @change="filterSantriForEntriIzin()" type="text" v-model="entri.santri_id" class="form-control"disabled>
				                                                          </div>
				                                                      </div>
				                                                      <div class="col-md-12">
				                                                          <div class="form-group">
				                                                            <label class="form-control-label" for="inputBasicFirstName">NIS</label>
				                                                            <input @change="filterSantriForEntriIzin()" type="text" v-model="filter.nis" class="form-control" disabled>
				                                                          </div>
				                                                      </div>
				                                                      <div class="col-md-12">
				                                                          <div class="form-group">
				                                                            <label class="form-control-label" for="inputBasicFirstName">Nama Santri</label>
				                                                            <input @change="filterSantriForEntriIzin()" type="text" v-model="filter.nama_santri" class="form-control" disabled placeholder="NIS Santri, Contoh : 293000022332">
				                                                          </div>
				                                                      </div>
				                                                      <div class="col-md-12">
				                                                          <div class="form-group">
				                                                            <label class="form-control-label" for="inputBasicFirstName">Kategori Izin</label>
				                                                            <select v-model="entri.kategori" class="form-control">
				                                                            	<option value="">Pilih Kategori Izin</option>
				                                                            	<option value="jauh">Jauh</option>
				                                                            	<option value="dekat">Dekat</option>
				                                                            </select>
				                                                          </div>
				                                                      </div>
				                                                      <div class="col-md-12">
				                                                          <div class="form-group">
				                                                            <label class="form-control-label" for="inputBasicFirstName">Tujuan</label>
				                                                            <input @change="filterSantriForEntriIzin()" type="text" v-model="entri.tujuan" class="form-control" placeholder="Contoh: Ke pasar">
				                                                          </div>
				                                                      </div>
				                                                      <div class="col-md-12">
				                                                          <div class="form-group">
				                                                            <label class="form-control-label" for="inputBasicFirstName">Alasan</label>
				                                                            <input @change="filterSantriForEntriIzin()" type="text" v-model="entri.alasan" class="form-control" placeholder="Contoh: Belanja">
				                                                          </div>
				                                                      </div>
				                                                      <div v-if="entri.kategori == 'jauh'" class="col-md-12">
				                                                          <div class="form-group">
				                                                            <label class="form-control-label" for="inputBasicFirstName">Dewan Kyai yang mengizinkan</label>
				                                                            <select v-model="entri.pemberi_izin" class="form-control">
				                                                            	<option value="">Pilih Dewan Kyai</option>
				                                                            	<option v-for="dewankyai in dewankyais.data" :value="dewankyai.nama_dewan_kyai">{{ dewankyai.nama_dewan_kyai }}</option>
				                                                            </select>
				                                                            <span class="badge bg-blue-600 text-white">Perhatian: Jika kategori izin jauh, harus melakukan persetujuan terlebih dahulu dari Dewan Kyai.</span>
				                                                          </div>
				                                                      </div>
				                                                    </div>
				                                                  </div>
				                                                  <div class="form-row">
				                                                      <button @click="storeentriizin()" class="btn btn-success">Simpan</button>
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
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" @click="dismissModal()">Tutup</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal -->

              <!-- Panel Kitchen Sink -->
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">
                    <i class="icon wb-search"></i> Hasil Pencarian 
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">

                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>NIS</th>
                        <th>Nama Santri</th>
                        <th>Kelas</th>
                        <th>Asrama</th>
                        <th>Aksi</th>
                        <!-- <th>Aksi</th> -->
                      </tr>
                    </thead>
                    <tbody>
						<tr v-if="santris" v-for="santri in santris.data">
							<td>{{ santri.nis }}</td>
							<td>{{ santri.nama_santri }}</td>
							<td>{{ santri.kelas.nama_kelas }}</td>
							<td>{{ santri.asrama_id }}</td>
							<td>
								<button @click="getIdSantri(santri.id)" class="btn btn-xs btn-success" data-target="#exampleNifty3dSlit" data-toggle="modal"><i class="icon wb-plus"></i> Entri Izin</button>
							</td>
						</tr>
						<tr v-if="resultsearch == false">
							<td class="text-center" colspan="5">
								<i class="icon wb-search"></i> Hasil tidak ditemukan.
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
            		var table = $('#keamananTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		                url: "/keamanan/getListSantriIzinDataTables",
		                data:function(e){
		                  e.kategori_asrama = $('select[name="kategori_asrama"]').val();
		                }
		              },
		              columns: [
		                  { data: 'id', name: 'id' },
		                  { data: 'santri.nis', name: 'santri.nis', orderable: false },
		                  { data: 'santri.nama_santri', name: 'santri.nama_santri' },
		                  { data: 'tujuan', name: 'tujuan' },
		                  { data: 'status', name: 'status'},
		                  { data: 'created_at', name: 'created_at'}
		                  // { data: 'action', name: 'action'},
		              ]
		          }); 

			         // Auto reload when getting result 
			        $('#kategori_asrama').on('change', function(e) {
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
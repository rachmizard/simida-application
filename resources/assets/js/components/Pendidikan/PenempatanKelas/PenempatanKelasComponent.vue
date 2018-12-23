<template>
    <div id="app">
    	<!-- Modal -->
      <div class="modal fade modal-3d-slit" id="exampleNifty3dSlit" data-backdrop="static" data-keyboard="false" aria-hidden="true"
        aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title">Pilih Kelas & Tingkat</h4>
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
	                                                      <div class="col-md-6">
	                                                          <div class="form-group">
	                                                            <label class="form-control-label" for="inputBasicFirstName">Kelas</label>
	                                                            <select v-model="penempatankelas.kelas_id" class="form-control">
	                                                            	<option value="">Pilih Kelas</option>
	                                                            </select>
	                                                          </div>
                                            					<span v-if="errors.kelas_id" class="badge badge-danger">{{ errors.kelas_id[0] }}</span>
	                                                      </div>
	                                                      <div class="col-md-6">
	                                                          <div class="form-group">
	                                                            <label class="form-control-label" for="inputBasicFirstName">Tingkat Kelas</label>
	                                                            <select v-model="penempatankelas.tingkat_id" class="form-control">
	                                                            	<option value="">Tingkat Kelas</option>
	                                                            </select>
                                            					<span v-if="errors.tingkat_id" class="badge badge-danger">{{ errors.tingkat_id[0] }}
                                            					</span>
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
              <button type="button" data-dismiss="modal" @click="dismissModal()" aria-label="Close" class="btn btn-warning text-white">Tutup</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal -->
      <div class="row row-lg">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-12">
              <!-- Panel Kitchen Sink -->
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">
                    <i class="icon wb-random"></i> Penempatan Kelas
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">
                  <div class="form-group">
                    <button v-if="penempatankelas.santri_id.length != 0" class="btn btn-sm btn-info" data-target="#exampleNifty3dSlit" data-toggle="modal"><i class="icon wb-plus"></i> Pilih Kelas</button>
                  </div>
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>
                			<div class="checkbox-custom checkbox-default">
			                  <input type="checkbox" id="inputUnchecked" checked disabled />
			                  <label for="inputUnchecked"></label>
			                </div>
                        </th>
                        <th>NIS</th>
                        <th>Nama Santri</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<tr v-if="!santris">
                    		<td colspan="8">
                    			Tidak ada data santri yang tersedia untuk ditempatkan!
                    		</td>
                    	</tr>
                    	<tr v-if="santris.length != 0" v-for="santri in santris.data">
                    		<td>
                    			<div class="checkbox-custom checkbox-success">
				                  <input type="checkbox" v-model="penempatankelas.santri_id" :value="santri.id" id="inputUnchecked" />
				                  <label for="inputUnchecked"></label>
				                </div>
							</td>
                    		<td>{{ santri.nis }}</td>
                    		<td>{{ santri.nama_santri }}</td>
                    		<td>{{ santri.tgl_masuk }}</td>
                    		<td>
                    			<span v-if="santri.status == 'tidak_aktif'" class="badge badge-sm badge-danger">Belum memiliki kelas & tingkat</span>
                    			<span v-if="santri.status == 'aktif'" class="badge badge-sm badge-success">Aktif</span>
                    		</td>
                    		<td>{{ santri.alamat }}</td>
                    		<td>
                    			<router-link :to="{ path: '/konfirmasipenempatan/'+ santri.id }" class="btn btn-xs btn-info"><i class="icon wb-random"></i></router-link>
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
        	this.fetchSantri();
        },

        data(){
            return {
                errors: [],
                santris: [],
                penempatankelas: {
                	santri_id: [],
                	kelas_id: '',
                	tingkat_id: ''
                },
                messageSuccess: '',
                messageAlert: ''
            }
        },

        methods: {
            fetchSantri(){
            	axios.get('/pendidikan/penempatankelas/listSantri').then(response => {
            		this.santris = response.data;
            	});
            },

            dismissModal(){
            	$(function(){
					  // $("#exampleNifty3dSlit").removeClass("in");
					  $(".modal-backdrop").remove();
					  // $('body').removeClass('modal-open');
					  // $('body').css('padding-right', '');
					  $("#exampleNifty3dSlit").hide();
      			})
            }
        },

    }
</script>
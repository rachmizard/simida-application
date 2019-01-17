<template>
	
    <div id="app">
      <div class="page-header">
          <h1 class="page-title">Keamanan</h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">Keamanan</a></li>
              <li class="breadcrumb-item active">Detail Entri</li>
          </ol>
      </div>
      <div class="row row-lg">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-4">
              <div class="panel">
                  <div class="panel col-md-12">
                      <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                          <div class="form-row">
                              <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                  <h4 class="example-title"><i class="icon wb-user text-success"></i> Santri</h4>
                                      <div class="example">
                                          <div class="form-row">
                                            <div class="row">
                                              <div class="col-md-12">
                                                  <div class="form-group">
                                                    <label class="form-control-label" for="inputBasicFirstName">Nama Santri</label>
                                                    <input readonly type="text" class="form-control" :value="santri.nama_santri">
                                                  </div>
                                                  <div class="form-group">
                                                  	<label class="form-control-label" for="inputBasicFirstName">Kelas</label>
                                                    <input readonly type="text" class="form-control" :value="santri.kelas.nama_kelas">
                                                  </div>
                                                  <div class="form-group">
                                                  	<label class="form-control-label" for="inputBasicFirstName">Asrama</label>
                                                    <input readonly type="text" class="form-control" :value="santri.asrama.ngaran.nama">
                                                  </div>
                                                  <div class="form-group">
                                                  	<label class="form-control-label" for="inputBasicFirstName">Kamar</label>
                                                    <input readonly type="text" class="form-control" :value="santri.kobong.nama_kobong">
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                                      </div><!--/Example-->
                              </div><!--/.form-group
                              =========================-->
                          </div><!--/.form-row-->
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-md-8">
              <!-- Panel Kitchen Sink -->
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">
                    <i class="icon wb-search"></i> Track Izin Santri 
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
                        <th>Kategori Izin</th>
                        <th>Tanggal Izin</th>
                        <th>Tanggal Berakhir Izin</th>
                        <th>Status</th>
                        <!-- <th>Aksi</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    	<tr v-for="detail in details">
                    		<td>{{ detail.santri.nis }}</td>
                    		<td>{{ detail.santri.nama_santri }}</td>
                    		<td>{{ detail.kategori }}</td>
                    		<td>{{ detail.created_at }}</td>
                    		<td>{{ detail.tgl_berakhir_izin }}</td>
                    		<td>
                    			<span v-if="detail.status == 'sudah_kembali'" class="badge badge-success">Kembali</span>
                    			<span v-if="detail.status == 'belum_kembali'" class="badge badge-danger">Belum Kembali</span>
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
	export default {
		data(){
			return {
				id_santri: this.$route.params.id,
				id_keamanan : this.$route.params.keamanan_id,
				santri: [],
				details: [],
			}
		},

		mounted(){
		  this.getSantri();
		  this.getDetailEntri();
		},

		methods: {
			getDetailEntri(){
				var keamanan_id = this.id_keamanan;
				axios.get('/keamanan/'+ keamanan_id +'/historyByKeamananId').then(response => {
					this.details = response.data;
					console.log(response.data);
				});
			},

			getSantri(){
				var santri_id = this.id_santri;
				axios.get('/keamanan/'+ santri_id +'/getSantri').then(response => {
					this.santri = response.data;
					// console.log(response.data);
				});
			}
		}
	}
</script>

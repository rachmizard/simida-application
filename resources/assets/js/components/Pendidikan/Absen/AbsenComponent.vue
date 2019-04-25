<template>
	<div id="app">
		<div class="row">	
			<div class="col-md-4">
		      <div class="panel">
		        <header class="panel-heading">
		          <h3 class="panel-title"><i class="icon wb-search"></i> Filter</h3>
		        </header>
		        <div class="panel-body">
		          <div class="form-group col-md-12">
		            <label for="">Tanggal</label>
                    <!-- <datepicker :bootstrap-styling="true" required="" placeholder="Tgl Absensi" v-model="filter.created_at" :format="customFormatter"></datepicker> -->
                    <input class="form-control" type="date" v-model="filter.created_at" placeholder="Tanggal Absensi" autocomplete="off">
		          </div>
		          <div class="form-group col-md-12">
		            <label for="">Kategori Asrama (Putra/Putri) </label>
		            <select class="form-control" v-model="filter.kategori_asrama" @change="showNamaAsrama()">
		            	<option value="putra">Putra</option>
		            	<option value="putri">Putri</option>
		            </select>
		          </div>
		          <div class="form-group col-md-12">
		            <label for="">Nama Asrama </label>
		            <select class="form-control" v-model="filter.asrama_id">
		            	<option v-for="asrama in asramas.data" :value="asrama.id">{{ asrama.ngaran.nama }}</option>
		            </select>
		          </div>
		          <div class="form-group col-md-12">
		            <label for=""></label>
		            <select name="filter_kegiatan" id="filter_kegiatan" class="form-control" v-model="filter.kegiatan_id">
		            	<option value="" selected disabled>Kegiatan</option>
		            	<option v-for="kegiatan in kegiatans.data" :value="kegiatan.id">{{ kegiatan.nama_kegiatan }}</option>
		            </select>
		          </div>
		          <div class="form-group col-md-12">
		            <button class="btn btn-sm btn-primary" @click="filterSantri"><i class="icon wb-search"></i> Filter</button>
		          </div>
		        </div>
		      </div>
			</div>
			<div class="col-md-8">
		      <div class="panel">
		        <header class="panel-heading">
		          <h3 class="panel-title"><i class="icon wb-book"></i> Data Absen</h3>

                <div v-if="message" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <i class="icon wb-check" aria-hidden="true"></i> {{ message }}</a>
                </div>
		        </header>
		        <div class="panel-body table-responsive">
		          <table class="table table-hover table-bordered dataTable table-striped w-full" id="santriTable">
		            <thead>
		              <tr>
		                <th width="5%">NIS</th>
		                <th width="20%">Nama Santri</th>
		                <!-- <th width="20%">Kelas</th> -->
		                <th width="20%">Kegiatan</th>
		                <th width="20%">Keterangan</th>
		                <th width="20%">Aksi Absen</th>
		              </tr>
		            </thead>
		            <tbody>
		            	<tr v-if="santris.data.length > 0" v-for="santri in santris.data">
		            		<td>{{ santri.nis }}</td>
		            		<td>{{ santri.nama_santri }}</td>
		            		<!-- <td>{{ santri.kelas.nama_kelas }}</td> -->
		            		<td>{{ santri.kegiatan.nama_kegiatan }}</td>
		            		<td v-if="santri.keterangan">
		            			<span v-if="santri.keterangan.keterangan == 'hadir'" class="badge badge-sm badge-success">Hadir</span>
		            			<span v-if="santri.keterangan.keterangan == 'izin'" class="badge badge-sm badge-warning">Izin</span>
		            			<span v-if="santri.keterangan.keterangan == 'alfa'" class="badge badge-sm badge-danger">Alfa</span>
		            		</td>
		            		<td v-else><span class="badge badge-sm badge-dark">Belum absen</span></td>
		            		<td v-if="santri.action == 'sudah'">
			                    <div class="btn-group text-center">
			                    	<button class="btn btn-xs btn-danger" @click="batalAbsen(santri.keterangan.id)" title="Batal Absen"><i class="icon wb-trash"></i></button>
			                    </div>
                			</td>
		            		<td v-else-if="santri.action == 'belum'">
			                    <div class="btn-group text-center">
			                        <button @click="absenHadir(santri.id)" class="btn btn-xs btn-info text-white">Hadir</button>
			                        <button @click="absenIzin(santri.id)" class="btn btn-xs btn-warning text-white">Izin</button>
			                        <button @click="absenAlfa(santri.id)" class="btn btn-xs btn-danger text-white">Alfa</button>
			                    </div>
                			</td>
		            	</tr>
		            	<tr v-else-if="!santri.data.length > 0">
		            		<td colspan="10">
		            			<div class="text-center">
		            				<span><i class="icon wb-search"></i> Filter terlebih dahulu untuk mencari data</span>
		            			</div>
		            		</td>
		            	</tr>
		            </tbody>
		          </table>
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
		mounted(){
		this.function()
		},

		data(){
			return {
				kelass: [],
				kegiatans: [],
				santris: [],
				asramas: [],
				filter: {
					created_at: '',
					kegiatan_id: '',
					kategori_asrama: '',
					asrama_id: ''
				},
				message: ''
			}
		},

		methods: {

			showNamaAsrama(){
				axios.get('/sekretariat/asrama/getAsrama/'+ this.filter.kategori_asrama +'/kategori').then(response => {
					this.asramas = response.data;
					console.log(this.asramas);
				})
			},

			customFormatter(date) {
			      // return moment(date).format('Do MMMM YYYY');
			      return moment(date).format('d-m-Y');
			},

			function(){
				axios.get('/sekretariat/kelas/JSON').then(response => {
					this.kelass = response.data;
				})

				axios.get('/pendidikan/kegiatan/JSON').then(response => {
					this.kegiatans = response.data;
				})

				// axios.get('/pendidikan/absen/getSantriDataTables', {params: { filter: this.filter } }).then(response => {
				// 	this.santris = response.data;
				// })
			},

			filterSantri(){
				axios.get('/pendidikan/absen/getSantriDataTables?asrama_id='+ this.filter.asrama_id +'&kegiatan_id='+ this.filter.kegiatan_id +'&created_at='+ this.filter.created_at).then(response => {
					this.santris = response.data;
				});
				console.log(this.santris)
			},

			absenHadir(var1){
				let app = this;
				var bodyOfPresence = {
					kegiatan_id: app.filter.kegiatan_id,
					santri_id: var1,
					keterangan: 'hadir',
					created_at: moment(app.filter.created_at, 'DD/MM/YYYY').format('YYYY-MM-DD')
				}

				// console.log(bodyOfPresence)
				axios.post('/pendidikan/absen/store', bodyOfPresence).then(response => {
					// app.message = response.data.response.message;
					// setTimeout(() => {
					// 	app.message = '';
					// }, 5000);
					app.filterSantri();
				})
			},

			absenIzin(var1){
				let app = this;
				var bodyOfPresence = {
					kegiatan_id: app.filter.kegiatan_id,
					santri_id: var1,
					keterangan: 'izin',
					created_at: moment(app.filter.created_at, 'DD/MM/YYYY').format('YYYY-MM-DD')
				}

				// console.log(bodyOfPresence)
				axios.post('/pendidikan/absen/store', bodyOfPresence).then(response => {
					// app.message = response.data.response.message;
					// setTimeout(() => {
					// 	app.message = '';
					// }, 5000);
					app.filterSantri();
				})
			},


			absenAlfa(var1){
				let app = this;
				var bodyOfPresence = {
					kegiatan_id: app.filter.kegiatan_id,
					santri_id: var1,
					keterangan: 'alfa',
					created_at: moment(app.filter.created_at, 'DD/MM/YYYY').format('YYYY-MM-DD')
				}

				// console.log(bodyOfPresence)
				axios.post('/pendidikan/absen/store', bodyOfPresence).then(response => {
					// app.message = response.data.response.message;
					// setTimeout(() => {
					// 	app.message = '';
					// }, 5000);
					app.filterSantri();
				})
			},

			batalAbsen(var1){
				var id = var1;
				axios.delete('/pendidikan/absen/'+ id +'/destroy').then(response => {
					this.filterSantri();
				})
			}
		}
	}
</script>
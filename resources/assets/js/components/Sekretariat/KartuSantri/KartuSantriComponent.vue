<template>
	<div id="app">
		<div class="panel">
			<header class="panel-heading">
				<h3 class="panel-title"><i class="icon wb-search"></i> Filter Kartu Santri</h3>
			</header>
			<div class="panel-body">
				<div class="row">
		          	<div class="col-md-12">
			          <div class="form-group" style="margin-left: 15px;">
			            <label for="">Cari Berdasarkan Kelas</label>
                        <!-- <Select2 v-model="filter.filter_kelas" :options="kelass">
                        </Select2> -->
                        <select v-model="filter.filter_kelas" @change="getSantri()" class="form-control" style="width: 100%;">
                        	<option disabled="" selected="">Pilih Kelas</option>
                        	<option v-for="(kelas, index) in kelass.data" :value="kelas.id">{{ kelas.text }}</option>
                        </select>
			          </div>
		          	</div>
		          	<!-- <div class="col-md-4">
			          <div class="form-group" style="margin-left: 15px;">
			            <label for="">Cari Berdasarkan Asrama</label> -->
			            <!-- <Select2 name="filter_asrama" id="filter_asrama" :options="asramas" v-on-change="getAsrama(asrama.id)" v-model="asrama.id"/> -->
                        <!-- <select v-model="filter.filter_asrama" class="selectTo">
                        	<option disabled="" selected="">Pilih Asrama</option>
                        	<option v-for="(kelas, index) in kelass.data" :value="kelas.id">{{ kelas.text }}</option>
                        </select>
			          </div>
		          	</div> -->
		      	  </div>
			</div>
		</div>
		<div class="col-12">
	          <!-- Example Card Columns -->
	          <div class="example-wrap">
	            <h4 class="example-title">Hasil menampilkan kelas </h4>
	            <div class="card-columns">
	            	<div class="row">
	            		<div v-for="(santri, index) in santris" class="col-lg-12">
			            	<div class="card">
				              <img v-if="santri.foto == null" class="card-img-top img-fluid" :src="'/img/avatar_default.jpg'"
				                alt="">
			                  <img v-if="santri.foto != null" class="card-img-top img-fluid" :src="'/storage/santri_pic/'+ santri.foto"
			                alt="">
				              <div class="card-block">
				                <h4 class="card-title">{{ santri.nama_santri }}</h4>
				              </div>
				              <ul class="list-group list-group-dividered px-20 mb-0">
				                <li class="list-group-item px-0">{{ santri.nis }}</li>
				                <li class="list-group-item px-0">{{ santri.kelas.nama_kelas }}</li>
				                <li class="list-group-item px-0">{{  }}</li>
				              </ul>
				              <div class="card-block">
				                <a href="#" class="btn btn-sm btn-outline btn-info"><i class="icon wb-download"> Print</i></a>
				              </div>
				            </div>
	            		</div>
	            	</div>
	            </div>
	          </div>
	          <!-- End Example Card Columns -->
	    </div>
	</div>
</template>
<script>
	import Select2 from 'v-select2-component';
	export default {
		components: {
			Select2
		},

		data(){
			return {
				asramas: [],
				kelass: [],
				santris: [],
				filter: {
					filter_kelas: '',
					filter_asrama: ''
				}
			}
		},

		mounted(){
			this.getKelas();
			this.getAsrama();
			// this.getSantri();
		},

		methods: {
			getKelas(){
				axios.get('/sekretariat/kelas/KelasSelect2').then(response => {
					this.kelass = response.data;
				})
			},

			getAsrama(){
				axios.get('/sekretariat/asrama/get/allKategori').then(response => {
					this.asramas = response.data;
				})
			},

			getSantri(){
				this.santris = [];
				// console.log(this.filter.filter_kelas);
				axios.get('/sekretariat/santri/getSantriForKartu', { params: { filter_kelas: this.filter.filter_kelas } }).then(response => {
					this.santris = response.data;
					// console.log(response.data);
				})
			}
		}
	}
</script>
<template>
	<div id="app">
  	<div class="page-header">
		<h1 class="page-title">Input Nilai</h1>
		<ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="/">Home</a></li>
		    <li class="breadcrumb-item"><a href="#">Pendidikan</a></li>
		    <li class="breadcrumb-item active">Input Nilai</li>
		</ol>
    </div>
	<div class="panel">
		<div class="panel-body container-fluid" style="background-color: #fdfdfd;">
		    <div class="row row-lg">
		        <div class="col-md-12">
		        	 <h4 class="example-title"><i class="icon wb-search"></i> Filter Santri</h4>
					<p>Menampilkan Santri berdasarkan hasil pencarian. </p>
		            <form @submit.prevent="filterSantri" autocomplete="off">
			            <div class="form-row">
			                <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
			                    <div class="form-group">
			                        <div class="form-control-label col-2">Periode</div>
	                                <Select2 v-model="nilai.periode_id" :options="listPeriodes" placeholder="Pilih Periode">
	                                    <option disabled selected value="">Pilih Periode</option>
	                                </Select2>
	                                <span v-if="errors.periode_id" class="badge badge-danger">
	                                	{{ errors.periode_id[0] }}
	                                </span>
			                    </div><!--/.form-inline-->
			                    <div class="form-group">
			                        <div class="form-control-label col-2">Semester</div>
	                                <Select2 v-model="nilai.semester_id" :options="listSemesters" placeholder="Pilih Periode">
	                                    <option disabled selected value="">Pilih Periode</option>
	                                </Select2>
	                                <span v-if="errors.semester_id" class="badge badge-danger">
	                                	{{ errors.semester_id[0] }}
	                                </span>
			                    </div><!--/.form-inline-->
			                </div><!--/.form-group =========================-->
			                 <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
			                    <div class="form-group">
			                        <div class="form-control-label col-2">Tingkat</div>
			                        <Select2 @change="filterKelas" v-model="nilai.tingkat_id" :options="listTingkats">
			                        </Select2>
	                                <span v-if="errors.tingkat_id" class="badge badge-danger">
	                                	{{ errors.tingkat_id[0] }}
	                                </span>
			                    </div><!--/.form-inline-->
			                    <div class="form-group">    
			                        <div class="form-control-label col-2">Kelas</div>
			                        <Select2 v-model="nilai.kelas_id" :options="listKelass">
			                        </Select2>
	                                <span v-if="errors.kelas_id" class="badge badge-danger">
	                                	{{ errors.kelas_id[0] }}
	                                </span>
			                    </div><!--/.form-inline-->
			                    <div class="form-group">    
			                        <div class="form-control-label col-2"></div>
			                        <button type="submit" class="btn btn-sm btn-info col-md-12"><i class="icon wb-search"></i> Cari</button>
			                    </div><!--/.form-inline-->
			                </div><!--/.form-group =========================-->
			                
			             </div><!--/.form-row-->
		            </form>
		        </div><!--/.col-->
		    </div>
		</div><!--/.panel-body-->
		</div><!--/.panel -->

		<div class="panel">
			<div class="panel-body container-fluid" style="background-color: #fdfdfd;">
			    <div class="row row-lg">
			       <div class="col-md-12">
			           <h4 class="example-title"><i class="icon wb-user"></i> List Santri</h4>
			           <p v-if="listSantris.length != 0"><i class="icon wb-search"></i> Hasil Filter</p>
			            <table class="table table-striped table-hovered">
			                <thead>
			                    <tr>
			                        <th>NIS</th>
			                        <th>Nama Santri</th>
			                        <th>Kelas</th>
			                        <th>Status</th>
			                        <th></th>
			                    </tr>
			                </thead>
			                <tbody>
			                    <tr v-if="listSantris.length != 0" v-for="(listSantri, index) in listSantris">
			                        <td>{{ listSantri.nis }}</td>
			                        <td>{{ listSantri.nama_santri }}</td>
			                        <td>{{ listSantri.kelas }}</td>
			                        <td><span class="badge badge-primary">{{ listSantri.status_nilai }}</span></td>
			                        <td class="w-50">

			                        	<form v-if="listSantri.status_nilai != 'Sudah'" :action="'nilai/'+ listSantri.id +'/input_nilai'" method="POST">
			                        		<input type="hidden" :value="csrf_token" name="_token">
			                        		<input type="hidden" :value="nilai.periode_id" name="periode_id">
			                        		<input type="hidden" :value="listSantri.kelas_id" name="kelas_id">
			                        		<input type="hidden" :value="nilai.semester_id" name="semester_id">
				                            <button title="Input Nilai" class="btn btn-round btn-sm btn-outline btn-info mb-2">
				                                <i class="icon wb-plus" aria-hidden="true"></i>
				                            </button>
			                        	</form>

			                        	<form action="nilai/edit_nilai" method="GET">
			                        		<input type="hidden" :value="csrf_token" name="_token">
			                        		<input type="hidden" :value="listSantri.id" name="santri_id">
			                        		<input type="hidden" :value="nilai.periode_id" name="periode_id">
			                        		<input type="hidden" :value="listSantri.kelas_id" name="kelas_id">
			                        		<input type="hidden" :value="nilai.semester_id" name="semester_id">
				                            <button title="Edit Nilai" class="btn btn-round btn-sm btn-outline btn-warning mb-2">
			                                	<i class="icon wb-edit" aria-hidden="true"></i>
				                            </button>
			                        	</form>
			                        </td>
			                    </tr>
			                    <tr v-if="listSantris.length == 0">
			                    	<td colspan="10">
			                    		<div class="text-center">
			                    			<h4><i class="icon wb-search"></i> Pencarian santri belum ditentukan.</h4>
			                    		</div>
			                    	</td>
			                    </tr>
			                </tbody>
			            </table>   
			       </div><!--/.row-->
			   </div>
			</div><!--/.panel-body-->
		</div><!--/.panel -->
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
				csrf_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
				errors: [],
				nilai: {
					periode_id: '',
					semester_id: '',
					tingkat_id: '',
					kelas_id: ''
				},
				listPeriodes: [],
				listSantris: [],
				listKelass: [],
				listTingkats: [],
				listSemesters: []
			}
		},

		mounted(){
			this.getPeriodeForSelect2();
			this.getKelass();
			this.getTingkats();
			this.getSemesters();
			this.checkIfDataExist();
		},

		methods: {

			checkIfDataExist(){
				axios.get('/pendidikan/nilai/getSantri').then(response => {
					this.listSantris = response.data;
				})
			},

			getPeriodeForSelect2(){
				axios.get('/pendidikan/getPeriodeForSelect2').then(response => {
					this.listPeriodes = response.data.data;
				});
			},

			getKelass(){
			axios.get('/pendidikan/KelasSelect2').then(response => {
					this.listKelass = response.data.data;
				});
			},

			filterSantri(){
				axios.get('/pendidikan/nilai/getSantri', { params: { periode_id: this.nilai.periode_id, semester_id: this.nilai.semester_id, tingkat_id: this.nilai.tingkat_id, kelas_id: this.nilai.kelas_id  } }).then(response => {
						this.listSantris = response.data;
				}).catch((error) => {
					this.errors = error.response.data.errors;
				});
			},

			getTingkats(){
				axios.get('/pendidikan/TingkatanSelect2').then(response => {
					this.listTingkats = response.data.data;
				});
			},

			getSemesters(){
				axios.get('/pendidikan/semester/semesterSelect2').then(response => {
					this.listSemesters = response.data.data;
				})
			},

			filterKelas(){
				axios.get('/pendidikan/kelas/'+ this.nilai.tingkat_id +'/tingkat').then(response => {
					this.listKelass = response.data;
				});
			}
		}
	}
	
</script>
<template>
	<div id="app">
		<h1 class="page-title">Input Nilai</h1>
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Home</a></li>
	    <li class="breadcrumb-item"><a href="#">Pendidikan</a></li>
	    <li class="breadcrumb-item active">Input Nilai</li>
	</ol>
	<div class="panel">
		<div class="panel-body container-fluid" style="background-color: #fdfdfd;">
		    <div class="row row-lg">
		        <div class="col-md-12">
		            <form autocomplete="off">
		            <div class="form-row">
		                <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
		                    <div class="form-group">
		                        <div class="form-control-label col-2">Periode</div>
                                <Select2 v-model="nilai.periode_id" :options="listPeriodes" placeholder="Pilih Periode">
                                    <option disabled selected value="">Pilih Periode</option>
                                </Select2>
		                    </div><!--/.form-inline-->
		                    <div class="form-group">
		                        <div class="form-control-label col-2">Semester</div>
		                        <select class="form-control selectTo col" style="">
		                                <optgroup label="Semester">
		                                    <option value="">1</option>
		                                    <option value="">2</option>
		                                </optgroup>
		                                <option disabled selected></option>
		                        </select>
		                    </div><!--/.form-inline-->
		                </div><!--/.form-group =========================-->
		                 <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
		                    <div class="form-group">
		                        <div class="form-control-label col-2">Tingkat</div>
		                        <Select2 v-model="nilai.tingkat_id" :options="listTingkats">
		                        </Select2>
		                    </div><!--/.form-inline-->
		                    <div class="form-group">    
		                        <div class="form-control-label col-2">Kelas</div>
		                        <Select2 v-model="nilai.kelas_id" :options="listKelass">
		                        </Select2>
		                    </div><!--/.form-inline-->
		                    <div class="form-group">    
		                        <div class="form-control-label col-2"></div>
		                        <button class="btn btn-sm btn-info col-md-12"><i class="icon wb-search"></i> Cari</button>
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
		           <h4 class="example-title">List Data Santri</h4>
		           <p><i class="icon wb-search"></i> Hasil Filter</p>
		            <table class="table table-striped" data-toggle="table" data-height="400" data-mobile-responsive="true">
		                <thead>
		                    <tr>
		                        <th data-field="nis">NIS</th>
		                        <th data-field="nama">Nama Santri</th>
		                        <th data-field="kelas">Kelas</th>
		                        <th data-field="status">Status</th>
		                        <th data-field="action"></th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <tr>
		                        <td>1</td>
		                        <td>02564</td>
		                        <td>3E</td>
		                        <td>Suherman Saputra</td>
		                        <td><span class="badge badge-primary">Selesai</span></td>
		                        <td class="w-50">
		                            <button type="button" class="btn btn-outline btn-default mb-2">
		                                <i class="icon wb-plus" aria-hidden="true"></i> Input Nilai
		                            </button>
		                            <button type="button" class="btn btn-outline btn-default m-0">
		                                <i class="icon wb-edit" aria-hidden="true"></i> Edit Nilai
		                            </button>
		                        </td>
		                    </tr>
		                    <tr>
		                        <td>2</td>
		                        <td>03534</td>
		                        <td>3E</td>
		                        <td>Bambang Suherman</td>
		                        <td><span class="badge badge-danger">Belum</span></td>
		                        <td class="w-50">
		                            <button type="button" class="btn btn-outline btn-default mb-2">
		                                <i class="icon wb-plus" aria-hidden="true"></i> Input Nilai
		                            </button>
		                            <button type="button" class="btn btn-outline btn-default m-0">
		                                <i class="icon wb-edit" aria-hidden="true"></i> Edit Nilai
		                            </button>
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
				nilai: {
					periode_id: '',
					semester_id: '',
					tingkat_id: '',
					kelas_id: ''
				},
				listPeriodes: [],
				listSantris: [],
				listKelass: [],
				listTingkats: []
			}
		},

		mounted(){
			this.getPeriodeForSelect2();
			this.getKelass();
			this.getSantris();
			this.getTingkats();
		},

		methods: {
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

			getSantris(){
				axios.get('/pendidikan/getSantri').then(response => {

				});
			},

			getTingkats(){
				axios.get('/pendidikan/TingkatanSelect2').then(response => {
					this.listTingkats = response.data.data;
				});
			}
		}
	}
	
</script>
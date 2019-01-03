<template>
	<div id="app">
		<div class="panel">
		<div class="page-header">
			<h3 class="page-title"><i class="icon wb-book"></i> Mata Pelajaran</h3>
		    <ol class="breadcrumb">
		        <li class="breadcrumb-item"><a href="/">Home</a></li>
		        <li class="breadcrumb-item active"><a href="">Pendidikan</a></li>
		        <li class="breadcrumb-item active">Mata Pelajaran</li>
		    </ol>
		</div>
			<header class="panel-heading">
	          <h3 class="panel-title"></h3>
	          <div class="row">
	          	<!-- <div class="col-md-4">
		          <div class="form-group col-md-12" style="margin-left: 15px;">
		            <label for=""></label>
		            <select name="filter_kelas" id="filter_kelas" class="form-control">
		            	<option value="">Cari berdasarkan kelas</option>
		            	<option value="">Semua..</option>
		            	<option v-for="kelas in kelass.data" :value="kelas.nama_kelas">{{ kelas.nama_kelas }}</option>
		            </select>
		          </div>
	          	</div> -->
	          	<div class="col-md-4">
		          <div class="form-group col-md-12" style="margin-left: 15px;">
		            <label for=""></label>
		            <select name="filter_tingkat" id="filter_tingkat" class="form-control">
		            	<option value="">Cari berdasarkan tingkatnya</option>
		            	<option value="">Semua..</option>
		            	<option v-for="tingkat in tingkats.data" :value="tingkat.id">{{ tingkat.nama_tingkatan }}</option>
		            </select>
		          </div>
	          	</div>
	          	<div class="col-md-4" style="margin-top: 21px;">
            		<router-link to="/mata_pelajaran/tambah" class="btn btn-sm btn-info"><i class="icon wb-plus"></i> Tambah</router-link>
		            <a href="/pendidikan/matapelajaran/export" class="btn btn-info btn-sm"><i class="icon wb-download"></i> Export Ke Excel</a>	
	          	</div>
	      	   </div>
	        </header>
	        <div class="panel-body">
	          <table class="table table-hover table-bordered dataTable table-striped w-full" id="mapelTable">
	            <thead>
	              <tr>
	                <th width="5%">Kode Mata Pelajaran</th>
	                <th width="20%">Nama Mata Pelajaran</th>
	                <th width="20%">Tingkat</th>
	                <!-- <th width="10%">Kelas</th> -->
	                <th width="20%">Aksi</th>
	              </tr>
	            </thead>
	            <tbody>
	            </tbody>
	          </table>
	        </div>
		</div>
	</div>
</template>
<script>
	export default {
		mounted(){
			this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			this.function();
			$(function() {
		         var table = $('#mapelTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		                url: "/pendidikan/matapelajaran/getMataPelajaranDataTables",
		                data:function(e){
		                  // e.filter_kelas = $('select[name="filter_kelas"]').val();
		                  e.filter_tingkat = $('select[name="filter_tingkat"]').val();
		                }
		              },
		              columns: [
		                  { data: 'id', name: 'id' },
		                  { data: 'nama_mata_pelajaran', name: 'nama_mata_pelajaran', orderable: true },
		                  { data: 'tingkat.nama_tingkatan', name: 'tingkat.nama_tingkatan' },
		                  // { data: 'kelas.nama_kelas', name: 'kelas.nama_kelas'},
		                  { data: 'action', name: 'action', orderable: false, searchable: false }
		              ]
		          }); 

		         // Auto reload when getting result 
		        // $('#filter_kelas').on('change', function(e) {
		        //     table.draw();
		        //     e.preventDefault();
		        // });
		        $('#filter_tingkat').on('change', function(e) {
		            table.draw();
		            e.preventDefault();
		        });
		  });
		},

		data(){
			return {
				kelass: [],
				tingkats: [],
				token: ''
			}
		},

		methods: {
			function(){
				axios.get('/sekretariat/kelas/JSON').then(response => {
					this.kelass = response.data;
				})
				axios.get('/sekretariat/tingkatan/getJSON').then(response => {
					this.tingkats = response.data;
				})
			}
		}
	}
</script>
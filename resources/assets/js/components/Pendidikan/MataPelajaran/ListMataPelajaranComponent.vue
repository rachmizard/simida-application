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
	          	<div class="col-md-6">
		          <div class="form-group col-md-12" style="margin-left: 15px;">
		            <label for=""></label>
		            <select name="filter_kelas" id="filter_kelas" class="form-control">
		            	<option value="">Cari berdasarkan kelas</option>
		            	<option v-for="kelas in kelass.data" :value="kelas.nama_kelas">{{ kelas.nama_kelas }}</option>
		            </select>
		          </div>
		          <div class="form-group" style="margin-left: 15px;">
		            <router-link to="/mata_pelajaran/tambah" class="btn btn-xs btn-info"><i class="icon wb-plus"></i> Tambah</router-link>
		          </div>
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
	                <th width="10%">Kelas</th>
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
			this.function();
			$(function() {
		         var table = $('#mapelTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		                url: "/pendidikan/matapelajaran/getMataPelajaranDataTables"
		                // data:function(e){
		                //   e.filter_kelas = $('select[name="filter_kelas"]').val();
		                //   e.filter_nis = $('input[name="filter_nis"]').val();
		                // }
		              },
		              columns: [
		                  { data: 'nis', name: 'nis' },
		                  { data: 'nama_mata_pelajaran', name: 'nama_mata_pelajaran', orderable: true },
		                  { data: 'tingkat_id', name: 'tingkat_id' },
		                  { data: 'kelas_id', name: 'kelas_id'},
		                  { data: 'action', name: 'action', orderable: false, searchable: false }
		              ]
		          }); 

		         // Auto reload when getting result 
		        $('#filter_kelas').on('change', function(e) {
		            table.draw();
		            e.preventDefault();
		        });

		        $('#filter_nis').on('change', function(e) {
		            table.draw();
		            e.preventDefault();
		        });
		  });
		},

		data(){
			return {
				kelass: []
			}
		},

		methods: {
			function(){
				axios.get('/sekretariat/kelas/JSON').then(response => {
					this.kelass = response.data;
				})
			}
		}
	}
</script>
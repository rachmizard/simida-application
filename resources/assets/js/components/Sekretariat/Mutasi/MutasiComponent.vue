<template>
	<div id="app">
		<div class="panel">
		<div class="page-header">
			<h3 class="page-title"><i class="icon wb-home"></i> Perpindahan Asrama Santri</h3>
		    <ol class="breadcrumb">
		        <li class="breadcrumb-item"><a href="">Home</a></li>
		        <li class="breadcrumb-item active">Perpindahan Asrama Santri</li>
		    </ol>
		</div>
			<header class="panel-heading">
	          <h3 class="panel-title"></h3>
	          <div class="row">
	          	<div class="col-md-6">
		          <div class="form-group col-md-12" style="margin-left: 15px;">
		            <label for="">Filter Santri Berdasarkan Kelas</label>
			            <select name="filter_kelas" id="filter_kelas" class="form-control">
			            	<option value=""></option>
			            	<option v-for="kelas in kelass.data" :value="kelas.id">{{ kelas.nama_kelas }}</option>
			            </select>
		          </div>
	          	</div>
	          	<div class="col-md-6">
		          <div class="form-group col-md-12" style="margin-left: 15px;">
		            <label for="">Cari NIS</label>
			            <input type="text" name="filter_nis" id="filter_nis" class="form-control" placeholder="NIS..">
		          </div>
		      	</div>
	      		</div>
	        </header>
	        <div class="panel-body">
	          <table class="table table-hover table-bordered dataTable table-striped w-full" id="mutasiTable">
	            <thead>
	              <tr>
	                <th width="5%" class="bg-warning text-white">NIS</th>
	                <th width="20%" class="bg-warning text-white">Nama Santri</th>
	                <th width="20%" class="bg-warning text-white">Asrama Sekarang</th>
	                <th width="10%" class="bg-warning text-white">Kelas</th>
	                <th width="20%" class="bg-warning text-white">Aksi</th>
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
		         var table = $('#mutasiTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		                url: "/sekretariat/mutasi/getSantriDataTables",
		                data:function(e){
		                  e.filter_kelas = $('select[name="filter_kelas"]').val();
		                  e.filter_nis = $('input[name="filter_nis"]').val();
		                }
		              },
		              columns: [
		                  { data: 'nis', name: 'nis' },
		                  { data: 'nama_santri', name: 'nama_santri', orderable: true },
		                  { data: 'asrama.ngaran.nama', name: 'asrama.ngaran.nama' },
		                  { data: 'kelas.nama_kelas', name: 'kelas.nama_kelas'},
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
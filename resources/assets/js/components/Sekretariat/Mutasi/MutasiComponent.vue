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
	          <div class="form-group col-md-6" style="margin-left: 15px;">
	            <label for="">Filter Santri Berdasarkan Kelas</label>
	            <select name="filter_tingkat" id="filter_tingkat" class="form-control">
	            </select>
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
			$(function() {
		         var table = $('#mutasiTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		                url: "/sekretariat/mutasi/getSantriDataTables"
		                // data:function(e){
		                //   e.filter_tingkat = $('select[name="filter_tingkat"]').val();
		                // }
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
		        $('#filter_tingkat').on('change', function(e) {
		            table.draw();
		            e.preventDefault();
		        });
		  });
		},

		data(){
			return {

			}
		}
	}
</script>
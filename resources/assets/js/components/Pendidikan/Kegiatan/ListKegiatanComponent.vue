<template>
	<div id="app">
		<div class="panel">
		<div class="page-header">
			<h3 class="page-title"><i class="icon wb-time"></i> Jadwal Kegiatan</h3>
		    <ol class="breadcrumb">
		        <li class="breadcrumb-item"><a href="/">Home</a></li>
		        <li class="breadcrumb-item active"><a href="">Pendidikan</a></li>
		        <li class="breadcrumb-item active">Master Kegiatan</li>
		    </ol>
		</div>
			<header class="panel-heading">
	          <h3 class="panel-title"></h3>
	          <div class="row">
	          	<div class="col-md-8">
	          		
	          	</div>
	          	<div class="col-md-4" style="margin-bottom: 21px;">
		            <router-link to="/kegiatan/tambah" class="btn btn-sm btn-info"><i class="icon wb-plus"></i> Tambah</router-link>
		            <a href="/pendidikan/kegiatan/export" class="btn btn-info btn-sm"><i class="icon wb-download"></i> Export Ke Excel</a>
	          	</div>
	      	   </div>
	        </header>
	        <div class="panel-body">
	          <table class="table table-hover table-bordered dataTable table-striped w-full" id="kegiatanTable">
	            <thead>
	              <tr>
	                <th width="5%">ID Kegiatan</th>
	                <th width="20%">Nama Kegiatan</th>
	                <th width="20%">Jam Mulai</th>
	                <th width="10%">Jam Selesai</th>
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
		         var table = $('#kegiatanTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		                url: "/pendidikan/kegiatan/getKegiatanDataTables"
		                // data:function(e){
		                //   e.filter_kelas = $('select[name="filter_kelas"]').val();
		                //   e.filter_tingkat = $('select[name="filter_tingkat"]').val();
		                // }
		              },
		              columns: [
		                  { data: 'id', name: 'id' },
		                  { data: 'nama_kegiatan', name: 'nama_kegiatan', orderable: true },
		                  { data: 'mulai_kegiatan', name: 'mulai_kegiatan' },
		                  { data: 'akhir_kegiatan', name: 'akhir_kegiatan'},
		                  { data: 'action', name: 'action', orderable: false, searchable: false }
		              ]
		          }); 

		         // Auto reload when getting result 
		        $('#filter_kelas').on('change', function(e) {
		            table.draw();
		            e.preventDefault();
		        });

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
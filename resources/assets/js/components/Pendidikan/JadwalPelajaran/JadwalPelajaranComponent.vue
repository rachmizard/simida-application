<template>
	<div id="app">
		<div class="panel">
		<div class="page-header">
			<h3 class="page-title"><i class="icon wb-time"></i> Jadwal Pelajaran</h3>
		    <ol class="breadcrumb">
		        <li class="breadcrumb-item"><a href="/">Home</a></li>
		        <li class="breadcrumb-item active"><a href="">Pendidikan</a></li>
		        <li class="breadcrumb-item active">Jadwal Pelajaran</li>
		    </ol>
		</div>
			<header class="panel-heading">
	          <h3 class="panel-title"></h3>
	          <div class="row">
	          	<div class="col-md-5">
		          <div class="form-group col-md-12" style="margin-left: 15px;">
		            <label for=""></label>
		            <select name="filter_kelas" id="filter_kelas" class="form-control selectTo">
		            	<option value="">Cari berdasarkan kelas</option>
		            	<option value="">Semua..</option>
		            	<option v-for="kelas in kelass.data" :value="kelas.nama_kelas">{{ kelas.nama_kelas }}</option>
		            </select>
		          </div>
	          	</div>
	          	<div class="col-md-5">
		          <div class="form-group col-md-12" style="margin-left: 15px;">
		            <label for=""></label>
		            <select name="filter_tingkat" id="filter_tingkat" class="form-control selectTo">
		            	<option value="">Cari berdasarkan tingkatnya</option>
		            	<option value="">Semua..</option>
		            	<option v-for="tingkat in tingkats.data" :value="tingkat.nama_tingkatan">{{ tingkat.nama_tingkatan }}</option>
		            </select>
		          </div>
	          	</div>
	          	<div class="col-md-2" style="margin-top: 21px;">
		            <router-link to="/jadwalpelajaran/tambah" class="btn btn-sm btn-success"><i class="icon wb-plus"></i> Tambah Jadwal</router-link>
	          	</div>
	      	   </div>
	        </header>
	        <div class="panel-body">
	          <table class="table table-hover w-full table-responsive" id="jadwalPelTable">
	            <thead>
	              <tr>
	                <th width="20%">ID</th>
	                <th width="20%">Nama Kelas</th>
	                <th width="20%">Guru</th>
	                <th width="20%">Mata Pelajaran</th>
	                <th width="20%">Jam Masuk</th>
	                <th width="20%">Jam Keluar</th>
	                <th width="20%">Hari</th>
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
    import Select2 from 'v-select2-component';

	export default {
	  components: {
        Select2
	  },
		mounted(){
			this.function();
			$(function() {
				 var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		         var table = $('#jadwalPelTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		              	headers: {'X-CSRF-TOKEN': token},
		                url: "/pendidikan/jadwalpelajaran/getJadwal",
		                type: 'post',
		                dataType: 'JSON',
						data: {
							'_token': token
						},
		                data:function(e){
		                  e.filter_kelas = $('select[name="filter_kelas"]').val();
		                  e.filter_tingkat = $('select[name="filter_tingkat"]').val();
		                }
		              },
		              columns: [
		                  { data: 'id', name: 'id' },
		                  { data: 'kelas.nama_kelas', name: 'kelas.nama_kelas'},
		                  { data: 'guru.nama_guru', name: 'guru.nama_guru' },
		                  { data: 'matapelajaran.nama_mata_pelajaran', name: 'matapelajaran.nama_mata_pelajaran'},
		                  { data: 'jam_masuk', name: 'jam_masuk'},
		                  { data: 'jam_selesai', name: 'jam_selesai'},
		                  { data: 'hari', name: 'hari'},
		                  { data: 'aksi', name: 'aksi'}
		              ]
		          }); 

		         console.log(token);

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
<template>
<div id="app">
	<!-- Panel Table Tools -->
      <div class="panel">
        <header class="panel-heading">
			<div class="page-header">
			    <h1 class="page-title"><i class="icon wb-user-circle"></i> Data Santri Aktif</h1>
			    <ol class="breadcrumb">
			        <li class="breadcrumb-item"><a href="/">Home</a></li>
			        <li class="breadcrumb-item active">Data Santri Aktif</li>
			    </ol>
			</div>
          <h3 class="panel-title"></h3>
          <div class="row">
          	<div class="col-md-4">
	          <div class="form-group" style="margin-left: 15px;">
	            <label for="">Menampilkan Santri Berdasarkan Kelas</label>
	            <select name="filter_kelas" id="filter_kelas" class="form-control">
	            	<option value=""></option>
	            	<option v-for="kelas in kelass.data" :value="kelas.nama_kelas">{{ kelas.nama_kelas }}</option>
	            </select>
	          </div>
          	</div>
          	<div class="col-md-4">
	          <div class="form-group" style="margin-left: 15px;">
	            <label for=""><i class="icon wb-home"></i> Menampilkan Santri Berdasarkan Asrama</label>
	            <!-- <Select2 name="filter_asrama" id="filter_asrama" :options="asramas" v-on-change="getAsrama(asrama.id)" v-model="asrama.id"/> -->
	            <select name="filter_asrama" id="filter_asrama" class="form-control" data-plugin="select2" style="width: 100%;">
	            	<option value=""></option>
	            	<option v-for="asrama in asramas.data" :value="asrama.id">{{ asrama.text }}</option>
	            </select>
	          </div>
          	</div>
      	  </div>
        </header>
        <div class="panel-body table-responsive">
          <table class="table table-hover dataTable table-striped w-full" id="santriAktifTable">
            <thead>
              <tr>
                <th width="5%">NIS</th>
                <th width="20%">Nama Santri</th>
                <th width="20%">Nama Asrama</th>
                <th width="20%">Kelas</th>
                <th width="20%">Kamar</th>
                <th width="10%">Alamat</th>
                <th width="30%">Tgl Masuk</th>
                <!-- <th width="10%">Foto Santri</th> -->
                <th width="10%">Status</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->
</div>	
</template>
<script>
    import Select2 from 'v-select2-component';

	export default {
	  components: {
        Select2
	  },
		mounted(){
		this.function()

		$(function() {
				 var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		         var table = $('#santriAktifTable').DataTable({
                      "stateSave": true,
		              "processing": true,
		              "serverSide": true,
		              "ajax": {
		              	headers: {'X-CSRF-TOKEN': token},
		                type: 'POST',
		                dataType: 'JSON',
						data: {
							'_token': token
						},
		                url: "/sekretariat/santri/getSantriAktifDataTables",
		                data:function(e){
		                  e.filter_kelas = $('select[name="filter_kelas"]').val();
		                  e.filter_asrama = $('select[name="filter_asrama"]').val();
		                }
		              },
		              columns: [
		                  { data: 'nis', name: 'nis' },
		                  { data: 'nama_santri', name: 'nama_santri', orderable: true },
		                  { data: 'asrama.ngaran.nama', name: 'asrama.ngaran.nama' },
		                  { data: 'kelas.nama_kelas', name: 'kelas.nama_kelas'},
		                  { data: 'kobong.nama_kobong', name: 'kobong.nama_kobong'},
		                  { data: 'alamat', name: 'alamat'},
		                  { data: 'tgl_masuk', name: 'tgl_masuk'},
		                  // { data: 'foto', name: 'foto', orderable: false, searchable: false },
		                  { data: 'status', name: 'status' },
		                  { data: 'action', name: 'action', orderable: false, searchable: false }
		              ]
		          }); 

		         // Auto reload when getting result 
		        $('#filter_kelas').on('change', function(e) {
		            table.draw();
		            e.preventDefault();
		        });


		         // Auto reload when getting result 
		        $('#filter_asrama').on('change', function(e) {
		            table.draw();
		            e.preventDefault();
		        });

		        // Trigger auto refresh
		        Echo.channel('draw-table')
		        .listen('DrawTable', (e) => {
		          table.draw();
		        });
		  });   
		},

		data(){
			return {
				kelass: [],
				asramas: [],
				asrama: {
					id: ''
				}
			}
		},

		methods: {
			function(){
				axios.get('/sekretariat/kelas/JSON').then(response => {
					this.kelass = response.data;
				})

				axios.get('/sekretariat/asrama/AsramaSelect2').then(response => {
					this.asramas = response.data;
				});
			}
		}
	}
</script>
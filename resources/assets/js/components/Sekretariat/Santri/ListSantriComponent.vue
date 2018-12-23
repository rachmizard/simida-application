<template>
	<!-- Panel Table Tools -->
      <div class="panel" id="app">
        <header class="panel-heading">
          <h3 class="panel-title"></h3>
          <div class="row">
          	<div class="col-md-4">
	          <div class="form-group" style="margin-left: 15px;">
	            <select name="filter_kelas" id="filter_kelas" class="form-control">
	            	<option value="">Pilih Kelas Untuk Menampilkan Data</option>
	            	<option v-for="kelas in kelass.data" :value="kelas.nama_kelas">{{ kelas.nama_kelas }}</option>
	            </select>
	          </div>
          	</div>
          	<div class="col-md-4">
          		<form action="/sekretariat/santri/export" method="POST">
          			<input type="hidden" :value="token" name="_token" class="form-control">
          			<button type="submit" class="btn btn-sm btn-info"><i class="icon wb-download"></i> Export Santri Ke Excel</button>
          		</form>
          	</div>
          </div>
        </header>
        <div class="panel-body table-responsive">
          <table class="table table-hover table-bordered dataTable table-striped w-full" id="santriTable">
            <thead>
              <tr>
                <th width="5%">NIS</th>
                <th width="20%">Nama Santri</th>
                <th width="20%">Nama Asrama</th>
                <th width="10%">Kelas</th>
                <th width="10%">Alamat</th>
                <th width="10%">Tanggal Masuk</th>
                <th width="10%">Foto Santri</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->
</template>
<script>
	export default {
		mounted(){
		this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		this.function()
		$(function() {
				 var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		         var table = $('#santriTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		                url: "/sekretariat/santri/getSantriDataTables",
		                headers: {'X-CSRF-TOKEN': token},
		                type: 'post',
		                dataType: 'JSON',
						data: {
							'_token': token
						},
		                data:function(e){
		                  e.filter_kelas = $('select[name="filter_kelas"]').val();
		                }
		              },
		              columns: [
		                  { data: 'nis', name: 'nis' },
		                  { data: 'nama_santri', name: 'nama_santri', orderable: true },
		                  { data: 'asrama.ngaran.nama', name: 'asrama.ngaran.nama' },
		                  { data: 'kelas.nama_kelas', name: 'kelas.nama_kelas'},
		                  { data: 'alamat', name: 'alamat'},
		                  { data: 'tgl_masuk', name: 'tgl_masuk'},
		                  { data: 'foto', name: 'foto', orderable: false, searchable: false },
		                  // { data: 'foto', name: 'foto', orderable: false, searchable: false },
		                  // { data: 'foto', name: 'foto', orderable: false, searchable: false },
		                  { data: 'action', name: 'action', orderable: false, searchable: false }
		              ]
		          }); 

		         // Auto reload when getting result 
		        $('#filter_kelas').on('change', function(e) {
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
				token: '',
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
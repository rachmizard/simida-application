<template>
	<!-- Panel Table Tools -->
      <div class="panel" id="app">

		<div class="page-header">
		    <h1 class="page-title"><i class="icon wb-flag"></i> Data Kelas</h1>
		    <ol class="breadcrumb">
		        <li class="breadcrumb-item"><a href="">Home</a></li>
		        <li class="breadcrumb-item"><a href="javascript:void(0)">Master Kelas</a></li>
		        <li class="breadcrumb-item"><router-link to="/list_kelas">Data Kelas</router-link></li>
		        <li class="breadcrumb-item active">Data Santri Kelas {{ id_kelas.nama_kelas }} </li>
		    </ol>
		</div>
        <header class="panel-heading">
          <h3 class="panel-title"></h3>
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
			this.listSantriKelas()
			this.getIdKelas()
		},

		data(){
			return {
				id_kelas : {
					nama_kelas: ''
				}
			}
		},

		methods: {
			listSantriKelas(){
				let app = this;
				var id_kelas = app.$route.params.id;
				$(function(){
			         var table = $('#santriTable').DataTable({
			              processing: true,
			              serverSide: true,
			              ajax: {
			                url: "/sekretariat/santri/"+ id_kelas +"/kelas"
			                // data:function(e){
			                //   e.filter_tingkat = $('select[name="filter_tingkat"]').val();
			                // }
			              },
			              columns: [
			                  { data: 'nis', name: 'nis' },
			                  { data: 'nama_santri', name: 'nama_santri', orderable: true },
			                  { data: 'asrama.ngaran.nama', name: 'asrama.ngaran.nama' },
			                  { data: 'kelas.nama_kelas', name: 'kelas.nama_kelas'},
			                  { data: 'alamat', name: 'alamat'},
			                  { data: 'tgl_masuk', name: 'tgl_masuk'},
			                  // { data: 'foto', name: 'foto', orderable: false, searchable: false },
			                  { data: 'action', name: 'action', orderable: false, searchable: false }
			              ]
			          }); 

			         // Auto reload when getting result 
			        $('#filter_tingkat').on('change', function(e) {
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

			getIdKelas(){
				let app = this;
				var id = app.$route.params.id;
				axios.get('/sekretariat/kelas/'+ id +'/show').then(response => {
					app.id_kelas.nama_kelas = response.data.nama_kelas;
				});
			}
		}
	}
</script>
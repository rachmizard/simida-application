<template>
	 <!-- Panel Table Tools -->
      <div class="panel" id="app">

        <div class="page-header">
            <h1 class="page-title"><i class="icon wb-flag"></i> Data Kelas</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Master Kelas</a></li>
                <li class="breadcrumb-item active">Data Kelas</li>
            </ol>
            <!-- <div class="page-header-actions">
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Edit">
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Refresh">
                    <i class="icon wb-refresh" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Setting">
                    <i class="icon wb-settings" aria-hidden="true"></i>
                </button>
            </div> -->
        </div>

        <header class="panel-heading">
          <h3 class="panel-title"></h3>
        </header>
        <div class="panel-body">
          <transition name="slide-fade">
            <router-view></router-view>
          </transition>
          <table class="table table-hover dataTable table-striped w-full" id="kelasTable">
            <thead>
              <tr>
                <th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th>Tingkat</th>
                <th>Guru</th>
                <th>Badal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
              	<th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th>Tingkat</th>
                <th>Guru</th>
                <th>Badal</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->
</template>
<script>

  import JQuery from 'jquery'
	export default {
		data(){
			return {
				kelas: []
			}
		},

		mounted(){
			this.listsKelas();	
			$(document).ready(function(){
				$('#exampleTableTools').DataTable();
			});
		},

		methods: {
			listsKelas(){
				let app = this;
				axios.get('/sekretariat/kelas/JSON').then(response => {
					app.kelas = response.data;
				});
       $(function() {
             var table = $('#kelasTable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "/sekretariat/kelas/getKelasDatatables",
                  columns: [
                      { data: 'id', name: 'id' },
                      { data: 'nama_kelas', name: 'nama_kelas' },
                      { data: 'tingkat', name: 'tingkat' },
                      { data: 'guru_id.nama_guru', name: 'guru_id.nama_guru' },
                      { data: 'badal_id.nama_guru', name: 'badal_id.nama_guru' },
                      { data: 'action', name: 'action', orderable: false, searchable: false },
                  ]
              }); 
            // Trigger auto refresh
            Echo.channel('draw-table')
            .listen('DrawTable', (e) => {
              table.draw();
            });

            $('#deleteModal').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                // $.get('/sekretariat/kelas/'+ id +'/destroy', function( data ) {
                //   $('#submitDeleteKelas').attr('action', '/sekretariat/kelas/'+ id +'/destroy');
                // }); 
              $("#deleteBtn").on('click', function(){
                  axios.delete('/sekretariat/kelas/'+ id +'/destroy').then(function(resp){
                    $('#deleteModal').modal('hide')
                    table.draw()
                  }).then(function(){
                    window.location.reload()
                  })
              });
            });
      });

       $(document).ready(function(){
            $('#editModal').on('show.bs.modal', function(e) {
                    var id = $(e.relatedTarget).data('id');
                    $.get('/sekretariat/kelas/'+ id +'/show', function( data ) {
                      $("#title-data").html(data.nama_kelas);
                      $("#tingkat").val(data.tingkat);
                      $("#nama_kelas").val(data.nama_kelas);
                      $("#tingkat_id").attr('value', data.tingkat_id);
                      $("#lokal").val(data.lokal);
                      $("#guru_id").val(data.guru_id.id);
                      $("#badal_id").val(data.badal_id.id);
                      console.log(data);
                    });

                  $('#submitEditKelas').attr('action', '/sekretariat/kelas/'+ id +'/update');
            });
          });
			}
		}
	}
</script>
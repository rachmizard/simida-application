<template>
	 <!-- Panel Table Tools -->
      <div class="panel" id="app">


    <!-- MODAL -->

      <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-data"></h4>
            </div>
            <div class="modal-body" style="margin-bottom: 50px;">
                <h3>Anda yakin ingin menghapus data tersebut?</h3>
            </div>
              <div class="modal-footer">
                <div class="btn-group">
                  <button class="btn btn-md btn-info" data-dismiss="modal">Tidak</button>
                  <button class="btn btn-md btn-danger" id="deleteBtn"><i class="fa fa-upload"></i> Ya</button>
                </div>
              </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <!-- END MODAL -->
        <header class="panel-heading">
          <h3 class="panel-title">Table Data Kelas</h3>
        </header>
        <div class="panel-body">
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

   $(function() {
         var table = $('#kelasTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/sekretariat/kelas/getKelasDatatables",
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'nama_kelas', name: 'nama_kelas' },
                  { data: 'tingkat', name: 'tingkat' },
                  { data: 'guru_id', name: 'guru_id' },
                  { data: 'badal_id', name: 'badal_id' },
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
            $.get('/sekretariat/kelas/'+ id +'/destroy', function( data ) {
              $('#submitDeleteKelas').attr('action', '/sekretariat/kelas/'+ id +'/destroy');
            }); 
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
                  $("#guru_id").val(data.guru_id);
                  $("#badal_id").val(data.badal_id);
                  console.log(data);
                });

              $('#submitEditKelas').attr('action', '/sekretariat/kelas/'+ id +'/update');
        });
      });
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
			}
		}
	}
</script>
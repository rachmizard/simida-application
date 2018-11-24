<template>
	 <!-- Panel Table Tools -->
      <div class="panel" id="app">
    <!-- MODAL -->
      <div id="deleteModalAsrama" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-data"></h4>
            </div>
            <div class="modal-body" style="margin-bottom: 50px;">
                <h5>Anda yakin ingin menghapus data tersebut?</h5>
            </div>
              <div class="modal-footer">
                <div class="btn-group">
                  <button class="btn btn-md btn-info" data-dismiss="modal">Tidak</button>
                  <button class="btn btn-md btn-danger" id="deleteBtnAsrama"><i class="fa fa-upload"></i><i class="icon wb-trash"></i> Ya</button>
                </div>
              </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <!-- END MODAL -->
        <header class="panel-heading">
          <h3 class="panel-title">Table Data Asrama</h3>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped w-full" id="asramaTable">
            <thead>
              <tr>
                <th width="20%">ID Asrama</th>
                <th width="20%">Nama Asrama</th>
                <th width="20%">Rai'sam Asrama</th>
                <th width="20%">Kobong</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th width="20%">ID Asrama</th>
                <th width="20%">Nama Asrama</th>
                <th width="20%">Rai'sam Asrama</th>
                <th width="20%">Kobong</th>
                <th width="20%">Aksi</th>
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
         var table = $('#asramaTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/sekretariat/asrama/getAsramaDataTables",
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'nama_asrama.nama_asrama', name: 'nama_asrama.nama_asrama' },
                  { data: 'roisam_asrama', name: 'roisam_asrama' },
                  { data: 'kobong', name: 'kobong', orderable: false },
                  { data: 'action', name: 'action', orderable: false, searchable: false },
              ]
          }); 
        // Trigger auto refresh
        Echo.channel('draw-table')
        .listen('DrawTable', (e) => {
          table.draw();
        });

        $('#deleteModalAsrama').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            // $.get('/sekretariat/kelas/'+ id +'/destroy', function( data ) {
            //   $('#submitDeleteKelas').attr('action', '/sekretariat/kelas/'+ id +'/destroy');
            // }); 
          $("#deleteBtnAsrama").on('click', function(){
              axios.post('/sekretariat/asrama/'+ id +'/destroy').then(function(resp){
                $('#deleteModalAsrama').modal('hide')
                table.draw()
              }).then(function(){
                window.location.reload()
              })
          });
        });
  });

   $(document).ready(function(){
        $('#editModalAsrama').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $.get('/sekretariat/asrama/'+ id +'/show', function( data ) {
                $("#nama_asrama").val(data.nama_asrama);
                $("#kategori_asrama").val(data.kategori_asrama);
                $("#roisam_asrama").attr('value', data.roisam_asrama);
                });

              $('#submitEditAsrama').attr('action', '/sekretariat/asrama/'+ id +'/update');
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
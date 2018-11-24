<template>
	 <!-- Panel Table Tools -->
      <div class="panel" id="app">

<!-- MODAL -->
<div id="tambahKobong" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title-data">Tambah Kobong di</h4>
      </div>
        <div class="modal-body" style="margin-bottom: 50px;"><div class="form-row">
            <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
              <h4 class="example-title" id="kobong-asrama-title">Kobong</h4>
              <div class="example">
                  <div class="form-group">
                     <label class="form-control-label" for="inputBasicFirstName">Nama Kobong</label>
                     <input type="text" name="nama_kobong" class="form-control" placeholder="First Name" autocomplete="off" />
                  </div>
              </div><!--/Example-->
            </div><!--/.form-group
            =========================-->
            <div class="form-group col-md-6 col-sm-12" style="padding-left: 15px;">
              <h4 class="example-title">Rais'Am</h4>
              <div class="example">
                  <div class="form-group">
                     <label class="form-control-label" for="inputBasicFirstName">Rais'Am Kobong</label>
                     <input type="text" name="roisam_kobong" class="form-control" placeholder="Rais'Am Kobong" autocomplete="off" />
                  </div>
              </div>
            </div><!--/.form-group
            ======================-->
         </div><!--/.form-row-->
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button class="btn btn-md btn-default" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="btntambahKobong"><i class="icon wb-plus"></i> Tambah Kobong</button>
          </div>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END MODAL -->
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
          <div class="form-group col-md-6" style="margin-left: 15px;">
            <label for="">Filter Kategori Asrama</label>
            <select name="kategori_asrama" id="kategori_asrama" class="form-control">
              <option value="putra">Putra</option>
              <option value="putri">Putri</option>
            </select>
          </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped w-full" id="asramaTable">
            <thead>
              <tr>
                <th width="5%">ID Asrama</th>
                <th width="20%">Nama Asrama</th>
                <th width="20%">Rai'sam Asrama</th>
                <th width="10%">Jumlah Kobong</th>
                <th width="20%" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th width="5%">ID Asrama</th>
                <th width="20%">Nama Asrama</th>
                <th width="20%">Rai'sam Asrama</th>
                <th width="10%">Jumlah Kobong</th>
                <th width="20%" class="text-center">Aksi</th>
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
              ajax: {
                url: "/sekretariat/asrama/getAsramaDataTables",
                data:function(e){
                  e.kategori_asrama = $('select[name="kategori_asrama"]').val();
                }
              },
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'ngaran.nama', name: 'ngaran.nama', orderable: false },
                  { data: 'roisam_asrama', name: 'roisam_asrama' },
                  { data: 'kobong', name: 'kobong', orderable: false },
                  { data: 'action', name: 'action', orderable: false, searchable: false },
              ]
          }); 

         // Auto reload when getting result 
        $('#kategori_asrama').on('change', function(e) {
            table.draw();
            e.preventDefault();
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


        $('#editModalAsrama').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $.get('/sekretariat/asrama/'+ id +'/show', function( data ) {
                $("#nama_asrama").val(data.nama_asrama);
                $("#kategori_asrama").val(data.kategori_asrama);
                $("#roisam_asrama").attr('value', data.roisam_asrama);
                });

              $('#submitEditAsrama').attr('action', '/sekretariat/asrama/'+ id +'/update');
        });



        $('#tambahKobong').on('show.bs.modal', function(e){
            var id = $(e.relatedTarget).data('id');
            $('#submitTambahAsramaKobong').attr('action', '/sekretariat/kobong/'+ id +'/storeByAsramaId');
            $('#btntambahKobong').click(function(u){
              u.preventDefault();
              axios({
                method: 'post',
                url: '/sekretariat/kobong/'+ id +'/storeByAsramaId',
                data: {
                  asrama_id: id,
                  nama_kobong: $('input[name="nama_kobong"]').val(),
                  roisam_kobong: $('input[name="roisam_kobong"]').val()
                }
              }).then(response => {
                  table.draw();
                  // $('#tambahKobong').modal('hide');
                  $('input[name="nama_kobong"]').val('');
                  $('input[name="roisam_kobong"]').val('');
              });
            });

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
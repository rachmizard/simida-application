<template>
	<!-- Panel Table Tools -->
      <div class="panel" id="app">
    <!-- MODAL -->
      <div id="deleteModalGuru" class="modal fade" tabindex="-1" role="dialog">
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
          <h3 class="panel-title">Table Santri</h3>
          <div class="form-group col-md-6" style="margin-left: 15px;">
            <label for="">Menampilkan Santri Berdasarkan Kelas</label>
            <select name="filter_tingkat" id="filter_tingkat" class="form-control">
            </select>
          </div>
        </header>
        <div class="panel-body">
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
		$(function() {
		         var table = $('#santriTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		                url: "/sekretariat/santri/getSantriDataTables"
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

		data(){
			return {

			}
		}
	}
</script>
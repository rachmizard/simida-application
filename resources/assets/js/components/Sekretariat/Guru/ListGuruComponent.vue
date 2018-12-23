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
          <h3 class="panel-title"></h3>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group" style="margin-left: 15px;">
                <select name="filter_tingkat" id="filter_tingkat" class="form-control">
                  <option value="" disabled selected>Filter berdasarkan tingkat</option>
                  <option value="">Semua..</option>
                  <option v-for="tingkat in tingkats.data" :value="tingkat.id">{{ tingkat.nama_tingkatan }}</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <form action="/sekretariat/guru/export" method="POST">
                <input type="hidden" :value="token" name="_token" class="form-control">
                <button type="submit" class="btn btn-sm btn-info"><i class="icon wb-download"></i> Export Guru Ke Excel</button>
              </form>
            </div>
          </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover table-bordered dataTable table-striped w-full" id="guruTable">
            <thead>
              <tr>
                <th width="5%" class="bg-info text-white">ID</th>
                <th width="20%" class="bg-info text-white">Nama Guru</th>
                <th width="20%" class="bg-info text-white">Tingkat Kelas</th>
                <th width="10%" class="bg-info text-white">Wali Kelas</th>
                <th width="20%" class="bg-info text-white">Aksi</th>
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
   $(function() {
         var table = $('#guruTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                url: "/sekretariat/guru/getGuruDataTables",
                data:function(e){
                  e.filter_tingkat = $('select[name="filter_tingkat"]').val();
                }
              },
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'nama_guru', name: 'nama_guru', orderable: true },
                  { data: 'tingkat.nama_tingkatan', name: 'tingkat_id' },
                  { data: 'kelas', name: 'kelas'},
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
                $("#filter_tingkat").val(data.filter_tingkat);
                $("#roisam_asrama").attr('value', data.roisam_asrama);
                });

              $('#submitEditAsrama').attr('action', '/sekretariat/asrama/'+ id +'/update');
        });



        $('#tambahModalKobongAsrama').on('show.bs.modal', function(e){
            var id = $(e.relatedTarget).data('id');
            $('#submitTambahAsramaKobong').attr('action', '/sekretariat/kobong/'+ id +'/storeByAsramaId');
            // $('#btntambahKobong').click(function(u){
            //   u.preventDefault();
            //   axios({
            //     method: 'post',
            //     url: '/sekretariat/kobong/'+ id +'/storeByAsramaId',
            //     data: {
            //       asrama_id: id,
            //       nama_kobong: $('input[name="nama_kobong"]').val(),
            //       roisam_kobong: $('input[name="roisam_kobong"]').val()
            //     }
            //   }).then(response => {
            //       table.draw();
            //       // $('#tambahKobong').modal('hide');
            //       $('input[name="nama_kobong"]').val('');
            //       $('input[name="roisam_kobong"]').val('');
            //   });
            // });

        });
  });
	export default {

    mounted(){
        this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        axios.get('/sekretariat/tingkatan/getJSON').then(response => {
          this.tingkats = response.data;
        })
    },

    data(){
      return {
        tingkats: [],
        token: '',
      }
    }
	}
</script>
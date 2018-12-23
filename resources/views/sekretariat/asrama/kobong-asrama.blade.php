@extends('layouts.master-layouts')
@section('content')

<div class="page-header">
    <h1 class="page-title">{{ $title }} {{ $name }}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Master Asrama</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sekretariat.asrama') }}">Data Asrama</a></li>
        <li class="breadcrumb-item active">{{ $title }} {{ $name }}</li>
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

<!-- MODAL -->
      <div id="tambahModalKamarAsrama" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-data">Tambah Kamar di {{ $kobong_asrama->ngaran->nama }}</h4>
            </div>
              <form method="POST" enctype="multipart/form-data" id="submitTambahAsramaKamar">
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <input type="hidden" value="POST" name="_method">
                <div class="modal-body" style="margin-bottom: 50px;"><div class="form-row">
                    <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                    	<h4 class="example-title" id="kobong-asrama-title">Kamar</h4>
	                    <div class="example">
	                        <div class="form-group">
	                           <label class="form-control-label" for="inputBasicFirstName">Nama Kamar</label>
	                           <input type="text" name="nama_kobong" class="form-control" placeholder="First Name" autocomplete="off" />
	                        </div>
	                    </div><!--/Example-->
                    </div><!--/.form-group
                    =========================-->
                    <div class="form-group col-md-6 col-sm-12" style="padding-left: 15px;">
	                    <h4 class="example-title">Rais'Am</h4>
	                    <div class="example">
	                        <div class="form-group">
	                           <label class="form-control-label" for="inputBasicFirstName">Rais'Am Kos</label>
	                           <input type="text" name="roisam_kobong" class="form-control" placeholder="Rais'Am Kamar" autocomplete="off" />
	                        </div>
	                    </div>
                    </div><!--/.form-group
                    ======================-->
                 </div><!--/.form-row-->
                </div>
                <div class="modal-footer">
                  <div class="btn-group">
                    <button type="submit" class="btn btn-primary" id="btntambahKamar"><i class="icon wb-plus"></i> Tambah Kamar</button>
                    <button class="btn btn-md btn-default" data-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
<!-- END MODAL -->

    <!-- MODAL -->
      <div id="editModalAsramaKamar" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-data"></h4>
            </div>
            <form method="POST" enctype="multipart/form-data" id="submitEditAsramaKamar">
            <div class="modal-body" style="margin-bottom: 50px;">
              <div class="form-row">
                
                  <input type="hidden" value="{{ csrf_token() }}" name="_token">
                  <input type="hidden" value="PUT" name="_method">
                  <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                  	<h4 class="example-title" id="kobong-asrama-title">Kamar</h4>
                    <div class="example">
                        <div class="form-group">
                           <label class="form-control-label" for="inputBasicFirstName">Nama Kamar</label>
                           <input type="text" id="nama_kobong" name="nama_kobong" class="form-control" placeholder="First Name" autocomplete="off" />
                        </div>
                    </div><!--/Example-->
                  </div><!--/.form-group
                  =========================-->
                  <div class="form-group col-md-6 col-sm-12" style="padding-left: 15px;">
                    <h4 class="example-title">Rais'Am</h4>
                    <div class="example">
                        <div class="form-group">
                           <label class="form-control-label" for="inputBasicFirstName">Rais'Am Kamar</label>
                           <input type="text" id="roisam_kobong" name="roisam_kobong" class="form-control" placeholder="Rais'Am Kamar" autocomplete="off" />
                        </div>
                    </div>
                  </div><!--/.form-group
                  ======================-->
             </div><!--/.form-row-->
            </div>
            <div class="modal-footer">
              <div class="btn-group">
                <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Edit Kamar</button>
                <button class="btn btn-md btn-default" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <!-- END MODAL -->
<div class="panel">
    <!-- MODAL -->
      <div id="deleteModalKamarAsrama" class="modal fade" tabindex="-1" role="dialog">
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
                  <button class="btn btn-md btn-danger" id="deleteBtnKamarAsrama"><i class="fa fa-upload"></i><i class="icon wb-trash"></i> Ya</button>
                  <button class="btn btn-md btn-info" data-dismiss="modal">Tidak</button>
                </div>
              </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <!-- END MODAL -->
        <header class="panel-heading">
          <h3 class="panel-title">Data Kamar dari Asrama {{ $kobong_asrama->ngaran->nama }} </h3>
        </header>
        <div class="form-group" style="margin-left: 20px;">
          	<button data-toggle="modal" data-target="#tambahModalKamarAsrama" data-id="{{ $kobong_asrama->id }}" class="btn btn-sm btn-success"><i class="icon wb-plus"></i> Tambah</button>
        </div>		
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped w-full" id="kobongAsramaTable">
            <thead>
              <tr>
                <th width="20%">ID Kamar</th>
                <th width="20%">Nama Kamar</th>
                <th width="20%">Rai'sam Kamar</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th width="20%">ID Kamar</th>
                <th width="20%">Nama Kamar</th>
                <th width="20%">Rai'sam Kamar</th>
                <th width="20%">Aksi</th>
              </tr>
            </tfoot>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->

@push('otherJavascript')
<script>

   $(document).ready(function(){
   	var table = $('#kobongAsramaTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/sekretariat/asrama/{{ $kobong_asrama->id }}/kobongJSON",
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'nama_kobong', name: 'nama_kobong' },
                  { data: 'roisam_kobong', name: 'roisam_kobong' },
                  { data: 'action', name: 'action', orderable: false, searchable: false },
              ]
          }); 

        $('#deleteModalKamarAsrama').on('show.bs.modal', function(e) {
            var id_delete = $(e.relatedTarget).data('id');
            $.get('/sekretariat/kelas/'+ id_delete +'/destroy', function( data ) {
              $('#submitDeleteKelas').attr('action', '/sekretariat/kelas/'+ id +'/destroy');
            }); 
          $("#deleteBtnKamarAsrama").on('click', function(){
              axios.post('/sekretariat/kobong/'+ id_delete +'/destroy').then(function(resp){
                table.draw();
              }).then(respon => {
                $('#deleteModalKamarAsrama').modal('hide');
                window.location.reload();
              })
          });
        });

        $('#editModalAsramaKamar').on('show.bs.modal', function(e) {
                var id_edit = $(e.relatedTarget).data('id');
                axios.get('/sekretariat/kobong/'+ id_edit +'/showJSON').then(function(response) {
                  $("#nama_kobong").val(response.data.nama_kobong);
                  $("#roisam_kobong").val(response.data.roisam_kobong);
                });
              $('#submitEditAsramaKamar').attr('action', '/sekretariat/kobong/'+ id_edit +'/update');
                // $('#btneditKamar').click(function(p){
                //     p.preventDefault();
                //     axios({
                //       method: 'put',
                //       url: '/sekretariat/kobong/'+ id_edit +'/update',
                //       data: {
                //         asrama_id: id_edit,
                //         nama_kobong: document.getElementById('nama_kobong').value ,
                //         roisam_kobong: document.getElementById('roisam_kobong').value 
                //       }
                //     }).then(response => {
                //         window.location.reload();
                //         table.draw();
                //         $('#editModalAsramaKamar').modal('hide');
                //         document.getElementById('nama_kobong').value = '';
                //         document.getElementById('roisam_kobong').value = '';
                //     });
                // });
        });

        $('#tambahModalKamarAsrama').on('show.bs.modal', function(e){
            var id_tambah = $(e.relatedTarget).data('id');
            $('#submitTambahAsramaKamar').attr('action', '/sekretariat/kobong/'+ id_tambah +'/storeByAsramaId');
            // $('#btntambahKamar').click(function(event){
            //   event.preventDefault();
            //     axios({
            //       method: 'post',
            //       url: '/sekretariat/kobong/'+ id_tambah +'/storeByAsramaId',
            //       data: {
            //         asrama_id: id_tambah,
            //         nama_kobong: $('input[name="nama_kobong"]').val(),
            //         roisam_kobong: $('input[name="roisam_kobong"]').val()
            //       }
            //     }).then(response => {
            //         table.draw();
            //         window.location.reload();
            //         $('#tambahModalKamarAsrama').modal('hide');
            //         $('input[name="nama_kobong"]').val('');
            //         $('input[name="roisam_kobong"]').val('');
            //     });
            // });
        });
      });
</script>
@endpush
@endsection
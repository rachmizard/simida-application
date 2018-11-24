@extends('layouts.master-layouts')
@section('content')

<div class="page-header">
    <h1 class="page-title">Data Asrama</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Master Asrama</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sekretariat.asrama') }}">Data Asrama</a></li>
        <li class="breadcrumb-item active">Lihat Kobong dari Asrama {{ $kobong_asrama->namaAsrama->nama_asrama }}</li>
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
      <div id="tambahModalKobongAsrama" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-data">Tambah Kobong di {{ $kobong_asrama->namaAsrama->nama_asrama }}</h4>
            </div>
              <form method="POST" enctype="multipart/form-data" id="submitEditAsramaKobong">
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <input type="hidden" value="POST" name="_method">
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
	                <button type="submit" class="btn btn-primary"><i class="icon wb-plus"></i> Tambah Kobong</button>
                  </div>
                </div>
              </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
<!-- END MODAL -->

    <!-- MODAL -->
      <div id="editModalAsramaKobong" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-data"></h4>
            </div>
              <form method="POST" enctype="multipart/form-data" id="submitEditAsramaKobong">
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <input type="hidden" value="PUT" name="_method">
                <div class="modal-body" style="margin-bottom: 50px;"><div class="form-row">
                    <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                    	<h4 class="example-title" id="kobong-asrama-title">Kobong</h4>
	                    <div class="example">
	                        <div class="form-group">
	                           <label class="form-control-label" for="inputBasicFirstName">Nama Kobong</label>
	                           <input type="text" id="nama_kobong" name="nama_kobong" class="form-control" placeholder="First Name" autocomplete="off" />
	                        </div>
	                    </div><!--/Example-->
                    </div><!--/.form-group
                    =========================-->
                    <div class="form-group col-md-6 col-sm-12" style="padding-left: 15px;">
	                    <h4 class="example-title">Rais'Am</h4>
	                    <div class="example">
	                        <div class="form-group">
	                           <label class="form-control-label" for="inputBasicFirstName">Rais'Am Kobong</label>
	                           <input type="text" id="roisam_kobong" name="roisam_kobong" class="form-control" placeholder="Rais'Am Kobong" autocomplete="off" />
	                        </div>
	                    </div>
                    </div><!--/.form-group
                    ======================-->
                 </div><!--/.form-row-->
                </div>
                <div class="modal-footer">
                  <div class="btn-group">
                    <button class="btn btn-md btn-default" data-dismiss="modal">Tutup</button>
	                <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Edit Kobong</button>
                  </div>
                </div>
              </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <!-- END MODAL -->
<div class="panel">
    <!-- MODAL -->
      <div id="deleteModalKobongAsrama" class="modal fade" tabindex="-1" role="dialog">
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
                  <button class="btn btn-md btn-danger" id="deleteBtnKobongAsrama"><i class="fa fa-upload"></i><i class="icon wb-trash"></i> Ya</button>
                </div>
              </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <!-- END MODAL -->
        <header class="panel-heading">
          <h3 class="panel-title">Data Kobong dari Asrama {{ $kobong_asrama->namaAsrama->nama_asrama }} </h3>
        </header>
        <div class="form-group" style="margin-left: 20px;">
          	<button data-toggle="modal" data-target="#tambahModalKobongAsrama" class="btn btn-sm btn-success"><i class="icon wb-plus"></i> Tambah</button>
        </div>		
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped w-full" id="kobongAsramaTable">
            <thead>
              <tr>
                <th width="20%">ID Kobong</th>
                <th width="20%">Nama Kobong</th>
                <th width="20%">Rai'sam Kobong</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th width="20%">ID Kobong</th>
                <th width="20%">Nama Kobong</th>
                <th width="20%">Rai'sam Kobong</th>
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
              ajax: "/sekretariat/asrama/"+ {{ $kobong_asrama->id }} +"/kobongJSON",
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'nama_kobong', name: 'nama_kobong' },
                  { data: 'roisam_kobong', name: 'roisam_kobong' },
                  { data: 'action', name: 'action', orderable: false, searchable: false },
              ]
          }); 

        $('#deleteModalKobongAsrama').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            // $.get('/sekretariat/kelas/'+ id +'/destroy', function( data ) {
            //   $('#submitDeleteKelas').attr('action', '/sekretariat/kelas/'+ id +'/destroy');
            // }); 
          $("#deleteBtnKobongAsrama").on('click', function(){
              axios.post('/sekretariat/kobong/'+ id +'/destroy').then(function(resp){
                $('#deleteModalKobongAsrama').modal('hide')
                table.draw()
              }).then(function(){
                window.location.reload()
              })
          });
        });
        $('#editModalAsramaKobong').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $.get('/sekretariat/kobong/'+ id +'/showJSON', function( data ) {
                $("#nama_kobong").val(data.nama_kobong);
                $("#roisam_kobong").attr('value', data.roisam_kobong);
                });

              $('#submitEditAsramaKobong').attr('action', '/sekretariat/kobong/'+ id +'/update');
        });
      });
</script>
@endpush
@endsection
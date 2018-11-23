@extends('layouts.master-layouts')
@section('content')

<div class="page-header">
    <h1 class="page-title">Data Asrama</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Master Asrama</a></li>
        <li class="breadcrumb-item active">Data Asrama</li>
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
   <list-asrama-component></list-asrama-component>


    <!-- MODAL -->
      <div id="editModalAsrama" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-data"></h4>
            </div>
            <div class="modal-body">
	            <form method="POST" autocomplete="off" id="submitEditAsrama">
	            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	            		<input type="hidden" name="_method" value="PUT">
	               			<div class="form-row">
			                    <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
			                    	<h4 class="example-title">Edit Data Asrama</h4>
					                    <div class="example">
					                        <div class="form-row">
					                            <div class="form-group col-md-6">
					                                <label class="form-control-label" for="inputBasicFirstName">Kategori Asrama</label>
					                                <select name="kategori_asrama" id="kategori_asrama" class="form-control" placeholder="">
					                                    <option value="putra">Putra</option>
					                                    <option value="putri">Putri</option>
					                                </select>
					                            </div>
					                            <div class="form-group col-md-6">
					                                <label class="form-control-label" for="inputBasicFirstName">Nama Asrama</label>
					                                <select name="asrama_id" id="nama_asrama" class="form-control" style="width: 100%;">
				                                    @foreach($asramas as $in)
				                                        <option value="{{ $in->id }}">{{ $in->nama_asrama }}
				                                        </option>
				                                    @endforeach
					                                </select>
						                            @if($errors->has('asrama_id'))
						                              <span class="label label-danger">
						                                  {{ $errors->first('asrama_id') }}
						                              </span>
						                            @endif
					                            </div>
					                        </div>
					                    </div><!--/Example-->
			                    </div><!--/.form-group
	                    =========================-->
	                    <div class="form-group col-md-6 col-sm-12" style="padding-left: 15px;">
	                    <h4 class="example-title">Rais'Am</h4>
	                    <div class="example">
	                        <div class="form-group">
	                           <label class="form-control-label" for="inputBasicFirstName">Rais'Am Asrama</label>
	                           <input name="roisam_asrama" id="roisam_asrama" type="text" class="form-control" placeholder="" autocomplete="off" />
	                        </div>
		                    <div class="form-row">
			                	<button class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
			                    <button type="submit" class="btn btn-sm btn-warning"><i class="icon wb-check"></i> Edit Asrama</button>
			               </div>
	                    </div>
	                    </div><!--/.form-group
	                    ======================-->
	                 </div><!--/.form-row--> 
	            </form>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <!-- END MODAL -->

@endsection
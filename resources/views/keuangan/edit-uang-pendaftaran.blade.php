@extends('layouts.master-layouts')
@section('content')
        	<div class="page-header">
        	    <h1 class="page-title">Konfirmasi Pembayaran Registrasi Santri</h1>
        	    <ol class="breadcrumb">
        	        <li class="breadcrumb-item"><a href="/">Home</a></li>
        	        <li class="breadcrumb-item"><a href="javascript:void(0)">Keuangan</a></li>
        	        <li class="breadcrumb-item active">Konfirmasi Pembayaran Registrasi Santri</li>
        	    </ol>
        	</div>
			<div class="panel">
				<div class="panel-body container-fluid" style="background-color: #fafafa;">
					<!--/.page-header-->
				    <div class="row row-lg">
				        <div class="col-md-12 col-sm-12" style="padding-right: 15px;">
                			@if(session('messageSuccess'))
                				<div class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                						<span aria-hidden="true">&times;</span>
                					  </button>
                					  <i class="icon wb-check" aria-hidden="true"></i> {{ session('messageSuccess') }}</a>
                				</div>
                			@endif
                            <form action="{{ route('keuangan.uang-pendaftaran.update', $santri->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
    				            <table class="table table-hover table-stripped" data-mobile-responsive="true">
    				                <tbody>
                                        <tr>
                                            <th data-field="nama">NAMA</th>
                                            <td> <input type="text" class="form-control" value="{{ $santri->nama_santri }}" disabled style="width: 50%;"> </td>
                                        </tr>
                                        <tr>
                                            <th data-field="nama">TANGGAL REGISTRASI MASUK </th>
                                            <td> <input type="text" class="form-control" value="{{ $santri->created_at }}" disabled style="width: 50%;"> </td>
                                        </tr>
                                        <tr>
                                            <th data-field="nama">RINCIAN BIAYA PENDAFTARAN </th>
                                            <td> Rp. 100000 </td>
                                        </tr>
                                        <tr>
                                            <th data-field="nama">Lanjutkan pembayaran? </th>
                                            <td> <button type="submit" class="btn btn-md btn-primary">Lanjut</button> </td>
                                        </tr>
    				                </tbody>
    				            </table>
                            </form>
				        </div>
				        <!--/.form-group =========================-->
				    </div><!--/.row-->
				</div><!--/.panel-body-->
			</div><!--/.panel -->
<script
  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous"></script>
<script>
	$(function(){

	});
</script>
@endsection

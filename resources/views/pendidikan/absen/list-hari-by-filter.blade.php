@extends('layouts.master-layouts')
@section('content')
	<div id="app">
    	<div class="page-header">
    	    <h1 class="page-title">Pilih Tanggal (Edit)</h1>
    	    <ol class="breadcrumb">
    	        <li class="breadcrumb-item"><a href="/">Home</a></li>
    	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
                <li class="breadcrumb-item"><a href="#">Absensi</a></li>
                <li class="breadcrumb-item"><a href="#">Pilih Tanggal Absensi (Edit)</a></li>
    	        <li class="breadcrumb-item active">Pilih Tanggal (Edit)</li>
    	    </ol>
    	</div>
		<div class="row">
			<div class="col-md-8">
		      <div class="panel">
		        <header class="panel-heading">
		          <h3 class="panel-title"><i class="icon wb-book"></i> Daftar Absensi MP dan Kegiatan {{ $santri->nama_santri }} Periode {{ $periode->nama_periode }}</h3>
		        </header>
		        <div class="panel-body table-responsive">
		          <table class="table table-hover dataTable table-bordered table-striped w-full" id="listHariByFilterDataTables">
		            <thead>
		              <tr>
                        <th>No</th>
                        <th>Tanggal</th>
		                <th>Aksi Absen</th>
		              </tr>
		            </thead>
		            <tbody>
		            </tbody>
		          </table>
		        </div>
		      </div>
			</div>
		</div>
	</div>
@push('otherJavascript')
<script type="text/javascript">
    $(function(){
         var table = $('#listHariByFilterDataTables').DataTable();
    });
</script>
@endpush
@endsection

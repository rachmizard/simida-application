@extends('layouts.master-layouts')
@section('content')
<div id="app">
	<div class="page-header">
	    <h1 class="page-title">Pilih Tanggal Absensi</h1>
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/">Home</a></li>
	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
            <li class="breadcrumb-item"><a href="#">Absensi</a></li>
	        <li class="breadcrumb-item active"><a href="#">Pilih Tanggal Absensi</a></li>
	    </ol>
	</div>
    <div class="panel">
        <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
            <div class="row row-lg">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                        <h4 class="example-title"><i class="icon wb-book"></i> Tanggal Absen</h4>
                        <div class="example">
                            <form action="{{ route('pendidikan.absen.viewInputAbsen', $santri->id) }}" method="GET">
                                {{ csrf_field() }}
                                <input type="hidden" name="periode" value="{{ $periode_id }}">
								<input type="hidden" name="semester_id" value="{{ $semester_id }}">
                                <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label" for="">Tanggal Absen</label>
                                        <input type="date" name="tgl_absen" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-row col-md-6 text-center">
                                    <button type="submit" class="btn btn-primary col-md-4"> Lanjutkan</button>
                               </div>
                            </form>
                        </div><!--/Example-->
                        </div>
                     </div><!--/.form-row-->
                </div><!--/.col-->
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.master-layouts')
@section('content')
<div id="app">
	<div class="page-header">
	    <h1 class="page-title">Pilih Tanggal Absensi (Edit)</h1>
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/">Home</a></li>
	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
            <li class="breadcrumb-item"><a href="#">Absensi</a></li>
	        <li class="breadcrumb-item active"><a href="#">Pilih Tanggal Absensi (Edit)</a></li>
	    </ol>
	</div>
    <div class="panel">
        <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
            <div class="row row-lg">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                        <h4 class="example-title"><i class="icon wb-book"></i> Tanggal Absensi</h4>
                        <div class="example">
                            <form action="{{ route('pendidikan.absen.listHariByFilter', $santri->id) }}" method="GET">
                                {{ csrf_field() }}
                                <input type="hidden" name="periode" value="{{ $periode_id }}">
								<input type="hidden" name="semester_id" value="{{ $semester_id }}">
                                <input type="hidden" name="kelas_id" value="{{ $santri->kelas_id }}">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="form-control-label" for="">Tanggal Awal</label>
                                        <input type="date" name="bulan_awal" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-control-label" for="">Tanggal Akhir</label>
                                        <input type="date" name="bulan_akhir" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-row col-md-6 text-center">
                                    <button type="submit" class="btn btn-primary col-md-4"> Filter</button>
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

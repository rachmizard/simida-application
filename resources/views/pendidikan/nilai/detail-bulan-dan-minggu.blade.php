@extends('layouts.master-layouts')
@section('content')
<div id="app">
	<div class="page-header">
	    <h1 class="page-title">Menentukan Bulan & Minggu (Detail Nilai Mingguan)</h1>
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/">Home</a></li>
	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
            <li class="breadcrumb-item"><a href="#">Nilai</a></li>
	        <li class="breadcrumb-item active"><a href="#">Menentukan Bulan & Minggu (Detail Nilai Mingguan)</a></li>
	    </ol>
	</div>
    <div class="panel">
        <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
            <div class="row row-lg">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                        <h4 class="example-title"><i class="icon wb-book"></i> Nilai Bulan dan Minggu Ke</h4>
                        <div class="example">
                            <form action="{{ route('pendidikan.nilai.detailNilaiMingguanOtherMethod', $id) }}" method="GET">
                                {{ csrf_field() }}
                                <input type="hidden" name="periode_id" value="{{ $periode_id }}">
                                <input type="hidden" name="semester_id" value="{{ $semester_id }}">
                                <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label" for="">Bulan Ke</label>
                                        <select name="bulan_ke" class="form-control">
                                            <option value="1">Januari</option>
                                            <option value="2">February</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label" for="">Minggu Ke</label>
                                        <select class="form-control" name="minggu_ke">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
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

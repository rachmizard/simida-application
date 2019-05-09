@extends('layouts.master-layouts')
@section('content')
<div id="app">
	<div class="page-header">
	    <h1 class="page-title">Pilih Tahun & Bulan (Detail)</h1>
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/">Home</a></li>
	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
            <li class="breadcrumb-item"><a href="#">Absensi</a></li>
	        <li class="breadcrumb-item active"><a href="#">Pilih Tahun & Bulan (Detail)</a></li>
	    </ol>
	</div>
    <div class="panel">
        <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
            <div class="row row-lg">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                        <h4 class="example-title"><i class="icon wb-book"></i> Tahun & Bulan</h4>
                        <div class="example">
                            <form action="{{ route('pendidikan.absen.viewDetailAbsen', $santri->id) }}" method="GET">
                                {{ csrf_field() }}
                                <input type="hidden" name="periode" value="{{ $periode_id }}">
								<input type="hidden" name="semester_id" value="{{ $semester_id }}">
                                <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="form-control-label" for="">Tahun</label>
                                        <select class="form-control" name="tahun">
                                            <option value="2029" {{ Carbon\Carbon::now()->
                                            year == '2029' ? 'selected' : '' }}>2029</option>
                                            <option value="2028" {{ Carbon\Carbon::now()->
                                            year == '2028' ? 'selected' : '' }}>2028</option>
                                            <option value="2027" {{ Carbon\Carbon::now()->
                                            year == '2027' ? 'selected' : '' }}>2027</option>
                                            <option value="2026" {{ Carbon\Carbon::now()->
                                            year == '2026' ? 'selected' : '' }}>2026</option>
                                            <option value="2025" {{ Carbon\Carbon::now()->
                                            year == '2025' ? 'selected' : '' }}>2025</option>
                                            <option value="2024" {{ Carbon\Carbon::now()->
                                            year == '2024' ? 'selected' : '' }}>2024</option>
                                            <option value="2023" {{ Carbon\Carbon::now()->
                                            year == '2023' ? 'selected' : '' }}>2023</option>
                                            <option value="2022" {{ Carbon\Carbon::now()->
                                            year == '2022' ? 'selected' : '' }}>2022</option>
                                            <option value="2021" {{ Carbon\Carbon::now()->
                                            year == '2021' ? 'selected' : '' }}>2021</option>
                                            <option value="2020" {{ Carbon\Carbon::now()->
                                            year == '2020' ? 'selected' : '' }}>2020</option>
                                            <option value="2019" {{ Carbon\Carbon::now()->
                                            year == '2019' ? 'selected' : '' }}>2019</option>
                                            <option value="2018" {{ Carbon\Carbon::now()->
                                            year == '2018' ? 'selected' : '' }}>2018</option>
                                            <option value="2017" {{ Carbon\Carbon::now()->
                                            year == '2017' ? 'selected' : '' }}>2017</option>
                                            <option value="2016" {{ Carbon\Carbon::now()->
                                            year == '2016' ? 'selected' : '' }}>2016</option>
                                            <option value="2015" {{ Carbon\Carbon::now()->
                                            year == '2015' ? 'selected' : '' }}>2015</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-control-label" for="">Bulan</label>
                                        <select class="form-control" name="bulan">
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
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

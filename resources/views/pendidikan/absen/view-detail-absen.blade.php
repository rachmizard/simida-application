@extends('layouts.master-layouts')
@section('content')
        	<div class="page-header">
        	    <h1 class="page-title">Detail Absensi</h1>
        	    <ol class="breadcrumb">
        	        <li class="breadcrumb-item"><a href="/">Home</a></li>
        	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
                    <li class="breadcrumb-item"><a href="#">Absensi</a></li>
                    <li class="breadcrumb-item active"><a href="#">Pilih Tahun & Bulan (Detail)</a></li>
        	        <li class="breadcrumb-item active">Detail Absen</li>
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
				            <table class="table table-hover table-stripped" data-mobile-responsive="true">
				                <tbody>
                                    <tr>
                                        <th data-field="nama">NAMA</th>
                                        <td> <input type="text" class="form-control" value="{{ $santri->nama_santri }}" disabled style="width: 50%;"> </td>
                                    </tr>
				                    <tr>
				                        <th data-field="nis">NIS</th>
                                        <td> <input type="text" class="form-control" value="{{ $santri->nis }}" disabled style="width: 50%;"> </td>
				                    </tr>
                                    <tr>
				                        <th data-field="kelas">KELAS</th>
                                        <td> <input type="text" class="form-control" value="{{ $santri->kelas['nama_kelas'] }}" disabled style="width: 50%;"> </td>
                                    </tr>
                                    <tr>
				                        <th data-field="semester">SEMESTER</th>
                                        <td><input type="text" class="form-control" value="{{ $semester->tingkat_semester }}" disabled style="width: 50%;"></td>
                                    </tr>
                                    <tr>
				                        <th data-field="tahun_masuk">TAHUN MASUK</th>
                                        <td><input type="text" class="form-control" value="{{ Carbon\Carbon::parse($santri->tgl_masuk)->format('Y') }}" disabled style="width: 50%;"></td>
                                    </tr>
				                </tbody>
				            </table>
				        </div>
				        <!--/.form-group =========================-->
				    </div><!--/.row-->
				</div><!--/.panel-body-->
			</div><!--/.panel -->

			<div class="panel">
				<div class="panel-body container-fluid" style="background-color: #fafafa;">
                    <h4 class="example-title"><i class="icon wb-calendar"></i> Periode {{ $periode->nama_periode }},  {{ Carbon\Carbon::createFromFormat('Y-m', $tahun.'-'.$bulan)->format('M Y') }} </h4>
                    <a href="{{ route('pendidikan.absen.viewExportDetailAbsensi', [$santri->id, $periode->id, $semester->id, $kelas->id, $tahun, $bulan ]) }}" class="btn btn-md btn-default"> <i class="icon wb-download"></i> Export PDF</a>
				    <div class="row row-lg">
				            <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hovered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Mata Pelajaran</th>
                                                        <th>Hadir</th>
                                                        <th>Sakit</th>
                                                        <th>Izin</th>
                                                        <th>Alfa</th>
                                                        <th>Persentase Kehadiran %</th>
                                                        <th>Persentase Sakit %</th>
                                                        <th>Persentase Izin %</th>
                                                        <th>Persentase Alfa %</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($real_value_mapel as $key => $data)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $data['mata_pelajaran'] }}</td>
                                                        <td>{{ $data['total']['hadir'] }}</td>
                                                        <td>{{ $data['total']['sakit'] }}</td>
                                                        <td>{{ $data['total']['izin'] }}</td>
                                                        <td>{{ $data['total']['alfa'] }}</td>
                                                        <td><span class="badge badge-sm badge-primary">{{ round($data['persentase']['hadir'], 2) }} %</span> </td>
                                                        <td><span class="badge badge-sm badge-warning text-white">{{ round($data['persentase']['sakit'], 2) }} %</span></td>
                                                        <td><span class="badge badge-sm badge-dark">{{ round($data['persentase']['izin'], 2) }} %</span></td>
                                                        <td><span class="badge badge-sm badge-danger">{{ round($data['persentase']['alfa'], 2) }} %</span></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
				            </div><!--/.row-->

                            <!-- KEGIATAN ABSENSI -->
                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hovered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kegiatan</th>
                                                        <th>Hadir</th>
                                                        <th>Sakit</th>
                                                        <th>Izin</th>
                                                        <th>Alfa</th>
                                                        <th>Persentase Kehadiran %</th>
                                                        <th>Persentase Sakit %</th>
                                                        <th>Persentase Izin %</th>
                                                        <th>Persentase Alfa %</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($real_value_kegiatan as $key => $data_kegiatan)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $data_kegiatan['kegiatan'] }}</td>
                                                        <td>{{ $data_kegiatan['total']['hadir'] }}</td>
                                                        <td>{{ $data_kegiatan['total']['sakit'] }}</td>
                                                        <td>{{ $data_kegiatan['total']['izin'] }}</td>
                                                        <td>{{ $data_kegiatan['total']['alfa'] }}</td>
                                                        <td><span class="badge badge-sm badge-primary">{{ round($data_kegiatan['persentase']['hadir'], 2) }} %</span> </td>
                                                        <td><span class="badge badge-sm badge-warning text-white">{{ round($data_kegiatan['persentase']['sakit'], 2) }} %</span></td>
                                                        <td><span class="badge badge-sm badge-dark">{{ round($data_kegiatan['persentase']['izin'], 2) }} %</span></td>
                                                        <td><span class="badge badge-sm badge-danger">{{ round($data_kegiatan['persentase']['alfa'], 2) }} %</span></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
				        </div>
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

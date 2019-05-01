@extends('layouts.master-layouts')
@section('content')
        	<div class="page-header">
        	    <h1 class="page-title">Input Absensi</h1>
        	    <ol class="breadcrumb">
        	        <li class="breadcrumb-item"><a href="/">Home</a></li>
        	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
                    <li class="breadcrumb-item"><a href="#">Absensi</a></li>
                    <li class="breadcrumb-item"><a href="#">Pilih Tanggal Absensi</a></li>
        	        <li class="breadcrumb-item active">Input Absensi</li>
        	    </ol>
        	</div>
			<div class="panel">
				<div class="panel-body container-fluid" style="background-color: #fafafa;">
					<!--/.page-header-->
				    <div class="row row-lg">
				        <div class="col-md-12 col-sm-12" style="padding-right: 15px;">
				            <table class="table table-hover table-stripped" data-mobile-responsive="true">
				                <tbody>
                                    <tr>
                                        <th data-field="nama">Nama</th>
                                        <td>{{ $santri->nama_santri }}</td>
                                    </tr>
				                    <tr>
				                        <th data-field="nis">Nis</th>
                                        <td>{{ $santri->nis }}</td>
				                    </tr>
                                    <tr>
				                        <th data-field="kelas">Kelas</th>
                                        <td>{{ $santri->kelas['nama_kelas'] }}</td>
                                    </tr>
                                    <tr>
				                        <th data-field="semester">Semester</th>
                                        <td>{{ $semester->tingkat_semester }}</td>
                                    </tr>
                                    <tr>
				                        <th data-field="tahun_masuk">Tahun Masuk</th>
                                        <td>{{ Carbon\Carbon::parse($santri->tgl_masuk)->format('Y') }}</td>
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
                    <h4 class="example-title"><i class="icon wb-pencil"></i> {{ Carbon\Carbon::parse($tgl_absen)->format('d, M Y') }}</h4>
				    <div class="row row-lg">
				            <div class="col-md-6">
				                <form action="" method="POST">
				                	{{ csrf_field() }}
                                    <input type="hidden" value="{{ $santri->id }}" name="santri_id">
				                	<input type="hidden" value="{{ $periode->id }}" name="periode_id">
				                	<input type="hidden" value="{{ $semester->id }}" name="semester_id">
									<input type="hidden" name="kelas" value="{{ $santri->kelas_id }}">
					                <table class="table table-hover table-stripped">
					                    <thead>
					                        <tr>
					                            <th data-field="pelajaran">Mata Pelajaran</th>
					                            <th data-field="nilai">Aksi</th>
					                        </tr>
					                    </thead>
					                    <tbody>
                                            @foreach($mata_pelajarans as $mata_pelajaran)
                                            <tr>
                                                <td>{{ $mata_pelajaran->nama_mata_pelajaran }}</td>
                                            </tr>
                                            @endforeach
					                    </tbody>
					                </table>
					                <div class="tombolAksi" style="margin-top: 30px;text-align: center;">
					                    <button type="reset" class="btn btn-danger btn-outline">Reset Semua</button>
					                    <button type="submit" class="btn btn-success btn-outline">Simpan <i class="icon wb-check"></i> </button>
					                </div><!--/.tombolAksi-->
				                </form>
				            </div><!--/.row-->
                            <div class="col-md-6">
                                <form action="" method="POST">
				                	{{ csrf_field() }}
                                    <input type="hidden" value="{{ $santri->id }}" name="santri_id">
				                	<input type="hidden" value="{{ $periode->id }}" name="periode_id">
				                	<input type="hidden" value="{{ $semester->id }}" name="semester_id">
									<input type="hidden" name="kelas" value="{{ $santri->kelas_id }}">
					                <table class="table table-hover table-stripped">
					                    <thead>
					                        <tr>
					                            <th data-field="pelajaran">Kegiatan</th>
					                            <th data-field="nilai">Aksi</th>
					                        </tr>
					                    </thead>
					                    <tbody>
                                            @foreach($kegiatans as $kegiatan)
                                            <tr>
                                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                                <th data-field="nilai">
                                                    <select class="form-control" name="keterangan[]">
                                                        <option value="hadir">Hadir</option>
                                                        <option value="sakit">Sakit</option>
                                                        <option value="izin">Izin</option>
                                                        <option value="alfa">Alfa</option>
                                                    </select>
                                                </th>
                                            </tr>
                                            @endforeach
					                    </tbody>
					                </table>
					                <div class="tombolAksi" style="margin-top: 30px;text-align: center;">
					                    <button type="reset" class="btn btn-danger btn-outline">Reset Semua</button>
					                    <button type="submit" class="btn btn-success btn-outline">Simpan <i class="icon wb-check"></i> </button>
					                </div><!--/.tombolAksi-->
				                </form>
                            </div>
				        </div>
				</div><!--/.panel-body-->
			</div><!--/.panel -->
	</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous"></script>
<script>
	$(function(){

	});
</script>
@endsection

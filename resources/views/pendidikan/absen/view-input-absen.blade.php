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
                    <h4 class="example-title"><i class="icon wb-pencil"></i> {{ Carbon\Carbon::parse($tgl_absen)->format('d, M Y') }}</h4>
				    <div class="row row-lg">
                        @if(!$checkifMapelExistOrNot->count() > 0)
				            <div class="col-md-6">
				                <form action="{{ route('pendidikan.absen.storeInputAbsenMapel', $santri->id) }}" method="POST">
				                	{{ csrf_field() }}
                                    <input type="hidden" value="{{ $santri->id }}" name="santri_id">
				                	<input type="hidden" value="{{ $periode->id }}" name="periode_id">
				                	<input type="hidden" value="{{ $semester->id }}" name="semester_id">
                                    <input type="hidden" name="kelas" value="{{ $santri->kelas_id }}">
                                    <input type="hidden" name="tgl_absen" value="{{ $tgl_absen }}">
									<input type="hidden" name="type" value="mapel">
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
                                                <td>
                                                    {{ $mata_pelajaran->nama_mata_pelajaran }}
                                                    <input type="hidden" name="mata_pelajaran_id[]" value="{{ $mata_pelajaran->id }}">
                                                </td>
                                                <td>
                                                    <select class="form-control" name="keterangan[]">
                                                        <option value="hadir">Hadir</option>
                                                        <option value="sakit">Sakit</option>
                                                        <option value="izin">Izin</option>
                                                        <option value="alfa">Alfa</option>
                                                    </select>
                                                </td>
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
                            @else
    				            <div class="col-md-6">
    				                <form action="{{ route('pendidikan.absen.updateInputAbsenMapel', $santri->id) }}" method="POST">
    				                	{{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <input type="hidden" value="{{ $santri->id }}" name="santri_id">
    				                	<input type="hidden" value="{{ $periode->id }}" name="periode_id">
    				                	<input type="hidden" value="{{ $semester->id }}" name="semester_id">
                                        <input type="hidden" name="kelas" value="{{ $santri->kelas_id }}">
                                        <input type="hidden" name="tgl_absen" value="{{ $tgl_absen }}">
    									<input type="hidden" name="type" value="mapel">
    					                <table class="table table-hover table-stripped">
    					                    <thead>
    					                        <tr>
    					                            <th data-field="pelajaran">Mata Pelajaran</th>
    					                            <th data-field="nilai">Aksi</th>
    					                        </tr>
    					                    </thead>
    					                    <tbody>
                                                @foreach($checkifMapelExistOrNot->get() as $edit_absen_mapel)
                                                <tr>
                                                    <td>
                                                        {{ $edit_absen_mapel->matapelajaran['nama_mata_pelajaran'] }}
                                                        <input type="hidden" name="mata_pelajaran_id[]" value="{{ $edit_absen_mapel->mata_pelajaran_id }}">
                                                    </td>
                                                    <td>
                                                        <select class="form-control" name="keterangan[]">
                                                            <option value="hadir" {{ $edit_absen_mapel->keterangan
                                                            == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                                            <option value="sakit" {{ $edit_absen_mapel->keterangan
                                                            == 'sakit' ? 'selected' : ''  }}>Sakit</option>
                                                            <option value="izin" {{ $edit_absen_mapel->keterangan
                                                            == 'izin' ? 'selected' : ''  }}>Izin</option>
                                                            <option value="alfa" {{ $edit_absen_mapel->keterangan
                                                            == 'alfa' ? 'selected' : ''  }}>Alfa</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                @endforeach
    					                    </tbody>
    					                </table>
    					                <div class="tombolAksi" style="margin-top: 30px;text-align: center;">
    					                    <button type="submit" class="btn btn-warning btn-outline">Edit <i class="icon wb-check"></i> </button>
    					                </div><!--/.tombolAksi-->
    				                </form>
    				            </div><!--/.row-->
                            @endif

                            <!-- KEGIATAN ABSENSI -->

                            @if(!$checkifKegiatanExistOrNot->count() > 0)
                            <div class="col-md-6">
                                <form action="{{ route('pendidikan.absen.storeInputAbsenKegiatan', $santri->id) }}" method="POST">
				                	{{ csrf_field() }}
                                    <input type="hidden" value="{{ $santri->id }}" name="santri_id">
				                	<input type="hidden" value="{{ $periode->id }}" name="periode_id">
				                	<input type="hidden" value="{{ $semester->id }}" name="semester_id">
									<input type="hidden" name="kelas" value="{{ $santri->kelas_id }}">
                                    <input type="hidden" name="tgl_absen" value="{{ $tgl_absen }}">
                                    <input type="hidden" name="type" value="kegiatan">
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
                                                <td>
                                                    {{ $kegiatan->nama_kegiatan }}
                                                    <input type="hidden" name="kegiatan_id[]" value="{{ $kegiatan->id }}">
                                                </td>
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
                            @else
                            <div class="col-md-6">
                                <form action="{{ route('pendidikan.absen.updateInputAbsenKegiatan', $santri->id) }}" method="POST">
				                	{{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" value="{{ $santri->id }}" name="santri_id">
				                	<input type="hidden" value="{{ $periode->id }}" name="periode_id">
				                	<input type="hidden" value="{{ $semester->id }}" name="semester_id">
									<input type="hidden" name="kelas" value="{{ $santri->kelas_id }}">
                                    <input type="hidden" name="tgl_absen" value="{{ $tgl_absen }}">
                                    <input type="hidden" name="type" value="kegiatan">
					                <table class="table table-hover table-stripped">
					                    <thead>
					                        <tr>
					                            <th data-field="pelajaran">Kegiatan</th>
					                            <th data-field="nilai">Aksi</th>
					                        </tr>
					                    </thead>
					                    <tbody>
                                            @foreach($checkifKegiatanExistOrNot->get() as $edit_absen_kegiatan)
                                            <tr>
                                                <td>
                                                    {{ $edit_absen_kegiatan->kegiatan['nama_kegiatan'] }}
                                                    <input type="hidden" name="kegiatan_id[]" value="{{ $edit_absen_kegiatan->kegiatan_id }}">
                                                </td>
                                                <th data-field="nilai">
                                                    <select class="form-control" name="keterangan[]">
                                                        <option value="hadir" {{ $edit_absen_kegiatan->
                                                        keterangan == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                                        <option value="sakit" {{ $edit_absen_kegiatan->
                                                        keterangan == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                                        <option value="izin" {{ $edit_absen_kegiatan->
                                                        keterangan == 'izin' ? 'selected' : '' }}>Izin</option>
                                                        <option value="alfa" {{ $edit_absen_kegiatan->
                                                        keterangan == 'alfa' ? 'selected' : '' }}>Alfa</option>
                                                    </select>
                                                </th>
                                            </tr>
                                            @endforeach
					                    </tbody>
					                </table>
					                <div class="tombolAksi" style="margin-top: 30px;text-align: center;">
					                    <button type="submit" class="btn btn-warning btn-outline">Edit <i class="icon wb-check"></i> </button>
					                </div><!--/.tombolAksi-->
				                </form>
                            </div>
                            @endif
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

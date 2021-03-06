@extends('layouts.master-layouts')
@section('content')
			<div class="page-header">
			    <h1 class="page-title">Input Nilai Mingguan</h1>
			    <ol class="breadcrumb">
			        <li class="breadcrumb-item"><a href="/">Home</a></li>
			        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
			        <li class="breadcrumb-item"><a href="#">Nilai</a></li>
                    <li class="breadcrumb-item"><a href="#">Menentukan Bulan & Minggu</a></li>
			        <li class="breadcrumb-item active">Input Nilai Mingguan</li>
			    </ol>
			</div>
			<div class="panel">
				<div class="panel-body container-fluid" style="background-color: #fafafa;">
					<!--/.page-header-->
				    <div class="row row-lg">
				        <div class="col-md-12 col-sm-12" style="padding-right: 15px;">
				            <table class="table table-hover table-stripped" data-mobile-responsive="true">
				                <thead>
				                    <tr>
				                        <th data-field="id">Nis</th>
				                        <th data-field="kelas">Kelas</th>
				                        <th data-field="nama">Nama</th>
				                    </tr>
				                </thead>
				                <tbody>
				                    <tr>
				                        <td>{{ $santri->nis }}</td>
				                        <td>{{ $santri->kelas['nama_kelas'] }}</td>
                                        <td>{{ $santri->nama_santri }}</td>
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
				    <div class="row row-lg">
				            <div class="col-md-12">
				                <h4 class="example-title"><i class="icon wb-pencil"></i> Input Nilai Mingguan Bulan Ke-{{ $bulan_ke }} Minggu Ke-{{ $minggu_ke }}</h4>
				                <p>Mata Pelajaran di tampilkan berdasarkan tingkat <span class="badge badge-sm badge-success">{{ $santri->tingkat['nama_tingkatan'] }}</span> </p>
				                <form action="{{ route('pendidikan.nilai.storeNilaiMingguan', $santri->id) }}" method="POST">
				                	{{ csrf_field() }}
				                	<input type="hidden" value="{{ $periode_id }}" name="periode_id">
				                	<input type="hidden" value="{{ $semester_id }}" name="semester_id">
									<input type="hidden" name="bulan_ke" value="{{ $bulan_ke }}">
									<input type="hidden" name="minggu_ke" value="{{ $minggu_ke }}">
					                <table class="table table-hover table-stripped">
					                    <thead>
					                        <tr>
					                            <th data-field="pelajaran">Nama Pelajaran</th>
					                            <th data-field="nilai">Nilai</th>
					                        </tr>
					                    </thead>
					                    <tbody>
					                    	@foreach($mata_pelajarans as $key => $mata_pelajaran)
					                    	<tr>
					                    		<td>
					                    			<span>{{ $mata_pelajaran->nama_mata_pelajaran }}</span>
					                    			<input type="hidden" name="mata_pelajaran_id[]" value="{{ $mata_pelajaran->id }}">
					                    		</td>
					                    		<td>
					                    			<input type="number" name="jumlah_nilai[]" min="0" max="10" step="any" class="form-control" autocomplete="off" >
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

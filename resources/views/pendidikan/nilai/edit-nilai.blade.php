@extends('layouts.master-layouts')
@section('content')
			<div class="page-header">
			    <h1 class="page-title">Edit Nilai</h1>
			    <ol class="breadcrumb">
			        <li class="breadcrumb-item"><a href="/">Home</a></li>
			        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
			        <li class="breadcrumb-item"><a href="#">Nilai</a></li>
			        <li class="breadcrumb-item active">Edit Nilai Santri {{ $santri->nama_santri }}</li>
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
				                        <th data-field="nama">Nama</th>
				                        <th data-field="kelas">Kelas</th>
				                    </tr>
				                </thead>
				                <tbody>
				                    <tr>
				                        <td>{{ $santri->nis }}</td>
				                        <td>{{ $santri->nama_santri }}</td>
				                        <td>{{ $santri->kelas['nama_kelas'] }}</td>
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
				                <h4 class="example-title"><i class="icon wb-pencil"></i> Edit Nilai Pelajaran</h4>
				                <p>Mata Pelajaran di tampilkan berdasarkan tingkat {{ $santri->tingkat['nama_tingkatan'] }} </p>
				                <form action="{{ route('pendidikan.nilai.update', $santri->id) }}" method="POST">
				                	{{ csrf_field() }}
				                	<input type="hidden" name="_method" value="PUT">

				                	<input type="hidden" name="semester_id" value="{{ $semester_id }}">

				                	<input type="hidden" name="periode_id" value="{{ $periode_id }}">
				                	
					                <table class="table table-hover table-stripped">
					                    <thead>
					                        <tr>
					                            <th data-field="pelajaran">Nama Pelajaran</th>
					                            <th data-field="mingguan">Mingguan</th>
					                            <th data-field="uts">UTS</th>
					                            <th data-field="uas">UAS</th>
					                            <th data-field="rata">Rata-Rata</th>
					                        </tr>
					                    </thead>
					                    <tbody>
					                    	@if(count($mata_pelajarans) > 0)
						                    	@foreach($mata_pelajarans as $key => $mata_pelajaran)
						                    	<tr>
						                    		<td>
						                    			<span>{{ $mata_pelajaran->matapelajaran['nama_mata_pelajaran'] }}</span>
						                    			<input id="requiredForm" type="hidden" name="mata_pelajaran_id[]" value="{{ $mata_pelajaran->mata_pelajaran_id }}">
						                    		</td>
						                    		<td>
						                    			<input id="requiredForm" type="number" name="nilai_mingguan[]" step="any" class="form-control" autocomplete="off" min="0" max="10" value="{{ $mata_pelajaran->nilai_mingguan }}">
						                    			@if($errors->has('nilai_mingguan[$key]'))
						                    			<span class="help-block">
						                    				<strong>{{ $errors->first('nilai_mingguan[$key]') }}</strong>
						                    			</span>
						                    			@endif
						                    		</td>
						                    		<td>
						                    			<input id="requiredForm" type="number" name="nilai_uts[]" step="any" class="form-control" autocomplete="off" min="0" max="10" value="{{ $mata_pelajaran->nilai_uts }}">
						                    			@if($errors->has('nilai_uts[$key]'))
						                    			<span class="help-block">
						                    				<strong>{{ $errors->first('nilai_uts[$key]') }}</strong>
						                    			</span>
						                    			@endif
						                    		</td>
						                    		<td>
						                    			<input id="requiredForm" type="number" name="nilai_uas[]" step="any" class="form-control" autocomplete="off" min="0" max="10" value="{{ $mata_pelajaran->nilai_uas }}">
						                    			@if($errors->has('nilai_uas[$key]'))
						                    			<span class="help-block">
						                    				<strong>{{ $errors->first('nilai_uas[$key]') }}</strong>
						                    			</span>
						                    			@endif
						                    		</td>
						                    		<td>
						                    			<input type="number" readonly class="form-control" autocomplete="off" value="{{ $mata_pelajaran->rata_rata }}">
						                    		</td>
						                    	</tr>
						                    	@endforeach
						                    @else
						                    	<tr>
						                    		<td colspan="5">
						                    			<div class="text-center">
						                    				<h5>Nilai belum di input</h5>
						                    			</div>
						                    		</td>
						                    	</tr>
						                    @endif
					                    </tbody>
					                </table>
					                <div class="tombolAksi" style="margin-top: 30px;text-align: center;">
					                	@if(count($mata_pelajarans) > 0)
						                    <button type="submit" class="btn btn-success btn-outline">Simpan</button>
						                @endif
					                    <a class="btn btn-danger btn-outline" href="{{ url()->previous() }}#/nilai/pilihsantri/">Kembali</a>
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
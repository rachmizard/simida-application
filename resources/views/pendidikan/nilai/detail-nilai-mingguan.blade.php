@extends('layouts.master-layouts')
@section('content')
			<div class="page-header">
			    <h1 class="page-title">Detail Nilai Mingguan</h1>
			    <ol class="breadcrumb">
			        <li class="breadcrumb-item"><a href="/">Home</a></li>
			        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
			        <li class="breadcrumb-item"><a href="{{ route('pendidikan.nilai.indexNilaiMingguan') }}">Nilai</a></li>
                    <li class="breadcrumb-item"><a href="#">Detail Nilai Mingguan</a></li>
			        <li class="breadcrumb-item active">{{ $santri->nama_santri }}</li>
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
				                        <th data-field="tingkat">tingkat</th>
				                    </tr>
				                </thead>
				                <tbody>
				                    <tr>
				                        <td>{{ $santri->nis }}</td>
                                        <td>{{ $santri->nama_santri }}</td>
                                        <td>{{ $santri->kelas['nama_kelas'] }}</td>
				                        <td> <span class="badge badge-md badge-success">{{ $santri->tingkat['nama_tingkatan'] }}</span> </td>
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
                    @if(session('messageError'))
                    <div class="alert dark alert-alt alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      {{ session('messageError') }}
                    </div>
                    @endif
				    <div class="row row-lg">
				            <div class="col-md-7">
				                <h4 class="example-title"><i class="icon wb-eye"></i> Detail Nilai Mingguan Bulan Ke-{{ $bulan_ke }} Minggu Ke-{{ $minggu_ke }}</h4>
				                <p>Mata Pelajaran di tampilkan berdasarkan tingkat <span class="badge badge-sm badge-success">{{ $santri->tingkat['nama_tingkatan'] }}</span> </p>
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
					                    			<span>{{ $mata_pelajaran->matapelajaran['nama_mata_pelajaran'] }}</span>
					                    		</td>
					                    		<td>
					                    			<input type="number" value="{{ $mata_pelajaran->jumlah_nilai }}" min="0" max="10" step="any" class="form-control" autocomplete="off" disabled>
					                    		</td>
					                    	</tr>
					                    	@endforeach
					                    </tbody>
					                </table>
					                <div class="tombolAksi" style="margin-top: 30px;text-align: center;">
                                        <input type="hidden" name="periode" value="{{ $periode_id }}">
					                </div><!--/.tombolAksi-->
				                </form>
				            </div><!--/.row-->
				            <div class="col-md-4">
				                <h4 class="example-title">Resume Nilai Mingguan Bulan <span class="badge badge-md badge-success">Ke-{{ $bulan_ke }}</span> Minggu <span class="badge badge-md badge-success">Ke-{{ $minggu_ke }}</span></h4>
					                <table class="table table-hover table-stripped">
					                    <tbody>
					                        <tr>
                                                <th>Nilai Rata-Rata</th>
					                            <td>90</td>
					                        </tr>
                                            <tr>
                                                <th> <span class="badge badge-primary badge-bg">Nilai Tertinggi</span> </th>
					                            <td>90 (Tauhid Rancang)</td>
                                            </tr>
                                            <tr>
                                                <th><span class="badge badge-danger badge-bg">Nilai Terendah</span></th>
					                            <td>20 (Tarikh Rancang)</td>
                                            </tr>
					                    </tbody>
					                </table>
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

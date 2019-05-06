@extends('layouts.master-layouts')
@section('content')
	<div id="app">
    	<div class="page-header">
    	    <h1 class="page-title">Pilih Tanggal (Edit)</h1>
    	    <ol class="breadcrumb">
    	        <li class="breadcrumb-item"><a href="/">Home</a></li>
    	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
                <li class="breadcrumb-item"><a href="#">Absensi</a></li>
                <li class="breadcrumb-item"><a href="#">Pilih Tanggal Absensi (Edit)</a></li>
    	        <li class="breadcrumb-item active">Pilih Tanggal (Edit)</li>
    	    </ol>
    	</div>
		<div class="row">
			<div class="col-md-8">
		      <div class="panel">
		        <header class="panel-heading">
		          <h3 class="panel-title"><i class="icon wb-book"></i> Daftar Absensi MP dan Kegiatan {{ $santri->nama_santri }} Periode {{ $periode->nama_periode }}</h3>
		        </header>
		        <div class="panel-body table-responsive">
		          <table class="table table-hover dataTable table-bordered table-striped w-full" id="listHariByFilterDataTables">
		            <thead>
		              <tr>
                        <th>No</th>
						<th>Tanggal</th>
						<th>Status Absen Mata Pelajaran</th>
                        <th>Status Absen Kegiatan</th>
		                <th>Aksi Absen</th>
		              </tr>
		            </thead>
		            <tbody>
						@foreach($realmonths as $key => $realmonth)
						<tr>
							<td>{{ $key+1 }}</td>
							<td>{{ $realmonth['tgl'] }}</td>
							<td>
								@if($realmonth['status_absen']['mata_pelajaran_percentage'] > 50)
									<span class="badge badge-md badge-primary">{{ $realmonth['status_absen']['mata_pelajaran_percentage'] }}</span>
								@elseif($realmonth['status_absen']['mata_pelajaran_percentage'] == 100)
									<span class="badge badge-md badge-success">{{ $realmonth['status_absen']['mata_pelajaran_percentage'] }}</span>
								@elseif($realmonth['status_absen']['mata_pelajaran_percentage'] < 50)
									<span class="badge badge-md badge-warning">{{ $realmonth['status_absen']['mata_pelajaran_percentage'] }}</span>
								@endif
							</td>
							<td>
								@if($realmonth['status_absen']['kegiatan_percentage'] > 50)
									<span class="badge badge-md badge-primary">{{ $realmonth['status_absen']['kegiatan_percentage'] }}</span>
								@elseif($realmonth['status_absen']['kegiatan_percentage'] == 100)
									<span class="badge badge-md badge-success">{{ $realmonth['status_absen']['kegiatan_percentage'] }}</span>
								@elseif($realmonth['status_absen']['kegiatan_percentage'] < 50)
									<span class="badge badge-md badge-warning">{{ $realmonth['status_absen']['kegiatan_percentage'] }}</span>
								@endif
							</td>
							<td>
								<div class="btn-group">
									<form action="{{ route('pendidikan.absen.viewEditAbsen', $santri->id) }}" method="GET">
		                                {{ csrf_field() }}
		                                <input type="hidden" name="periode" value="{{ $periode->id }}">
										<input type="hidden" name="semester_id" value="{{ $semester->id }}">
		                                <input type="hidden" name="kelas_id" value="{{ $santri->kelas_id }}">
										<input type="hidden" name="tgl_absen" value="{{ $realmonth['tgl_original'] }}">
		                                <div class="form-row col-md-6 text-center">
		                                    <button type="submit" class="btn btn-primary btn-sm"> Edit Absen</button>
		                               </div>
		                            </form>
									<form action="{{ route('pendidikan.absen.deleteBulkAbsen', $santri->id) }}" method="POST">
		                                {{ csrf_field() }}
										{{ method_field('DELETE') }}
		                                <input type="hidden" name="periode" value="{{ $periode->id }}">
										<input type="hidden" name="semester_id" value="{{ $semester->id }}">
		                                <input type="hidden" name="kelas_id" value="{{ $santri->kelas_id }}">
										<input type="hidden" name="tgl_absen" value="{{ $realmonth['tgl_original'] }}">
		                                <div class="form-row col-md-6 text-center">
		                               </div>
									   <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Jika anda lanjutkan absensi mata pelajaran & kegiatan akan ikut terhapus pada data tersebut, lanjutkan?')"> Hapus</button>
		                            </form>
								</div>
							</td>
						</tr>
						@endforeach
		            </tbody>
		          </table>
		        </div>
		      </div>
			</div>
		</div>
	</div>
@push('otherJavascript')
<script type="text/javascript">
    $(function(){
         var table = $('#listHariByFilterDataTables').DataTable();
    });
</script>
@endpush
@endsection

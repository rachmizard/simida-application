@extends('layouts.master-layouts')
@section('content')
	<div id="app">
    	<div class="page-header">
    	    <h1 class="page-title">Absensi</h1>
    	    <ol class="breadcrumb">
    	        <li class="breadcrumb-item"><a href="/">Home</a></li>
    	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
                <li class="breadcrumb-item active">Absensi</li>
    	    </ol>
    	</div>
		<div class="row">
			<div class="col-md-4">
		      <div class="panel">
		        <header class="panel-heading">
		          <h3 class="panel-title"><i class="icon wb-search"></i> Filter Santri</h3>
		        </header>
		        <div class="panel-body">
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="form-group col-md-12">
      		            <label for="">Periode</label>
                          <select class="form-control" name="periode">
                              @foreach($periods as $period)
                                  <option value="{{ $period->id }}" {{ $periode['id'] == $period->
      								id ? 'selected' : ''
      							 }}>{{ $period->nama_periode }}</option>
                              @endforeach
                          </select>
      		          </div>
                        <div class="form-group col-md-12">
                            <label for="">Semester</label>
                              <select class="form-control" name="semester_id">
                                  @foreach($semesters as $semester)
                                      <option value="{{ $semester->id }}" {{ $semester_id['id'] == $semester->
      									id ? 'selected' : ''
      								 }}>{{ $semester->tingkat_semester }}</option>
                                  @endforeach
                              </select>
                        </div>
                        <div class="form-group col-md-12">
                              <div class="form-control-label col-2">Tingkat</div>
                                  <select class="form-control" name="tingkat_id" id="tingkatTrigger">
                                      @foreach($grades as $grade)
                                          <option value="{{ $grade->id }}" {{ $tingkat_id['id'] == $grade->
          									id ? 'selected' : ''
          								 }}>{{ $grade->nama_tingkatan }}</option>
                                      @endforeach
                                  </select>
                          </div><!--/.form-inline-->
                        <div class="form-group col-md-12">
                              <div class="form-control-label col-2">Kelas</div>
                                  <select class="form-control" name="kelas_id" style="width: 100%;">
                                  </select>
                          </div><!--/.form-inline-->
      		          <div class="form-group col-md-12">
      		            <button class="btn btn-sm btn-primary"><i class="icon wb-search"></i> Filter</button>
      		          </div>
                    </form>
		        </div>
		      </div>
			</div>
			<div class="col-md-8">
		      <div class="panel">
		        <header class="panel-heading">
		          <h3 class="panel-title"><i class="icon wb-book"></i> Data Santri Hasil Pencarian</h3>
                    @if(session('messageSuccess'))
                        <div class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <i class="icon wb-check" aria-hidden="true"></i> {{ session('messageSuccess') }}</a>
                        </div>
                    @endif
		        </header>
		        <div class="panel-body table-responsive">
		          <table class="table table-hover table-bordered dataTable table-striped w-full" id="santriTable">
		            <thead>
		              <tr>
                        <th>No</th>
                        <th width="20%">Nama Santri</th>
		                <th width="5%">NIS</th>
		                <th width="20%">Kelas</th>
		                <th width="20%">Semester</th>
		                <th width="20%">Tahun Masuk</th>
		                <th width="20%">Aksi Absen</th>
		              </tr>
		            </thead>
		            <tbody>
                        @if(isset($realresults))
                        @foreach($realresults as $key => $realresult)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $realresult['nama_santri'] }}</td>
                            <td>{{ $realresult['nis'] }}</td>
                            <td>{{ $realresult['kelas'] }}</td>
                            <td>{{ $realresult['semester'] }}</td>
                            <td>{{ $realresult['tgl_masuk'] }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('pendidikan.absen.tambahAbsenLaluPilihTanggalAbsen', [$realresult['id'], $periode_a, $semester_b, $kelas_c, $tingkat_d]) }}" class="btn btn-round btn-sm btn-outline btn-success mb-2" title="Tambah Absen">
                                        <i class="icon wb-plus" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('pendidikan.absen.detailAbsenLaluPilihTanggalAbsen', [$realresult['id'], $periode_a, $semester_b, $kelas_c, $tingkat_d]) }}" class="btn btn-round btn-sm btn-outline btn-primary mb-2" title="Detil Absen">
                                        <i class="icon wb-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('pendidikan.absen.editAbsenLaluPilihTanggalAbsen', [$realresult['id'], $periode_a, $semester_b, $kelas_c, $tingkat_d]) }}" class="btn btn-round btn-sm btn-outline btn-warning mb-2" title="Edit Absen">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
		            	<tr>
		            		<td colspan="10">
		            			<div class="text-center">
		            				<span><i class="icon wb-search"></i> Filter terlebih dahulu untuk mencari data</span>
		            			</div>
		            		</td>
		            	</tr>
                        @endif
		            </tbody>
		          </table>
		        </div>
		      </div>
			</div>
		</div>
	</div>
    @push('otherJavascript')
    <script type="text/javascript">
    	$(document).ready(function(){
            $('#tingkatTrigger').on('change', function(){
                var tingkat_id = $(this).val();
                  if (tingkat_id) {
                    $.ajax({
                      url: 'kelas/'+ tingkat_id +'/tingkat',
                      type: "GET",
                      dataType: "json",
                      success:function(dataKelas){
                        $('select[name="kelas_id"]').empty();
                        $.each(dataKelas, function(key, value) {
                            $('select[name="kelas_id"]').append('<option value="'+ value.id +'">'+ value.text +'</option>');
                        });
                      }
                    });
                  }else{
                      $('select[name="kelas_id"]').empty();
                  }
            })
    	});
    </script>
    @endpush
@endsection

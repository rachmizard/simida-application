@extends('layouts.master-layouts')
@section('content')

<div id="app">
	<div class="page-header">
    	<h1 class="page-title">Input Nilai Mingguan</h1>
    	<ol class="breadcrumb">
    	    <li class="breadcrumb-item"><a href="/">Home</a></li>
    	    <li class="breadcrumb-item"><a href="#">Pendidikan</a></li>
    	    <li class="breadcrumb-item active">Input Nilai Mingguan </li>
    	</ol>
    </div>
    <div class="panel">
    	<div class="panel-body container-fluid" style="background-color: #fdfdfd;">
			@if(session('messageSuccess'))
			<div class="alert dark alert-alt alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session('messageSuccess') }}
            </div>
			@elseif(session('messageError'))
			<div class="alert dark alert-alt alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session('messageError') }}
            </div>
			@endif
    	    <div class="row row-lg">
    	        <div class="col-md-12">
    	        	 <h4 class="example-title"><i class="icon wb-search"></i> Filter Santri</h4>
    				<p>Menampilkan Santri berdasarkan hasil pencarian. </p>
    	            <form autocomplete="off" method="POST">
                        {{ csrf_field() }}
    		            <div class="form-row">
    		                <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
    		                    <div class="form-group">
    		                        <div class="form-control-label col-2">Periode</div>
                                    <select class="form-control" name="periode">
                                        @foreach($periods as $period)
                                            <option value="{{ $period->id }}" {{ $periode['id'] == $period->
												id ? 'selected' : ''
											 }}>{{ $period->nama_periode }}</option>
                                        @endforeach
                                    </select>
    		                    </div><!--/.form-inline-->
    		                    <div class="form-group">
    		                        <div class="form-control-label col-2">Semester</div>
                                        <select class="form-control" name="semester_id">
                                            @foreach($semesters as $semester)
                                                <option value="{{ $semester->id }}" {{ $semester_id['id'] == $semester->
													id ? 'selected' : ''
												 }}>{{ $semester->tingkat_semester }}</option>
                                            @endforeach
                                        </select>
    		                    </div><!--/.form-inline-->
    		                </div><!--/.form-group =========================-->
    		                 <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
    		                    <div class="form-group">
    		                        <div class="form-control-label col-2">Tingkat</div>
                                        <select class="form-control" name="tingkat_id" id="tingkatTrigger">
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}" {{ $tingkat_id['id'] == $grade->
													id ? 'selected' : ''
												 }}>{{ $grade->nama_tingkatan }}</option>
                                            @endforeach
                                        </select>
    		                    </div><!--/.form-inline-->
    		                    <div class="form-group">
    		                        <div class="form-control-label col-2">Kelas</div>
                                        <select class="form-control" name="kelas_id" style="width: 100%;">
                                        </select>
    		                    </div><!--/.form-inline-->
    		                    <div class="form-group">
    		                        <div class="form-control-label col-2"></div>
    		                        <button type="submit" class="btn btn-sm btn-info col-md-12"><i class="icon wb-search"></i> Cari</button>
    		                    </div><!--/.form-inline-->
    		                </div><!--/.form-group =========================-->

    		             </div><!--/.form-row-->
    	            </form>
    	        </div><!--/.col-->
    	    </div>
    	</div><!--/.panel-body-->
    	</div><!--/.panel -->

    	<div class="panel">
    		<div class="panel-body container-fluid" style="background-color: #fdfdfd;">
    		    <div class="row row-lg">
    		       <div class="col-md-12">
					   @if($periode != null)
    		           <h4 class="example-title"><i class="icon wb-user"></i> List Nilai Santri Periode <span class="badge badge-bg badge-success">{{ $periode->nama_periode }}</span> Semester <span class="badge badge-bg badge-success">{{ $semester_id->tingkat_semester }}</span> Kelas <span class="badge badge-bg badge-success">{{ $kelas_id->nama_kelas }}</span> </h4>
					   @else
					   <h4 class="example-title"><i class="icon wb-user"></i> List Santri</h4>
					   @endif
    		            <table class="table table-striped table-hover table-bordered">
    		                <thead>
    		                    <tr>
    		                        <th>NIS</th>
    		                        <th>Nama Santri</th>
									<th>Kelas</th>
    		                        <th>Aksi</th>
    		                    </tr>
    		                </thead>
    		                <tbody>
                                @if(isset($realresults))
                                    @if(count($realresults))
                                        @foreach($realresults as $realresult)
                                            <tr>
                                                <td>{!! $realresult['nis'] !!}</td>
                                                <td>{!! $realresult['nama_santri'] !!}</td>
												<td>{!! $realresult['kelas'] !!}</td>
                                                <td>
                                                    <!-- TAMBAH BUTTON NILAI MINGGUAN -->
                                                    <form action="{{ route('pendidikan.nilai.inputBulanDanMinggu', $realresult['id']) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="periode" value="{{ $periode->id }}">
                                                        <input type="hidden" name="semester_id" value="{{ $semester_id->id }}">
                                                        <input type="hidden" name="tingkat_id" value="{{ $tingkat_id->id }}">
                                                        <input type="hidden" name="kelas_id" value="{{ $kelas_id->id }}">
                                                        <button type="submit" class="btn btn-sm btn-success mb-2" name="button">
                                                            <i class="icon wb-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
													<a href="{{ route('pendidikan.nilai.detailInputBulanDanMinggu', [$realresult['id'], $periode->id, $semester_id->id, $kelas_id->id]) }}" class="btn btn-sm btn-primary mb-2"><i class="icon wb-eye"></i> </a>
	                                                    <!-- EDIT BUTTON NILAI MINGGUAN -->
														<form action="{{ route('pendidikan.nilai.editInputBulanDanMinggu', $realresult['id']) }}" method="POST">
	                                                        {{ csrf_field() }}
	                                                        <input type="hidden" name="periode" value="{{ $periode->id }}">
	                                                        <input type="hidden" name="semester_id" value="{{ $semester_id->id }}">
	                                                        <input type="hidden" name="tingkat_id" value="{{ $tingkat_id->id }}">
	                                                        <input type="hidden" name="kelas_id" value="{{ $kelas_id->id }}">
	                                                        <button type="submit" class="btn btn-sm btn-warning mb-2" name="button">
	                                                            <i class="icon wb-pencil" aria-hidden="true"></i>
	                                                        </button>
	                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">
                                                <div class="text-center">
                                                    <h4><i class="icon wb-search"></i> Data tidak ditemukan/kosong.</h4>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @else
                                <tr>
                                    <td colspan="10">
			                    		<div class="text-center">
			                    			<h4><i class="icon wb-search"></i> Silahkan lakukan filter untuk menampilkan data.</h4>
			                    		</div>
			                    	</td>
                                </tr>
                                @endif
    		                </tbody>
    		            </table>
    		       </div><!--/.row-->
    		   </div>
    		</div><!--/.panel-body-->
    	</div><!--/.panel -->
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

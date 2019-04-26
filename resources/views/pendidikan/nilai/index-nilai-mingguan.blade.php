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
                                            <option value="{{ $period->id }}">{{ $period->nama_periode }}</option>
                                        @endforeach
                                    </select>
    		                    </div><!--/.form-inline-->
    		                    <div class="form-group">
    		                        <div class="form-control-label col-2">Semester</div>
                                        <select class="form-control" name="semester_id">
                                            @foreach($semesters as $semester)
                                                <option value="{{ $semester->id }}">{{ $semester->tingkat_semester }}</option>
                                            @endforeach
                                        </select>
    		                    </div><!--/.form-inline-->
    		                </div><!--/.form-group =========================-->
    		                 <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
    		                    <div class="form-group">
    		                        <div class="form-control-label col-2">Tingkat</div>
                                        <select class="form-control" name="tingkat_id">
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->nama_tingkatan }}</option>
                                            @endforeach
                                        </select>
    		                    </div><!--/.form-inline-->
    		                    <div class="form-group">
    		                        <div class="form-control-label col-2">Kelas</div>
                                        <select class="form-control" name="kelas_id">
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->nama_kelas }}</option>
                                            @endforeach
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
    		           <h4 class="example-title"><i class="icon wb-user"></i> List Santri</h4>
    		            <table class="table table-striped table-hovered">
    		                <thead>
    		                    <tr>
    		                        <th>NIS</th>
    		                        <th>Nama Santri</th>
    		                        <th>Kelas</th>
    		                        <th>Status</th>
    		                        <th></th>
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
                                                @if($realresult['status_nilai'] == 'Belum')
                                                <td>
                                                    <form class="" action="" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="periode" value="{{ isset($periode) ? $periode : null }}">
                                                        <input type="hidden" name="semester_id" value="{{ isset($semester_id) ? $semester_id : null }}">
                                                        <input type="hidden" name="tingkat_id" value="{{ isset($tingkat_id) ? $tingkat_id : null }}">
                                                        <input type="hidden" name="kelas_id" value="{{ isset($kelas_id) ? $kelas_id : null }}">
                                                        <button type="submit" class="btn btn-round btn-sm btn-outline btn-success mb-2" name="button">
                                                            <i class="icon wb-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endif
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

@endsection

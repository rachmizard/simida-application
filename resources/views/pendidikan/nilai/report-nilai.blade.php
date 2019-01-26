@extends('layouts.master-layouts')
@section('content')

<div class="page-header">
    <h1 class="page-title">Laporan Nilai Santri</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a></li>
        <li class="breadcrumb-item active">Laporan Nilai Santri</li>
    </ol>
</div>
<!--/.page-header-->
<div class="panel">
    <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
        <div class="row row-lg">
            <div class="col-md-12">
            	<h4 class="example-title"><i class="icon wb-search"></i> Filter Nilai Santri</h4>
            	<p>Menampilkan hasil nilai santri.</p>
                <form autocomplete="off" method="POST">
                	{{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                        <div class="form-group form-inline">
                            <div class="form-control-label col-2">Periode</div>
                            <select name="periode_id" class="form-control selectTo col">
                                    	@foreach($periodes as $in)
                                        	<option value="{{ $in->id }}" @if($in->id == $periode) selected @endif>{{ $in->nama_periode }}</option>
                                        @endforeach
                                    <option disabled>Pilih Periode</option>
                            </select>
                        </div><!--/.form-inline-->
                        <div class="form-group form-inline">
                            <div class="form-control-label col-2">Semester</div>
                            <select class="form-control selectTo col" name="semester_id" style="">
                            	@foreach($semesters as $in)
                                	<option value="{{ $in->id }}" @if($in->id == $semester) selected @endif>{{ $in->tingkat_semester }}</option>
                                @endforeach
                                    <option disabled>Pilih Semester</option>
                            </select>
                        </div><!--/.form-inline-->
                    </div><!--/.form-group =========================-->
                     <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                        <div class="form-group form-inline">
                            <div class="form-control-label col-2">Tingkat</div>
                            <select class="form-control selectTo col" name="tingkat_id" style="">
                            	@foreach($tingkats as $in)
                            		<option value="{{ $in->id }}" @if($in->id == $tingkat) selected @endif>{{ $in->nama_tingkatan }}</option>
                            	@endforeach
                                <option disabled>Pilih Tingkat</option>
                            </select>
                        </div><!--/.form-inline-->
                        <div class="form-group form-inline">    
                            <div class="form-control-label col-2">Kelas</div>
                            <select class="form-control selectTo col" style="" name="kelas_id">
                            	@foreach($kelass as $in)
                            		<option value="{{ $in->id }}" @if($in->id == $kelas) selected @endif>{{ $in->nama_kelas }}</option>
                            	@endforeach
                            <option disabled>Pilih Kelas</option>
                            </select>
                        </div><!--/.form-inline-->
                    </div><!--/.form-group =========================-->
                    <div class="form-group">
                    	<button type="submit" class="btn btn-md btn-info"><i class="icon wb-search"></i> Filter Hasil Nilai</button>
                    </div>
                    
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
	           <h4 class="example-title">Laporan Santri kelas {!! DB::table('kelas')->whereId($kelas)->first()->nama_kelas !!} </h4>
	           <div class="btn-group hidden-sm-down" id="exampleToolbar" role="group" style="margin-bottom: 20px;">

	           		<form action="{!! route('pendidikan.nilai.exportNilai') !!}">
	           			<input type="hidden" name="semester_id" value="{!! isset($semester) ? $semester : '' !!}">
	           			<input type="hidden" name="periode_id" value="{!! isset($periode) ? $periode : '' !!}">
	           			<input type="hidden" name="tingkat_id" value="{!! isset($tingkat) ? $tingkat : '' !!}">
	           			<input type="hidden" name="kelas_id" value="{!! isset($kelas) ? $kelas : '' !!}">
		                <button type="submit" class="btn btn-outline btn-success">
		                    <i class="icon wb-file" aria-hidden="true"></i> Export Excel
		                </button>
	           		</form>
	           		
	            </div>
	            <div class="table-responsive-lg">
	                <table class="striped table-design" data-toggle="tabl" data-height="400" data-mobile-responsive="true">
	                    <thead>
	                        <tr>
	                            <th rowspan="2" colspan="1">No</th>
	                            <th rowspan="2" colspan="1">Nama</th>
	                            <th rowspan="1" colspan="100">Nilai Rapot</th>
	                        </tr>
	                        <tr>
	                        	@if(isset($mapelByTingkat))
		                        	@foreach($mapelByTingkat as $mapel)
		                            	<th rowspan="1" colspan="1" class="hanzo">{!! $mapel->nama_mata_pelajaran !!} <span>{!! $mapel->bobot !!}</span></th>
		                            @endforeach
		                        @endif
		                        @if(isset($mapelByTingkat))
	                           	 <th rowspan="1" colspan="{!! count($mapelByTingkat) !!}" class="index-pres">INDEK PRESTASI NILAI RAPORT</th>
	                            @endif
	                            <th rowspan="1" colspan="1">Jumlah Nilai</th>
	                            <th rowspan="1" colspan="1">Jmlah Nilai X Bobot {!! isset($total_bobot) ? $total_bobot : '' !!}</th>
	                            <th rowspan="1" colspan="1" class="Ip-asli">IP Asli</th>
	                            <th rowspan="1" colspan="1">Rata-Rata</th>
	                            <th rowspan="1" colspan="1">Predikat</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@if(isset($santri))

								@php($rata_rata = 0)
								@php($nilai = 0)
								@php($predikat = '')

		                    	@foreach($santri as $key => $value)
								
		                        <tr>
		                            <td>{!! $loop->iteration !!}</td>
		                            <td>{!! $value->nama_santri !!}</td>

		                            @foreach($mapelByTingkat as $in)
		                            	<td>
		                            		{!! 
		                            		DB::table('nilai')->whereSantriId($value->id)
		                    					 ->whereSemesterId($semester)
		                    					 ->wherePeriodeId($periode)
		                    					 ->whereMataPelajaranId($in->id)->value('rata_rata') 
		                    				!!}
		                    			</td>
		                            @endforeach

		                            @foreach($mapelByTingkat as $pn)
		                            	<td class="index-pres">
		                            		{!! 
		                            			DB::table('nilai')->whereSantriId($value->id)
		                    					 ->whereSemesterId($semester)
		                    					 ->wherePeriodeId($periode)
		                    					 ->whereMataPelajaranId($pn->id)->value('ip_ujian') 
		                    				!!}
		                            	</td>
		                            @endforeach

		                            <td>
		                            {!! 
		                            	DB::table('nilai')->whereSantriId($value->id)
		                    					 ->whereSemesterId($semester)
		                    					 ->wherePeriodeId($periode)
		                    					 ->sum('rata_rata')
		                    		!!}
		                    		</td>
		                            <td>
		                            {!! 
		                            	DB::table('nilai')->whereSantriId($value->id)
		                    					 ->whereSemesterId($semester)
		                    					 ->wherePeriodeId($periode)
		                    					 ->sum('ip_ujian')
		                    		!!}
		                    		</td>
		                            <td class="Ip-asli">
		                            	@php($nilai = DB::table('nilai')->whereSantriId($value->id)
	                    					 ->whereSemesterId($semester)
	                    					 ->wherePeriodeId($periode)
	                    					 ->sum('ip_ujian') / $total_bobot)
		                           	{!! 
	                            		number_format((float)$nilai, 2, '.', '')
		                    		!!}
		                            </td>
		                            <td>
		                            	@php($rata_rata = DB::table('nilai')->whereSantriId($value->id)
		                    					 ->whereSemesterId($semester)
		                    					 ->wherePeriodeId($periode)
		                    					 ->sum('rata_rata') / count($mapelByTingkat))
		                            	{!!	
		                            		number_format((float)$rata_rata, 2, '.', '')
		                            	!!}
		                        	</td>
		                            <td>
		                            	@php($predikat = 
		                            			DB::table('predikat')
		                            			->where('nilai_maksimal', '>=', $nilai)
		                            			->first()->keterangan)

		                            	@switch($predikat)
		                            		@case('Tidak Lulus')
				                            	<span class="level4">
				                            		Tidak Lulus
				                            	</span>
				                            @break

				                            @case('Buruk Sekali')
				                            	<span class="level4">
				                            		Buruk Sekali
				                            	</span>
				                            @break

				                            @case('Buruk')
				                            	<span class="level3">
				                            		Buruk
				                            	</span>
				                            @break

				                            @case('Cukup')
				                            	<span class="level3">
				                            		Cukup
				                            	</span>
				                            @break

				                            @case('Baik')
				                            	<span class="level2">
				                            		Baik
				                            	</span>
				                            @break

				                            @case('Baik Sekali')
				                            	<span class="level2">
				                            		Baik Sekali
				                            	</span>
				                            @break

				                            @default
				                            	<span class="level1">
				                            		Istimewa
				                            	</span>
				                        @endswitch
		                        	</td>
		                        </tr>
		                        @endforeach
		                    @else
		                    <tr>
		                    	<td colspan="8">
		                    		<div class="text-center">
		                    			<h4>Data belum ditampilkan.</h4>
		                    		</div>
		                    	</td>
		                    </tr>
	                        @endif
	                    </tbody>
	                </table>   
	            </div><!--/.table-responsive-lg-->
	            
	       </div><!--/.row-->
	   </div>
	</div><!--/.panel-body-->
</div><!--/.panel -->
@endsection
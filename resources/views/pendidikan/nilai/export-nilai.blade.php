<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	
	<title>Laporan Nilai Santri</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/tableDesign.css">    

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
	<table class="striped table-design" data-toggle="tabl" data-height="400" data-mobile-responsive="true">
    <thead>
        <tr>
            <th rowspan="2" colspan="1">No</th>
            <th rowspan="2" colspan="1">Nama</th>
            <th rowspan="1" colspan="100">Nilai Rapot</th>
        </tr>
        <tr>
        	@foreach($mapelByTingkat as $mapel)
            	<th rowspan="1" colspan="1" class="hanzo">{{ $mapel->nama_mata_pelajaran }} <span>{{ $mapel->bobot }}</span></th>
            @endforeach
           	 <th rowspan="1" colspan="{{ count($mapelByTingkat) }}" class="index-pres">INDEK PRESTASI NILAI RAPORT</th>
            <th rowspan="1" colspan="1">Jumlah Nilai</th>
            <th rowspan="1" colspan="1">Jmlah Nilai X Bobot {{ isset($total_bobot) ? $total_bobot : '' }}</th>
            <th rowspan="1" colspan="1" class="Ip-asli">IP Asli</th>
            <th rowspan="1" colspan="1">Rata-Rata</th>
            <th rowspan="1" colspan="1">Predikat</th>
        </tr>
    </thead>
    <tbody>

			@php($rata_rata = 0)
			@php($nilai = 0)
			@php($predikat = '')

        	@foreach($santri as $key => $value)
			
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->nama_santri }}</td>

                @foreach($mapelByTingkat as $in)
                	<td>
                		{{ 
                		DB::table('nilai')->whereSantriId($value->id)
        					 ->whereSemesterId($semester)
        					 ->wherePeriodeId($periode)
        					 ->whereMataPelajaranId($in->id)->value('rata_rata') 
        				}}
        			</td>
                @endforeach

                @foreach($mapelByTingkat as $pn)
                	<td class="index-pres">
                		{{ 
                			DB::table('nilai')->whereSantriId($value->id)
        					 ->whereSemesterId($semester)
        					 ->wherePeriodeId($periode)
        					 ->whereMataPelajaranId($pn->id)->value('ip_ujian') 
        				}}
                	</td>
                @endforeach

                <td>
                {{
                	DB::table('nilai')->whereSantriId($value->id)
        					 ->whereSemesterId($semester)
        					 ->wherePeriodeId($periode)
        					 ->sum('rata_rata')
                
        		}}
        		</td>
                <td>
                {{ 
                	DB::table('nilai')->whereSantriId($value->id)
        					 ->whereSemesterId($semester)
        					 ->wherePeriodeId($periode)
        					 ->sum('ip_ujian')
        		}}
        		</td>
                <td class="Ip-asli">
                	@php($nilai = DB::table('nilai')->whereSantriId($value->id)
    					 ->whereSemesterId($semester)
    					 ->wherePeriodeId($periode)
    					 ->sum('ip_ujian') / $total_bobot)
               	{{ 
            		number_format((float)$nilai, 2, '.', '')
        		}}
                </td>
                <td>
                	@php($rata_rata = DB::table('nilai')->whereSantriId($value->id)
        					 ->whereSemesterId($semester)
        					 ->wherePeriodeId($periode)
        					 ->sum('rata_rata') / count($mapelByTingkat))
                	{{	
                		number_format((float)$rata_rata, 2, '.', '')
                	}}
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
    </tbody>
</table>
</body>
</html>
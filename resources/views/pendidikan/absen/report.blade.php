@extends('layouts.master-layouts')
@section('content')
        <div class="row">
            <div class="col-md-12">                
                <div class="panel">
                    <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                        <div class="row row-lg">
                            <div class="col-md-12">
                                <form method="GET" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                        <h4 class="example-title"><i class="icon wb-search"></i> Filter Data Absen</h4>
                                            <div class="example">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                           <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-home"></i> Asrama</label>
                                                           <select name="asrama_id" class="form-control selectTo" id="">
                                                            <option selected></option>
                                                            @foreach($asramas as $asrama)
                                                               <option value="{{ $asrama->id }}">{{ $asrama['ngaran']['nama'] }}</option>
                                                            @endforeach
                                                           </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                           <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-book"></i> Kelas</label>
                                                           <select name="kelas_id" class="form-control selectTo" id="">
                                                            <option selected></option>
                                                            @foreach($kelass as $kelas)
                                                               <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                                            @endforeach
                                                           </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-calendar"></i> Tanggal Awal</label>
                                                            <input type="text" name="start_date" class="form-control datepicker" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-calendar"></i> Tanggal Akhir</label>
                                                            <input type="text" name="end_date" class="form-control datepicker" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Rekap</button>
                                               </div>
                                            </div><!--/Example-->
                                    </div><!--/.form-group
                                    =========================-->
                                 </div><!--/.form-row-->
                                </form>
                            </div><!--/.col-->
                        </div>
                    </div>
                </div>
            </div>
            @if(count($start_date) > 0 || count($end_date) > 0)
            <div class="col-md-12">                
                <div class="panel">
                    <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                        <h4 class="example-title"><i class="icon wb-random"></i> Hasil Perekapan Absensi </h4> <span class="badge badge-success">{!! \Carbon\Carbon::parse($start_date)->format('d-m-Y') !!}</span> sampai <span class="badge badge-success">{!! \Carbon\Carbon::parse($end_date)->format('d-m-Y') !!}</span>
                        <div class="row row-lg">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th rowspan="2">NIS</th>
                                        <th rowspan="2">Nama Santri</th>
                                        @foreach($listKegiatans as $listKegiatan)
                                        <th colspan="3" class="text-center">
                                            {{ $listKegiatan->nama_kegiatan }}
                                        </th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach($listKegiatans as $listKegiatan)
                                            <th border="0" class="bg-info">Hadir</th>
                                            <th border="0" class="bg-dark">Izin</th>
                                            <th border="0" class="bg-danger">Alfa</th>
                                        @endforeach
                                    </tr>
                                    @foreach($listSantris as $listSantri)
                                    <tr>
                                        <td>{{ $listSantri->nis }}</td>
                                        <td>{{ $listSantri->nama_santri }}</td>
                                        @foreach($listKegiatans as $listKegiatan)
                                            <td>

                                                {{ \App\Absen::whereSantriId($listSantri->id)->whereKegiatanId($listKegiatan->id)->whereKeterangan('hadir')->whereBetween('created_at', [$start_date, $end_date])->count() == 0 ? '-' : \App\Absen::whereSantriId($listSantri->id)->whereKegiatanId($listKegiatan->id)->whereKeterangan('hadir')->whereBetween('created_at', [$start_date, $end_date])->count() }} 

                                            </td>
                                            <td>

                                                {{ \App\Absen::whereSantriId($listSantri->id)->whereKegiatanId($listKegiatan->id)->whereKeterangan('izin')->whereBetween('created_at', [$start_date, $end_date])->count() == 0 ? '-' : \App\Absen::whereSantriId($listSantri->id)->whereKegiatanId($listKegiatan->id)->whereKeterangan('izin')->whereBetween('created_at', [$start_date, $end_date])->count() }} 

                                            </td>
                                            <td>

                                                {{ \App\Absen::whereSantriId($listSantri->id)->whereKegiatanId($listKegiatan->id)->whereKeterangan('alfa')->whereBetween('created_at', [$start_date, $end_date])->count() == 0 ? '-' : \App\Absen::whereSantriId($listSantri->id)->whereKegiatanId($listKegiatan->id)->whereKeterangan('alfa')->whereBetween('created_at', [$start_date, $end_date])->count() }} 

                                            </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
@endsection
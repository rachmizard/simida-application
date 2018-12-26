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
                                        <h4 class="example-title"><i class="icon wb-search"></i> Filter Laporan Pengeluaran</h4>
                                            <div class="example">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                           <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-graph-down"></i> Jenis Pengeluaran</label>
                                                           <select name="jenis_pengeluaran" class="form-control selectTo" id="">
                                                            <option value="all">Semua</option>
                                                            @foreach($nama_jenis_pengeluarans as $nama_jenis_pengeluaran)
                                                             <option value="{{ $nama_jenis_pengeluaran->id }}">{{ $nama_jenis_pengeluaran->nama_jenis_pengeluaran }}</option>
                                                             @endforeach
                                                           </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-calendar"></i> Tanggal Awal</label>
                                                            <input type="text" name="start_date" class="form-control datepicker">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-calendar"></i> Tanggal Akhir</label>
                                                            <input type="text" name="end_date" class="form-control datepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <button type="submit" class="btn btn-primary"> Filter</button>
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
            <div class="col-md-12">                
                <div class="panel">
                    <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                        <h4 class="example-title"><i class="icon wb-random"></i> Hasil Laporan Pengeluaran</h4>
                        <div class="row row-lg">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Tanggal Pengeluaran</td>
                                            <td>Jenis Pengeluaran</td>
                                            <td>Nominal Pengeluaran</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @if(count($pengeluarans) > 0)
                                        @foreach($pengeluarans as $pengeluaran)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pengeluaran->tgl_pengeluaran)->format('d-m-Y') }}</td>
                                            <td>{{ $pengeluaran->jenispengeluaran['nama_jenis_pengeluaran'] }}</td>
                                            <td>{{ "Rp. " . number_format($pengeluaran->jumlah_pengeluaran,2,',','.') }}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4" class="text-center"><i class="icon wb-payment"></i> Keuangan Masih Kosong.</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3" class="text-center">Total</td>
                                            <td><span class="badge badge-success"></span>{{ "Rp. " . number_format($money_convert,2,',','.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
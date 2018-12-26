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
                                        <h4 class="example-title"><i class="icon wb-search"></i> Filter Laporan Pemasukan</h4>
                                            <div class="example">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                           <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-graph-up"></i> Jenis Pemasukan</label>
                                                           <select name="jenis_pemasukan" class="form-control selectTo" id="">
                                                            <option value="all">Semua</option>
                                                             <option value="infaq">Infaq</option>
                                                             <option value="donatur">Donatur</option>
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
                        <h4 class="example-title"><i class="icon wb-random"></i> Hasil Laporan Pemasukan</h4>
                        <div class="row row-lg">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Tanggal Pemasukan</td>
                                            <td>Jenis Pemasukan</td>
                                            <td>Nominal Pemasukan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @if(count($pemasukans) > 0)
                                        @foreach($pemasukans as $pemasukan)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pemasukan->tgl_pemasukan)->format('d-m-Y') }}</td>
                                            <td>{{ $pemasukan->jenis_pemasukan }}</td>
                                            <td>{{ "Rp. " . number_format($pemasukan->jumlah_pemasukan,2,',','.') }}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4" class="text-center"><i class="icon wb-payment"></i> Keuangan Masih Kosong.</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3" class="text-center">Total</td>
                                            <td><span class="badge badge-success"></span>{{ $money_convert }}</td>
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
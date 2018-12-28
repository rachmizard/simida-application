@extends('layouts.master-layouts')

@section('content')

<!--Start: Three Card
==============-->
<div class="row">
    <div class="col-xxl-3">
        <div class="row h-full" data-plugin="matchHeight">
            <div class="col-xxl-12 col-lg-4 col-sm-4">
                <div class="card card-shadow card-completed-options">
                    <div class="card-block p-30">
                        <div class="row">
                           <div class="col-6">
                                <img src="/assets/img/avatar/Dual.png" alt="" style="max-height: 80px;">
                            </div><!--/.col-->
                            <div class="col-6">
                                <div class="counter text-left blue-grey-700">
                                    <div class="counter-label mt-10">Total Santri</div>
                                    <div class="counter-number font-size-40 mt-10">{{ $getTotalSantri }}</div>
                                </div>
                            </div><!--/.col-->
                            
                        </div><!--/.row-->
                    </div>
                </div>
            </div>
            <div class="col-xxl-12 col-lg-4 col-sm-4">
                <div class="card card-shadow card-completed-options">
                    <div class="card-block p-30">
                        <div class="row">
                           <div class="col-6">
                                <img src="/assets/img/avatar/VectorPutra.png" alt="" style="max-height: 80px;">
                            </div><!--/.col-->
                            <div class="col-6">
                                <div class="counter text-left blue-grey-700">
                                    <div class="counter-label mt-10">Santri Putra</div>
                                    <div class="counter-number font-size-40 mt-10">{{ $getSantriPutra }}</div>
                                </div>
                            </div><!--/.col-->
                            
                        </div><!--/.row-->
                    </div>
                </div>
            </div>
            <div class="col-xxl-12 col-lg-4 col-sm-4">
                <div class="card card-shadow card-completed-options">
                    <div class="card-block p-30">
                        <div class="row">
                           <div class="col-6">
                                <img src="/assets/img/avatar/VectorPutri.png" alt="" style="max-height: 80px;">
                            </div><!--/.col-->
                            <div class="col-6">
                                <div class="counter text-left blue-grey-700">
                                    <div class="counter-label mt-10">Santri Putri</div>
                                    <div class="counter-number font-size-40 mt-10">{{ $getSantriPutri }}</div>
                                </div>
                            </div><!--/.col-->
                            
                        </div><!--/.row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/.row-->

<div class="row">
    <div class="col-xxl-3">
        <div class="row h-full" data-plugin="matchHeight">
            <div class="col-xxl-12 col-lg-4 col-sm-4">
                <div class="card card-shadow card-completed-options">
                    <div class="card-block p-30">
                        <div class="row">
                           <div class="col-6">
                                <img src="/assets/img/avatar/Monobuilding1.svg" alt="" style="max-height: 80px;">
                            </div><!--/.col-->
                            <div class="col-6">
                                <div class="counter text-left blue-grey-700">
                                    <div class="counter-label mt-10">Ibtida</div>
                                    <div class="counter-number font-size-40 mt-10">{{ $getSantriIbtida }}</div>
                                </div>
                            </div><!--/.col-->
                            
                        </div><!--/.row-->
                    </div>
                </div>
            </div>
            <div class="col-xxl-12 col-lg-4 col-sm-4">
                <div class="card card-shadow card-completed-options">
                    <div class="card-block p-30">
                        <div class="row">
                           <div class="col-6">
                                <img src="/assets/img/avatar/Monobuilding2.svg" alt="" style="max-height: 80px;">
                            </div><!--/.col-->
                            <div class="col-6">
                                <div class="counter text-left blue-grey-700">
                                    <div class="counter-label mt-10">Tsanawi</div>
                                    <div class="counter-number font-size-40 mt-10">{{ $getSantriTsanawi }}</div>
                                </div>
                            </div><!--/.col-->
                            
                        </div><!--/.row-->
                    </div>
                </div>
            </div>
            <div class="col-xxl-12 col-lg-4 col-sm-4">
                <div class="card card-shadow card-completed-options">
                    <div class="card-block p-30">
                        <div class="row">
                           <div class="col-6">
                                <img src="/assets/img/avatar/Monobuilding1.svg" alt="" style="max-height: 80px;">
                            </div><!--/.col-->
                            <div class="col-6">
                                <div class="counter text-left blue-grey-700">
                                    <div class="counter-label mt-10">Mah'ad Aly</div>
                                    <div class="counter-number font-size-40 mt-10">{{ $getSantriMahadAly }}</div>
                                </div>
                            </div><!--/.col-->
                            
                        </div><!--/.row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/.row-->
<!--End: Three Card
==============-->

<!--Start: Table Nilai-->
<div class="panel">
    <div class="panel-body">
        <div class="row row-lg">
            <div class="col-md-6">
                <!-- Example Table For Url -->
                <div class="example-wrap m-sm-0">
                    <h4 class="example-title">Akademik Terendah</h4>
                    <p>Akademik Santri Terendah</p>
                    <div class="example">
                        <table data-toggle="table" data-height="300" data-mobile-responsive="true">
                            <thead>
                                <tr>
                                    <th data-field="no">No</th>
                                    <th data-field="name">Nama Santri</th>
                                    <th data-field="akreditasi">Akreditasi</th>
                                    <th data-field="nilai">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Example Table For Url -->
            </div>

            <div class="col-md-6">
                <!-- Example Table From Data -->
                <div class="example-wrap">
                    <h4 class="example-title">Akhlaq Terendah</h4>
                    <p>-</p>
                    <div class="example">
                        <table data-toggle="table" data-height="300" data-mobile-responsive="true">
                            <thead>
                                <tr>
                                    <th data-field="no">No</th>
                                    <th data-field="name">Name</th>
                                    <th data-field="akreditasi">Akreditasi</th>
                                    <th data-field="nilai">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Example Table From Data -->
            </div>
        </div>
    </div>
</div><!-- End Panel -->
<!--End: Table Nilai-->

<!--Start: Table Data-->
<div class="panel">
    <div class="panel-body">
        <div class="row row-lg">
            <div class="col-md-5">
                <!-- Example Table For Url -->
                <div class="example-wrap m-sm-0">
                    <h4 class="example-title">Santri izin</h4>
                    <p>-Description-</p>
                    <div class="example">
                        <table data-toggle="table" data-height="290" data-mobile-responsive="true">
                            <thead>
                                <tr>
                                    <th data-field="nis">NIS</th>
                                    <th data-field="nama_santri">Nama Santri</th>
                                    <th data-field="tujuan">Tujuan</th>
                                    <th data-field="tgl_izin">Tgl & Jam Izin</th>
                                    <th data-field="tgl_berakhir_izin">Tgl & Jam Selesai</th>
                                    <th data-field="status">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($keamanans as $keamanan)
                                <tr>
                                    <td>{{ $keamanan['santri']['nis'] }}</td>
                                    <td>{{ $keamanan['santri']['nama_santri'] }}</td>
                                    <td>{{ $keamanan['tujuan'] }}</td>
                                    <td>{{ date('d/m/Y H:i:s A', strtotime($keamanan['created_at'])) }}</td>
                                    <td>{{ $keamanan['tgl_berakhir_izin'] == null ? '-' : date('d/m/Y H:i:s A', strtotime($keamanan['tgl_berakhir_izin'])) }}</td>
                                    <td>
                                        @if($keamanan['status'] == 'belum_kembali')
                                            <span class="badge badge-danger">Belum Kembali</span>
                                        @elseif($keamanan['status'] == 'sudah_kembali')
                                            <span class="badge badge-success">Sudah Kembali</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Example Table For Url -->
            </div>

            <div class="col-md-7">
                <!-- Example Table From Data -->
                <div class="example-wrap">
                    <h4 class="example-title">Pendapatan Bulan {{ \Carbon\Carbon::now()->format('F Y') }}</h4>
                    <!-- <p>-Description-</p> -->
                    <div class="example">
                        <!-- <div class="btn-group hidden-sm-down" id="exampleToolbar" role="group">
                            <button type="button" class="btn btn-outline btn-default">
                                <i class="icon wb-plus" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-outline btn-default">
                                <i class="icon wb-heart" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-outline btn-default">
                                <i class="icon wb-trash" aria-hidden="true"></i>
                            </button>
                        </div> -->
                        <table id="exampleTableToolbar" data-mobile-responsive="true">
                            <thead>
                                <tr>
                                    <th>Total Pendapatan</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendapatan->get() as $in)
                                <tr>
                                    <td>
                                        @if($in->jenis_pemasukan == 'syariah')
                                            <span class="badge badge-success">{{ $in->jenis_pemasukan }}</span>
                                        @elseif($in->jenis_pemasukan == 'donatur')
                                            <span class="badge badge-warning">{{ $in->jenis_pemasukan }}</span>
                                        @else
                                            <span class="badge badge-info">{{ $in->jenis_pemasukan }}</span>
                                        @endif
                                    </td>
                                    <td class="content-Rp">{{ "Rp. " .number_format($in->jumlah_pemasukan,2,',','.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Grand Total</th>
                                    <th class="content-Rp">{{ "Rp. " .number_format($sum,2,',','.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!--/.example-->
                </div>
                <!-- End Example Table From Data -->
            </div>
        </div>
    </div>
</div><!-- End Panel -->
<!--End: Table Data-->
@endsection

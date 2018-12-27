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
                    <h4 class="example-title">Akademik Tertinggi</h4>
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
                    <h4 class="example-title">Akhlaq terendah</h4>
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
                                    <th data-field="name">Nama</th>
                                    <th data-field="tanggal">Tanggal</th>
                                    <th data-field="tujuan">Tujuan</th>
                                    <th data-field="durasi">Durasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ilham</td>
                                    <td>10 Maret 2018</td>
                                    <td>Rumah Sakit</td>
                                    <td>1 Hari</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Example Table For Url -->
            </div>

            <div class="col-md-7">
                <!-- Example Table From Data -->
                <div class="example-wrap">
                    <h4 class="example-title">Akhlaq terendah</h4>
                    <p>-Description-</p>
                    <div class="example">
                        <div class="btn-group hidden-sm-down" id="exampleToolbar" role="group">
                            <button type="button" class="btn btn-outline btn-default">
                                <i class="icon wb-plus" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-outline btn-default">
                                <i class="icon wb-heart" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-outline btn-default">
                                <i class="icon wb-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                        <table id="exampleTableToolbar" data-mobile-responsive="true">
                            <thead>
                                <tr>
                                    <th>Total Pendapatan</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Syairah</td>
                                    <td class="content-Rp">500.000.000</td>
                                </tr>
                                <tr>
                                    <td>Infaq</td>
                                    <td class="content-Rp">32.000.000</td>
                                </tr>
                                <tr>
                                    <td>Donatur</td>
                                    <td class="content-Rp">900.000.000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Grand Total</th>
                                    <th class="content-Rp">1.700.000.000</th>
                                </tr>
                                <tr>
                                    <td>Piutang Syairah</td>
                                    <td class="content-Rp">20.000.000</td>
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

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
                        <table id="dashboardAkademik" class="table table-striped table-hovered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Santri</th>
                                    <th>Akreditasi</th>
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
                        <table id="dashboardAkhlaq" class="table table-striped table-hovered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Akreditasi</th>
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
<div class="panel col-md-8">
    <div class="panel-body">
        <div class="row row-lg">
            <div class="col-md-12">
                <!-- Example Table From Data -->
                <div class="example-wrap">
                    <h4 class="example-title">Pembayaran Syahriah  {{ \Carbon\Carbon::now()->format('F Y') }}</h4>
                    <!-- <p>-Description-</p> -->
                    <div class="example">
                        <div class="table-responsive">
                            <table id="dashboardPembayaran" class="table table-striped table-hovered" data-mobile-responsive="true">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nis</th>
                                        <th>Nama Santri</th>
                                        <th>Kelas</th>
                                        <th>Asrama</th>
                                        <th>Status Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div><!--/.example-->
                </div>
                <!-- End Example Table From Data -->
            </div>
        </div>
    </div>
</div><!-- End Panel -->
<!--End: Table Data-->

@push('otherJavascript')
<script type="text/javascript">
$(function(){
     var table = $('#dashboardPembayaran').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{!! route('admin.home.pendapatanSantriDataTables') !!}",
          columns: [
              { data: 'no' },
              { data: 'nis' },
              { data: 'nama_santri'  },
              { data: 'kelas' },
              { data: 'asrama'  },
              { data: 'status_pembayaran'  },
          ]
      });
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var table2 = $('#dashboardAkademik').DataTable({
             processing: true,
             serverSide: true,
             order: [[ 2, "desc" ]],
             ajax: "{!! route('admin.home.akademikTerendah') !!}",
             columns: [
                 { data: 'no', orderable: false },
                 { data: 'nama_santri', orderable: false  },
                 { data: 'akreditasi.predikat' },
             ]
        });

         var table3 = $('#dashboardAkhlaq').DataTable();
    })
</script>
@endpush
@endsection

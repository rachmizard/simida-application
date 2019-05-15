@extends('layouts.master-layouts')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Pendaftaran Santri</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Keuangan</a></li>
            <li class="breadcrumb-item active">Pendaftaran Santri</li>
        </ol>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                        <h4 class="example-title"><i class="icon wb-random"></i> Tabel Uang Pendaftaran Santri Baru</h4>
                        <div class="row row-lg">
                            <div class="col-md-12 table-responsive">
                                <table id="table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>Nis</td>
                                            <td>Nama Santri</td>
                                            <td>Tanggal Daftar</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@push('otherJavascript')
<script type="text/javascript">
    $(function(){
         var table = $('#table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{!! route('keuangan.uang-pendaftaran.studentsDataTables') !!}",
              columns: [
                  { data: 'nis' },
                  { data: 'nama_santri'  },
                  { data: 'created_at' },
                  { data: 'action'  },
              ]
          });
    });
    </script>
@endpush
@endsection

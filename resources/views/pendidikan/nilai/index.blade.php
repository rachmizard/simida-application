@extends('layouts.master-layouts')
@section('content')


    <h1 class="page-title">Input Nilai</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Input Nilai</li>
    </ol>




<div class="panel">
<div class="panel-body container-fluid" style="background-color: #fdfdfd;">
    <div class="row row-lg">
        <div class="col-md-12">
            <form autocomplete="off">
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                    <div class="form-group form-inline">
                        <div class="form-control-label col-2">Periode</div>
                        <select class="form-control selectTo col" style="">
                                <optgroup label="Tahun">
                                    <option value="">2020</option>
                                    <option value="">2019</option>
                                    <option value="">2018</option>
                                </optgroup>
                                <option disabled selected></option>
                        </select>
                    </div><!--/.form-inline-->
                    <div class="form-group form-inline">
                        <div class="form-control-label col-2">Semester</div>
                        <select class="form-control selectTo col" style="">
                                <optgroup label="Semester">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </optgroup>
                                <option disabled selected></option>
                        </select>
                    </div><!--/.form-inline-->
                </div><!--/.form-group =========================-->
                 <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                    <div class="form-group form-inline">
                        <div class="form-control-label col-2">Tingkat</div>
                        <select class="form-control selectTo col" style="">
                                <optgroup label="Tingkat">
                                    <option value="">SMP</option>
                                    <option value="">SMA</option>
                                    <option value="">SMK</option>
                                </optgroup>
                                <option disabled selected></option>
                        </select>
                    </div><!--/.form-inline-->
                    <div class="form-group form-inline">    
                        <div class="form-control-label col-2">Kelas</div>
                        <select class="form-control selectTo col" style="">
                                <optgroup label="1">
                                    <option value="">1A</option>
                                    <option value="">2B</option>
                                </optgroup>
                                <option disabled selected></option>
                        </select>
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
<style>
    table.striped tr {
      border-bottom: none;
    }

    table.striped > tbody > tr:nth-child(odd) {
      background-color: rgba(242, 242, 242, 0.5);
    }

    table.striped > tbody > tr > td {
      border-radius: 0;
      font-weight: 500;
    }
    table.striped > tbody > tr > td input{
      font-weight: 500;font-size: 13px;
    }
    table.highlight > tbody > tr {
      -webkit-transition: background-color .25s ease;
      transition: background-color .25s ease;
    }
</style>
    <div class="row row-lg">
       <div class="col-md-12">
           <h4 class="example-title">List Data Santri</h4>
           <p>-Description-</p>
            <table class="striped" data-toggle="table" data-height="400" data-mobile-responsive="true">
                <thead>
                    <tr>
                        <th data-field="no">No</th>
                        <th data-field="id">ID Santri</th>
                        <th data-field="kelas">Kelas</th>
                        <th data-field="nama">Nama Santri</th>
                        <th data-field="status">Status</th>
                        <th data-field="action"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>02564</td>
                        <td>3E</td>
                        <td>Suherman Saputra</td>
                        <td><span class="badge badge-primary">Selesai</span></td>
                        <td class="w-50">
                            <button type="button" class="btn btn-outline btn-default mb-2">
                                <i class="icon wb-plus" aria-hidden="true"></i> Input Nilai
                            </button>
                            <button type="button" class="btn btn-outline btn-default m-0">
                                <i class="icon wb-edit" aria-hidden="true"></i> Edit Nilai
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>03534</td>
                        <td>3E</td>
                        <td>Bambang Suherman</td>
                        <td><span class="badge badge-danger">Belum</span></td>
                        <td class="w-50">
                            <button type="button" class="btn btn-outline btn-default mb-2">
                                <i class="icon wb-plus" aria-hidden="true"></i> Input Nilai
                            </button>
                            <button type="button" class="btn btn-outline btn-default m-0">
                                <i class="icon wb-edit" aria-hidden="true"></i> Edit Nilai
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>   
       </div><!--/.row-->
   </div>
</div><!--/.panel-body-->
</div><!--/.panel -->





@endsection
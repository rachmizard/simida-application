@extends('layouts.master-layouts')
@section('content')

<div class="page-header">
    <h1 class="page-title">Form Keamanaan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index-2.html">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Forms</a></li>
        <li class="breadcrumb-item active">Keamanan</li>
    </ol>
    <div class="page-header-actions">
        <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Edit">
            <i class="icon wb-pencil" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Refresh">
            <i class="icon wb-refresh" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Setting">
            <i class="icon wb-settings" aria-hidden="true"></i>
        </button>
    </div>
</div>
<!--/.page-header-->
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
    <div class="row row-lg">
       <div class="col-md-12">
           <h4 class="example-title">List Data Santri</h4>
           <div class="btn-group hidden-sm-down" id="exampleToolbar" role="group">
                <button type="button" class="btn btn-outline btn-default">
                    <i class="icon wb-file" aria-hidden="true"></i> Export Excel
                </button>
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
                            <th rowspan="1" colspan="1" class="hanzo">THD <span>1</span></th>
                            <th rowspan="1" colspan="1" class="hanzo">SYAH <span>2</span></th>
                            <th rowspan="1" colspan="1" class="hanzo">FQH <span>3</span></th>
                            <th rowspan="1" colspan="3" class="index-pres">INDEK PRESTASI NILAI RAPORT</th>
                            <th rowspan="1" colspan="1">Jumlah Nilai</th>
                            <th rowspan="1" colspan="1">Jmlah Nilai X Bobot 21</th>
                            <th rowspan="1" colspan="1" class="Ip-asli">IP Asli</th>
                            <th rowspan="1" colspan="1">Rata-Rata</th>
                            <th rowspan="1" colspan="1">Predikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>FAISAL HIDAYAT</td>
                            <td>4.50</td>
                            <td>4.50</td>
                            <td>4.50</td>
                            <td class="index-pres">12.8</td>
                            <td class="index-pres">12.8</td>
                            <td class="index-pres">12.8</td>
                            <td>57.00</td>
                            <td>104.00</td>
                            <td class="Ip-asli">4.71</td>
                            <td>5.18</td>
                            <td><span class="level1">Bagus Sekali</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>FAISAL HIDAYAT</td>
                            <td>4.50</td>
                            <td>4.50</td>
                            <td>4.50</td>
                            <td class="index-pres">12.8</td>
                            <td class="index-pres">12.8</td>
                            <td class="index-pres">12.8</td>
                            <td>57.00</td>
                            <td>104.00</td>
                            <td class="Ip-asli">4.71</td>
                            <td>5.18</td>
                            <td><span class="level2">Bagus</span></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>FAISAL HIDAYAT</td>
                            <td>4.50</td>
                            <td>4.50</td>
                            <td>4.50</td>
                            <td class="index-pres">12.8</td>
                            <td class="index-pres">12.8</td>
                            <td class="index-pres">12.8</td>
                            <td>57.00</td>
                            <td>104.00</td>
                            <td class="Ip-asli">4.71</td>
                            <td>5.18</td>
                            <td><span class="level3">Buruk</span></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>FAISAL HIDAYAT</td>
                            <td>4.50</td>
                            <td>4.50</td>
                            <td>4.50</td>
                            <td class="index-pres">12.8</td>
                            <td class="index-pres">12.8</td>
                            <td class="index-pres">12.8</td>
                            <td>57.00</td>
                            <td>104.00</td>
                            <td class="Ip-asli">4.71</td>
                            <td>5.18</td>
                            <td><span class="level4">Tidak Lulus</span></td>
                        </tr>
                    </tbody>
                </table>   
            </div><!--/.table-responsive-lg-->
            
       </div><!--/.row-->
   </div>
</div><!--/.panel-body-->
</div><!--/.panel -->
@endsection
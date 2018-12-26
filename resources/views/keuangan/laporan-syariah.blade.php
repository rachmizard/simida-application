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
                                        <h4 class="example-title"><i class="icon wb-search"></i> Pencarian Data Syariah</h4>
                                            <div class="example">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                           <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-book"></i> Kelas</label>
                                                           <select name="kelas_id" class="form-control selectTo" id="">
                                                                <option value="all">Semua</option>
                                                               @foreach($classes as $class)
                                                                    <option value="{{ $class->id }}" @if($kelasId == $class->id) selected @endif>{{ $class->nama_kelas }}</option>
                                                               @endforeach
                                                           </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                           <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-home"></i> Asrama</label>
                                                           <select name="asrama_id" class="form-control selectTo" id="">
                                                                <option value="all">Semua</option>
                                                                @foreach($asrama as $in)
                                                                <option value="{{ $in->id }}" @if($asramaId == $in->id) selected @endif>{{ $in['ngaran']['nama'] }}</option>
                                                                @endforeach
                                                           </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="inputBasicFirstName"><i class="icon wb-calendar"></i> Bulan & Tahun Pembayaran</label>
                                                            <input type="text" name="bulan" class="form-control datepickerMonth" @if($bulan !== null) value="{{ $bulan }}" @endif>
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
                        <h4 class="example-title"><i class="icon wb-payment"></i> Hasil Laporan Syariah</h4>
                        <div class="row row-lg">
                            <div class="col-md-12 table-responsive">
                                @if($kelasId !== null && $asramaId !== null)
                                <list-laporan-syariah kelas="{{ $kelasId }}" asrama="{{ $asramaId }}"  bulan="{{ $bulan }}"></list-laporan-syariah>
                                @else
                                <span class="text-center">Silahkan filter untuk menampilkan data syariah.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
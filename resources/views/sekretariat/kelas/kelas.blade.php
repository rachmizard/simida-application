@extends('layouts.master-layouts')
@section('content')
<div class="page-header">
    <h1 class="page-title">Data Kelas</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Master Kelas</a></li>
        <li class="breadcrumb-item active">Data Kelas</li>
    </ol>
    <!-- <div class="page-header-actions">
        <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Edit">
            <i class="icon wb-pencil" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Refresh">
            <i class="icon wb-refresh" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Setting">
            <i class="icon wb-settings" aria-hidden="true"></i>
        </button>
    </div> -->
</div>
	<list-kelas-component></list-kelas-component>

    <!-- MODAL -->

      <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="nama_kelas"></h4>
            </div>
              <form action="karyawan/import" method="post" enctype="multipart/form-data" id="submitUpload">
                <div class="modal-body" style="margin-bottom: 50px;">

                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                        <h4 class="example-title">Data Kelas</h4>
                            <div class="example">
                            <!-- <div class="form-group">
                                <label class="form-control-label" for="">NIS</label>
                                <select class="form-control select2">
                                        <optgroup label="Tersedia">
                                            <option>3273110911180000</option>
                                            <option>3273110911180000</option>
                                            <option>3273110911180000</option>
                                        </optgroup>
                                        <option disabled selected></option>
                                </select>
                            </div> -->
                            <div class="form-row">
                                <!-- <div class="form-group col-md-6">
                                    <label class="form-control-label" for="inputBasicFirstName">Nama Kelas</label>
                                   <input type="text" id="nama_kelas" class="form-control" placeholder="Nama Kelas baru.." autocomplete="off" />
                                </div> -->
                                <div class="form-group col-md-6">
                                    <label class="form-control-label" for="inputBasicFirstName">Kelas</label>
                                    <select id="tingkat" name="tingkat" class="form-control select2" placeholder="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label" for="inputBasicFirstName">Lokal</label>
                                    <select id="lokal" name="lokal" class="form-control select2" placeholder="">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label" for="inputBasicFirstName">Tingkat</label>
                                    <select id="tingkat_id" name="tingkat_id" class="form-control select2" placeholder="">
                                        <option value="1">Ibtida</option>
                                        <option value="2">Tsanawi</option>
                                        <option value="3">Ma'had Aly</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-control-label" for="inputBasicFirstName">Jenis Kelamin</label>
                                    <select id="jk" class="form-control" placeholder="" name="jk">
                                        <option value="Putra">Putra</option>
                                        <option value="Putri">Putri</option>
                                    </select>
                                </div>
                            </div>
                        </div><!--/Example-->
                    </div><!--/.form-group
                =========================-->
                    <div class="form-group col-md-6 col-sm-12" style="padding-left: 15px;">
                        <h4 class="example-title">Data Guru</h4>
                            <div class="example">
                                <div class="form-group">
                                    <label class="form-control-label" for="">Nama Guru</label>
                                    <select id="guru_id" class="form-control select2" placeholder="Nama Guru" name="guru_id">
                                        <option value="1">Usman Khatam</option>
                                        <option value="2">Jeffry Washington</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="">Badal (Pengganti)</label>
                                    <select id="badal_id" class="form-control select2" placeholder="Nama Guru" name="badal_id">
                                        <option value="1">Usman Khatam</option>
                                        <option value="2">Jeffry Washington</option>
                                    </select>
                                </div>
                                <div class="form-row">
                                    <button type="submit" class="btn btn-primary col-md-12" >Edit Kelas </button>
                               </div>
                            </div><!--/.example-->
                    </div><!--/.form-group
                ======================-->
                </div><!--/.form-row-->
                </div>
                <!-- <div class="modal-footer">
                  <div class="btn-group">
                    <button class="btn btn-md btn-default" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-md btn-info"><i class="fa fa-upload"></i> Edit</button>
                  </div>
                </div> -->
              </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <!-- END MODAL -->
@endsection
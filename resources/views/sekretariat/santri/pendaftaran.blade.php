@extends('layouts.master-layouts')
@section('content')

<div class="page-header">
    <h1 class="page-title">Form Seketaris</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Sekretariat</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Master Santri</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Pendaftaran</a></li>
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

<div class="panel">
    <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
        <div class="row row-lg">
            <div class="col-md-12">
                <form autocomplete="off" method="POST" action="{{ route('sekretariat.store') }}">
                	{{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                    <h4 class="example-title">Data Diri</h4>
                    <div class="example">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicFirstName">Nama</label>
                                <input type="text" class="form-control" id="inputBasicFirstName" name="nama_santri" placeholder="Nama Santri" autocomplete="off" />
                                @if($errors->has('nama_santri'))
                                  <span class="label label-danger">
                                      {{ $errors->first('nama_santri') }}
                                  </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicLastName">Tanggal Lahir</label>
                                <input type="text" class="form-control datelahir" name="tgl_lahir" placeholder="DD/MM/YYYY" autocomplete="off" />
                                @if($errors->has('tgl_lahir'))
                                  <span class="label label-danger">
                                      {{ $errors->first('tgl_lahir') }}
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <!-- <div class="form-group col-md-6">
                                <label class="form-control-label" for="">NIS</label>
                                <input type="text" class="form-control" id="inputBasicFirstName" name="" placeholder="" autocomplete="off" />
                            </div> -->
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicLastName">NIK / No.KTP</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="" autocomplete="off" />
                            </div>
                            @if($errors->has('nik'))
                              <span class="label label-danger">
                                  {{ $errors->first('nik') }}
                              </span>
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="">Nama Ayah <b>Kandung</b></label>
                                <input type="text" class="form-control" id="inputBasicFirstName" name="nama_ortu" placeholder="Nama Ayah Kandung" autocomplete="off" />
                                @if($errors->has('nama_ortu'))
                                  <span class="label label-danger">
                                      {{ $errors->first('nama_ortu') }}
                                  </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicLastName">Nama Orangtua <b>Wali</b></label>
                                <input type="text" class="form-control" id="inputBasicLastName" name="nama_wali" placeholder="Nama Wali Bila Ada" autocomplete="off" />
                                @if($errors->has('nama_wali'))
                                  <span class="label label-danger">
                                      {{ $errors->first('nama_wali') }}
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="">Nomor Telepon Aktif</label>
                            <input type="text" class="form-control" id="inputBasicFirstName" name="no_telp" placeholder="" autocomplete="off" />
                            @if($errors->has('no_telp'))
                              <span class="label label-danger">
                                  {{ $errors->first('no_telp') }}
                              </span>
                            @endif
                         </div>
                    </div><!--/Example-->
                    <h4 class="example-title">ALAMAT SANTRI</h4>
                    <div class="example">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicFirstName">Provinsi</label>
                                <select name="provinsi" class="form-control selectTo" id="provinces">
                                    <option disabled selected>Nama Provinsi</option>
                                </select>
                                @if($errors->has('provinsi'))
                                  <span class="label label-danger">
                                      {{ $errors->first('provinsi') }}
                                  </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicLastName">Kabupaten</label>
                                <select name="kabupaten_kota" class="form-control selectTo">
                                    <option disabled selected>Nama Kabupaten</option>
                                </select>
                                @if($errors->has('kabupaten_kota'))
                                  <span class="label label-danger">
                                      {{ $errors->first('kabupaten_kota') }}
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicFirstName">Kecamatan</label>
                                <select name="kecamatan" class="form-control selectTo">
                                    <option disabled selected>Nama Kecamatan..</option>
                                </select>
                                @if($errors->has('kecamatan'))
                                  <span class="label label-danger">
                                      {{ $errors->first('kecamatan') }}
                                  </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicLastName">Kelurahan</label>
                                <select name="kelurahan" class="form-control selectTo">
                                    <option disabled selected>Kelurahan setempat...</option>
                                </select>
                                @if($errors->has('kelurahan'))
                                  <span class="label label-danger">
                                      {{ $errors->first('kelurahan') }}
                                  </span>
                                @endif
                            </div>
		                    <div class="form-group col-md-12">
		                       <label class="form-control-label" for="inputBasicFirstName">Alamat</label>
		                       <input type="text" name="alamat" class="form-control" id="inputBasicFirstName" name="inputFirstName" placeholder="First Name" autocomplete="off" />
                                @if($errors->has('alamat'))
                                  <span class="label label-danger">
                                      {{ $errors->first('alamat') }}
                                  </span>
                                @endif
		                    </div>
                        </div>
                    </div><!--/Example-->
                    </div><!--/.form-group
                    =========================-->
                    <div class="form-group col-md-6 col-sm-12" style="padding-left: 15px;">
                    <h4 class="example-title">Data Lanjutan</h4>
                    <div class="example">
                        <div class="form-group">
                           <label class="form-control-label" for="inputBasicFirstName">Pendidikan Terakhir</label>
                           <select name="pendidikan_terakhir" class="form-control">
                                <option disabled selected>Pendidikan Terakhir</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>SMK</option>
                            </select>
                            @if($errors->has('pendidikan_terakhir'))
                              <span class="label label-danger">
                                  {{ $errors->first('pendidikan_terakhir') }}
                              </span>
                            @endif
                        </div>
                        <div class="form-group">
                           <label class="form-control-label" for="inputBasicFirstName">Pesantren Sebelumnya</label>
                           <input type="text" name="pesantren_sebelumnya" class="form-control" id="inputBasicFirstName" name="inputFirstName" placeholder="First Name" autocomplete="off" />
                            @if($errors->has('pesantren_sebelumnya'))
                              <span class="label label-danger">
                                  {{ $errors->first('pesantren_sebelumnya') }}
                              </span>
                            @endif
                        </div>
                        <div class="form-row">
	                        <div class="form-group">
	                           <label class="form-control-label" for="inputBasicFirstName">Dewan Yang Menerima</label>
	                           <select name="dewan_id" class="form-control">
	                                <option disabled selected>Nama Dewan Kyai</option>
	                                <option value="1">KH. Irfan Ahmad Rifai</option>
	                                <option value="2">KH. Irfan Ahmad Rifai</option>
	                                <option value="3">KH. Irfan Ahmad Rifai</option>
	                                <option value="4">KH. Irfan Ahmad Rifai</option>
	                            </select>
                            @if($errors->has('dewan_id'))
                              <span class="label label-danger">
                                  {{ $errors->first('dewan_id') }}
                              </span>
                            @endif
	                        </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicLastName">Tanggal Masuk</label>
                                <input type="text" class="form-control datepicker" name="tgl_masuk" placeholder="DD/MM/YYYY" autocomplete="off" />
	                            @if($errors->has('tgl_masuk'))
	                              <span class="label label-danger">
	                                  {{ $errors->first('tgl_masuk') }}
	                              </span>
	                            @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicFirstName">Asrama</label>
                                <select name="asrama_id" id="asrama" class="form-control selectTo">
                                    <option disabled selected>Asrama</option>
                                    <optgroup label="Putra">
                                    @foreach($asramaPutra as $in)
                                        <option value="{{ $in->id }}">{{ $in->nama_asrama }}</option>
                                    @endforeach
                                    </optgroup>
                                    <optgroup label="Putri">
                                    @foreach($asramaPutri as $in)
                                        <option value="{{ $in->id }}">{{ $in->nama_asrama }}</option>
                                    @endforeach
                                    </optgroup>
                                </select>
	                            @if($errors->has('asrama_id'))
	                              <span class="label label-danger">
	                                  {{ $errors->first('asrama_id') }}
	                              </span>
	                            @endif
                            </div>
	                        <div class="form-group col-md-6">
	                           <label class="form-control-label" for="inputBasicFirstName">Tingkat</label>
	                           <select name="tingkat_id" class="form-control">
	                                <option disabled selected>Tingkat</option>
	                                <option value="Ibtidayah">Ibtidayah</option>
	                                <option value="Tsanawiyah">Tsanawiyah</option>
	                                <option value="Ma'had Aly">Ma'had Aly</option>
	                            </select>
	                            @if($errors->has('tingkat_id'))
	                              <span class="label label-danger">
	                                  {{ $errors->first('tingkat_id') }}
	                              </span>
	                            @endif
	                        </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicFirstName">Kelas</label>
                                <select name="kelas_id" class="form-control selectTo">
                                    <option disabled selected>Kelas</option>
                                    <optgroup label="Kelas 1">
                                        <option value="">1A</option>
                                        <option value="">1B</option>
                                        <option value="">1C</option>
                                    </optgroup>
                                    <optgroup label="Kelas 2">
                                        <option value="">2A</option>
                                        <option value="">2B</option>
                                        <option value="">2C</option>
                                    </optgroup>
                                    <optgroup label="Kelas 3">
                                        <option value="">3A</option>
                                        <option value="">3B</option>
                                        <option value="">3C</option>
                                    </optgroup>
                                    <optgroup label="Kelas 4">
                                        <option value="">4A</option>
                                        <option value="">4B</option>
                                        <option value="">4C</option>
                                    </optgroup>
                                </select>
	                            @if($errors->has('kelas_id'))
	                              <span class="label label-danger">
	                                  {{ $errors->first('kelas_id') }}
	                              </span>
	                            @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="inputBasicLastName">Kobong</label>
                                <select name="kobong_id" class="form-control">
                                    <option disabled selected>Kobong</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="form-control-label" for="inputBasicFirstName">Himpunan</label>
                           <input type="text" class="form-control" id="inputBasicFirstName" name="himpunan" placeholder="First Name" autocomplete="off" />
                            @if($errors->has('himpunan'))
                              <span class="label label-danger">
                                  {{ $errors->first('himpunan') }}
                              </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Selesai</button>
                        </div>
                    </div>
                    </div><!--/.form-group
                    ======================-->
                 </div><!--/.form-row-->
                </form>
            </div><!--/.col-->
        </div>
    </div>
</div>
@push('otherJavascript')
<script>
	// var myOptions = 'https://kodepos-2d475.firebaseio.com/list_propinsi.json?print=pretty';
	// var mySelect = $('#provinces');
	// $.each(myOptions, function(val, text) {
	//     mySelect.append(
	//         $('<option></option>').val(val).html(text)
	//     );
	// });

	let provinces = $('#provinces');
	let kabupaten = $('#kabupaten');
	let asrama = $('#asrama');
// /asrama/getAsrama
	provinces.empty();

	provinces.append('<option selected="true" disabled>Pilih Provinsi</option>');
	provinces.prop('selectedIndex', 0);

	const url = '{{ route("sekretariat.province") }}';

	// Populate provinces with list of provinces
	$.getJSON(url, function (data) {
	  $.each(data.data, function (key, entry) {
	    provinces.append($('<option></option>').attr('value', entry.id).text(entry.name));
	  })
	});


	// asrama.empty();

	// asrama.append('<option selected="true" disabled>Pilih Asrama</option>');
	// asrama.prop('selectedIndex', 0);

	// const urlAsrama = '{{ route("sekretariat.asrama.getAsramaAllKategori") }}';

	// // Populate asrama with list of asrama
	// $.getJSON(urlAsrama, function (data) {
	//   $.each(data.data, function (key, entry) {
	//     asrama.append($('<option></option>').attr('value', entry.id).text(entry.nama_asrama));
	//   })
	// });

	 $(document).ready(function() {
        $('select[name="provinsi"]').on('change', function() {
            var stateID = $(this).val();
            $('select[name="kabupaten_kota"]').empty();
            $('select[name="kecamatan"]').empty();
            $('select[name="kelurahan"]').empty();
            if(stateID) {
                $.ajax({
                    url: 'province/regencies/'+ stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('select[name="kabupaten_kota"]').empty();
                        $.each(data.data, function(key, value) {
                            $('select[name="kabupaten_kota"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });

	            $('select[name="kabupaten_kota"]').on('change', function() {
	                var kabupatenID = $(this).val();
	                if (kabupatenID) {
		                $.ajax({
		                	url: 'province/regency/districts/'+ kabupatenID,
		                	type: "GET",
		                	dataType: "json",
		                	success:function(dataKecamatan){

		                        $('select[name="kecamatan"]').empty();
		                        $.each(dataKecamatan.data, function(key, value) {
		                            $('select[name="kecamatan"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
		                        });	
		                	}
		                });
	                }else{
						$('select[name="kecamatan"]').empty();
	                }
	            });



	            $('select[name="kecamatan"]').on('change', function() {
	                var kelurahanID = $(this).val();
	                if (kelurahanID) {
		                $.ajax({
		                	url: 'province/regency/district/villages/'+ kelurahanID,
		                	type: "GET",
		                	dataType: "json",
		                	success:function(dataKelurahan){

		                        $('select[name="kelurahan"]').empty();
		                        $.each(dataKelurahan.data, function(key, value) {
		                            $('select[name="kelurahan"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
		                        });	
		                	}
		                });
	                }else{
						$('select[name="kelurahan"]').empty();
	                }
	            });
            }else{
                $('select[name="kabupaten_kota"]').empty();
                $('select[name="kecamatan"]').empty();
                $('select[name="kelurahan"]').empty();
            }
        });
    });
</script>
@endpush
@endsection
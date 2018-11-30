<template>
  <div class="panel">
      <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
          <div class="row row-lg">
              <div class="col-md-12">
                  <!-- Panel Wizard Form -->
                  <div class="panel" id="exampleWizardForm">
                    <div class="panel-heading">
                      <h3 class="panel-title">Form Pendaftaran</h3>
                    </div>
                    <div class="panel-body">
                      <!-- Steps -->
                      <div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
                        <div class="step col-lg-3 current" data-target="#exampleAccount" role="tab">
                          <span class="step-number">1</span>
                          <div class="step-desc">
                            <span class="step-title">Data Santri</span>
                            <p>Input identitas santri</p>
                          </div>
                        </div>

                        <div class="step col-lg-3" data-target="#exampleBilling" role="tab">
                          <span class="step-number">2</span>
                          <div class="step-desc">
                            <span class="step-title">Alamat</span>
                            <p>Lokasi dan Alamat santri</p>
                          </div>
                        </div>

                        <div class="step col-lg-3" data-target="#exampleVerification" role="tab">
                          <span class="step-number">3</span>
                          <div class="step-desc">
                            <span class="step-title">Verifikasi</span>
                            <p>Penempatan kelas dan asrama </p>
                          </div>
                        </div>

                        <div class="step col-lg-3" data-target="#exampleGetting" role="tab">
                          <span class="step-number">4</span>
                          <div class="step-desc">
                            <span class="step-title">Finish</span>
                            <p>Pengirim Data</p>
                          </div>
                        </div>
                      </div>
                      <!-- End Steps -->

                      <!-- Wizard Content -->

                        <div class="wizard-content">
                          <div class="wizard-pane active" id="exampleAccount" role="tabpanel">
                            <form id="exampleAccountForm">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="inputBasicFirstName">Nama</label>
                                    <input type="text" class="form-control" id="inputBasicFirstName" name="nama_santri" placeholder="Nama Santri" autocomplete="off" required="required" />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="inputBasicLastName">Tanggal Lahir</label>
                                    <input type="text" class="form-control datelahir" name="tgl_lahir" placeholder="DD/MM/YYYY" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="inputBasicLastName">NIK / No.KTP</label>
                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Kartu Keluarga/Nomor" autocomplete="off" required="required"/>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                   <label class="form-control-label" for="inputBasicFirstName">Jenis Kelamin</label>
                                   <select name="jenis_kelamin" class="form-control" required="required">
                                        <option disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="">Nama Ayah <b>Kandung</b></label>
                                    <input type="text" class="form-control" id="inputBasicFirstName" name="nama_ortu" placeholder="Nama Ayah Kandung" autocomplete="off" required="required"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="inputBasicLastName">Nama Orangtua <b>Wali</b></label>
                                    <input type="text" class="form-control" id="inputBasicLastName" name="nama_wali" placeholder="Nama Wali Bila Ada" autocomplete="off" required="required"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="">Nomor Telepon Aktif</label>
                                    <input type="text" class="form-control" id="inputBasicFirstName" name="no_telp" placeholder="Nomor Handphone Aktif" autocomplete="off" required="required"/>
                                </div>
                              </div>
                            </div>
                            </form>
                          </div>
                          <div class="wizard-pane" id="exampleBilling" role="tabpanel">
                            <form id="exampleBillingForm">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicFirstName">Provinsi</label>
                                      <select name="provinsi" class="form-control col-md-12 selectTo" style="width: 100%;" required="required" id="provinces">
                                          <option disabled selected>Nama Provinsi</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicLastName">Kabupaten</label>
                                      <select name="kabupaten_kota" class="form-control col-md-12 selectTo" style="width: 100%;" required="required">
                                          <option disabled selected>Nama Kabupaten</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicFirstName">Kecamatan</label>
                                      <select name="kecamatan" class="form-control col-md-12 selectTo" style="width: 100%;" required="required">
                                          <option disabled selected>Nama Kecamatan..</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicLastName">Kelurahan</label>
                                      <select name="kelurahan" class="form-control col-md-12 selectTo" style="width: 100%;" required="required">
                                          <option disabled selected>Kelurahan setempat...</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Kode Pos</label>
                                     <input type="text" name="kode_pos" class="form-control" id="inputBasicFirstName" placeholder="Kode Pos" autocomplete="off" required="numeric" />
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Alamat</label>
                                     <input type="text" name="alamat" class="form-control" id="inputBasicFirstName" placeholder="Alamat Santri" required="required" autocomplete="off" />
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="wizard-pane" id="exampleVerification" role="tabpanel">
                            <form id="exampleVerificationForm">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Pendidikan Terakhir</label>
                                     <select name="pendidikan_terakhir" class="form-control">
                                          <option disabled selected>Pendidikan Terakhir</option>
                                          <option>SD</option>
                                          <option>SMP</option>
                                          <option>SMA</option>
                                          <option>SMK</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Pesantren Sebelumnya</label>
                                     <input type="text" name="pesantren_sebelumnya" class="form-control" id="inputBasicFirstName" placeholder="Nama Pesantren Sebelumnya..." autocomplete="off" />
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Dewan Yang Menerima</label>
                                     <select name="dewan_id" class="form-control">
                                          <option disabled selected>Nama Dewan Kyai</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicLastName">Tanggal Masuk</label>
                                      <input type="text" class="form-control datepicker" name="tgl_masuk" placeholder="DD/MM/YYYY" autocomplete="off" />
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicFirstName">Asrama</label>
                                      <select name="asrama_id" id="asrama" class="form-control selectTo" style="width: 100%;">
                                          <option disabled selected>Asrama</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Tingkat</label>
                                     <select name="tingkat_id" class="form-control" style="width: 100%;">
                                          <option disabled selected>Tingkat</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicFirstName">Kelas</label>
                                      <select name="kelas_id" class="form-control selectTo" style="width: 100%;">
                                          <option disabled selected>Kelas</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicLastName">Kobong</label>
                                      <select name="kobong_id" class="form-control selectTo" style="width: 100%;">
                                          <option disabled selected>Kobong</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                     <label class="form-control-label" for="inputBasicFirstName">Himpunan</label>
                                     <input type="text" class="form-control" id="inputBasicFirstName" name="himpunan" placeholder="Himpunan" autocomplete="off" />
                                  </div>
                                  <div class="form-group">
                                      <label class="form-control-label" for="inputBasicFirstName">Foto Santri</label>
                                    <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                      <input type="text" class="form-control" readonly="">
                                      <span class="input-group-btn">
                                        <span class="btn btn-success btn-file">
                                          <i class="icon wb-upload" aria-hidden="true"></i>
                                          <input type="file" name="foto">
                                        </span>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="wizard-pane" id="exampleGetting" role="tabpanel">
                            <div class="text-center my-20">
                              <i class="icon wb-check font-size-40" aria-hidden="true"></i>
                              <h4>We got your order. Your product will be shipping soon.</h4>
                            </div>
                          </div>
                        </div>
                      <!-- End Wizard Content -->
                    </div>
                  </div>
                  <!-- End Panel Wizard One Form -->
                </div>
              </div><!--/.col-->
          </div>
      </div>
  </div>
</template>
<script>
  export default {
    mounted(){
      this.function()
    },

    data(){
      return {

      }
    },

    methods: {
      function(){
        let provinces = $('#provinces');
        let kabupaten = $('#kabupaten');
        let asrama = $('#asrama');
        provinces.empty();

        provinces.append('<option selected="true" disabled>Pilih Provinsi</option>');
        provinces.prop('selectedIndex', 0);

        const url = '/sekretariat/provinces';

        // Populate provinces with list of provinces
        $.getJSON(url, function (data) {
          $.each(data.data, function (key, entry) {
            provinces.append($('<option></option>').attr('value', entry.id).text(entry.name));
          })
        });


        // asrama.empty();

        // asrama.append('<option selected="true" disabled>Pilih Asrama</option>');
        // asrama.prop('selectedIndex', 0);

        // const urlAsrama = '';

        // // Populate asrama with list of asrama
        // $.getJSON(urlAsrama, function (data) {
        //   $.each(data.data, function (key, entry) {
        //     asrama.append($('<option></option>').attr('value', entry.id).text(entry.nama_asrama));
        //   })
        // });

         $(function() {
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
                                      $('select[name="kelurahan"]').append('<option value="'+ value.id_na +'">'+ value.name +'</option>');
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

              $('select[name="asrama_id"]').on('change', function(){
                  var asrama_id = $(this).val();
                  if (asrama_id) {
                    $.ajax({
                      url: 'asrama/'+ asrama_id +'/kobongJSON',
                      type: "GET",
                      dataType: "json",
                      success:function(dataKobong){

                            $('select[name="kobong_id"]').empty();
                            $.each(dataKobong.data, function(key, value) {
                                $('select[name="kobong_id"]').append('<option value="'+ value.id +'">'+ value.asrama_id.nama +' - ' + value.nama_kobong +'</option>');
                            }); 
                      }
                    });
                  }else{
                      $('select[name="kobong_id"]').empty();
                  }
              })
          });
      }
    }
  }
</script>
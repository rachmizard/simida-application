<template>
    <div id="app">
      <div class="row row-lg">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-12">
              <!-- Panel Kitchen Sink -->
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">
                    <i class="icon wb-search"></i> Filter Report
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="">Tanggal Awal</label>
                        <input type="date" name="start_date" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="">Tanggal Akhir</label>
                        <input type="date" name="end_date" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                          <option value="belum_kembali">Belum Kembali</option>
                          <option value="sudah_kembali">Sudah Kembali</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <button @click="getKeamananDatatables" id="filter" class="btn btn-sm btn-info"><i class="icon wb-search"></i> Filter</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Panel Kitchen Sink -->
            </div>
            <div class="col-md-12">
              <!-- Panel Kitchen Sink -->
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">
                    <i class="icon wb-book"></i> Laporan Entri
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">
                  <div class="form-group">

                  </div>
                  <table id="laporanEntriIzin" class="table table-striped table-hover">
                  </table>
                </div>
              </div>
              <!-- End Panel Kitchen Sink -->
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
  import Datepicker from 'vuejs-datepicker';
  import Select2 from 'v-select2-component';
    export default {
    components: {
      Datepicker,
      Select2
    },

        mounted() {
    			this.getKeamananDatatables();
        },

        data(){
            return {
                errors: [],
                filter: {
                  start_date: '',
                  end_date: ''
                }	
            }
        },

        methods: {
            customFormatter(date) {
                  return moment(date).format('MM-YYYY');
            },

            getKeamananDatatables(){
            	$(function(){
                var htmls = [];
                var rows = [];
                var a = $('input[name="start_date"]').val();
                var b = $('input[name="end_date"]').val();
                var c = $('select[name="status"]').val();
                axios.get('/keamanan/getListKeamanan', { params: { start_date : a, end_date : b, status: c } }).then(response => {
                  htmls = response.data;
                  $.each(htmls.data, function(index, value){
                    rows.push([
                        value.nis,
                        value.nama_santri,
                        value.tujuan,
                        value.alasan,
                        value.status,
                        value.kategori,
                        value.created_at,
                        value.tgl_berakhir_izin
                    ]);
                  })

                   var today = new Date();
                   var dd = today.getDate();
                    var mm = today.getMonth() + 1; //January is 0!

                    var yyyy = today.getFullYear();
                    if (dd < 10) {
                      dd = '0' + dd;
                    } 
                    if (mm < 10) {
                      mm = '0' + mm;
                    } 
                    var today = dd + '/' + mm + '/' + yyyy;
                   var table = $('#laporanEntriIzin').DataTable({
                      destroy: true,
                      dom: 'Blfrtip',
                      buttons: [
                          {
                              extend: 'excelHtml5',
                              text: '<i class="icon wb-download"></i> Download Report',
                              className: 'btn btn-success btn-sm',
                              title: "laporan_keamanan_miftahul_huda_"+ today,
                              exportOptions: {
                                  columns: [0, 1, 2, 3, 4, 5, 6, 7]
                              }
                          }
                      ],
                      data: rows,
                      columns: [
                           {title: 'NIS' },
                           {title: 'Nama Santri'} ,
                           {title: 'Tujuan' },
                           {title: 'Alasan' },
                           {title: 'Status' },
                           {title: 'Kategori' },
                           {title: 'Tanggal Izin' },
                           {title: 'Tanggal Akhir Izin' },
                      ]
                  });

                   // console.log(rows); WORKED!
                })

            	});
    		  },

          
        },

    }
</script>
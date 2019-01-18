<template>
    <div id="app">
      <div class="page-header">
          <h1 class="page-title">Keamanan</h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">Keamanan</a></li>
              <li class="breadcrumb-item active">List Entri</li>
          </ol>
      </div>
      <div class="row row-lg">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-12">
              <!-- Panel Kitchen Sink -->
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">
                    <i class="icon wb-user"></i> Entri Izin Santri
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">
                  <div class="form-group">
                    <router-link :to="{ path: '/keamanan' }" class="btn btn-sm btn-info"><i class="icon wb-plus"></i>  Tambah Entri Izin</router-link>
                    <router-link :to="{ path: '/pemberitahuan' }" class="btn btn-sm btn-danger"><i class="icon wb-bell"></i>  Pemberitahuan</router-link>
                    <router-link :to="{ path: '/laporan/entri_izin' }" class="btn btn-sm btn-primary"><i class="icon wb-book"></i> Laporan Entri</router-link>
                  </div>
                  <table id="listEntriIzinTable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>NIS</th>
                        <th>Nama Santri</th>
                        <th>Tujuan</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Kategori</th>
                        <th>Tanggal Izin</th>
                        <th>Tanggal Akhir Izin</th>
                        <th>Jam Berakhir Izin</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
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
    			this.getDewanKyai();
        },

        data(){
            return {
                errors: [],
                errorsJenis: [],
                santris: [],
                dewankyais: [],
                filter: {
                	id: '',
                	nis: '',
                	nama_santri: ''
                },
                entri: {
                	santri_id: '',
                	kategori: '',
                	alasan: '',
                	status: '',
                	pemberi_izin: ''
                },
                resultsearch: '',
                message: '',
                messageAlert: '',
                messageSuccess: '',
                messageJenis: ''	
            }
        },

        methods: {
            formatPrice(value) {
                return "Rp." + value.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1\.")
            },

            customFormatter(date) {
                  return moment(date).format('MM-YYYY');
            },

            getIdSantri(id){
            	axios.get('/sekretariat/santri/'+ id +'/show').then(response => {
            		this.entri.santri_id = response.data.id;
            		this.filter.nis = response.data.nis;
            		this.filter.nama_santri = response.data.nama_santri;
            	});
            },

            getDewanKyai(){
            	axios.get('/sekretariat/dewankyai/getDewanKyaiJSON').then(response => {
            		this.dewankyais = response.data;
            	});
            },

            getKeamananDatatables(){
            	$(function(){
            		var table = $('#listEntriIzinTable').DataTable({
		              processing: true,
		              serverSide: true,
		              ajax: {
		                url: "/keamanan/getListSantriIzinDataTables",
		                // data:function(e){
                  //     e.start_date = $('input[name="start_date"]').val();
		                //   e.end_date = $('input[name="end_date"]').val();
		                // }
		              },
		              columns: [
		                  { data: 'santri.nis', name: 'santri.nis' },
		                  { data: 'santri.nama_santri', name: 'santri.nama_santri' },
                      { data: 'tujuan', name: 'tujuan' },
		                  { data: 'alasan', name: 'alasan' },
                      { data: 'status', name: 'status'},
		                  { data: 'kategori', name: 'kategori'},
                      { data: 'created_at', name: 'created_at'},
		                  { data: 'tgl_berakhir_izin', name: 'tgl_berakhir_izin'},
                      { data: 'jam_berakhir', name: 'jam_berakhir'},
		                  { data: 'action', name: 'action'},
		              ]
		          }); 

			         // Auto reload when getting result 
  			        $('#filter_trigger').on('click', function(e) {
  			            table.draw();
  			            e.preventDefault();
  			        });

            	});
    		},

            filterSantriForEntriIzin(){
        		axios.get('/keamanan/listSantriIzinWithFilter', { params: { nis: this.filter.nis, nama_santri: this.filter.nama_santri } }).then(response => {
        			this.santris = response.data;
            		this.resultsearch = response.data.available;
            		console.log(this.resultsearch);
            	}).catch((error) => {
            		this.errors = error.response.data.errors
            		setTimeout(() => {
            			this.errors = false;
            		}, 4000)
            	})
            },

            resetFilter(){
                this.filter.nis = '';
                this.filter.nama_santri = '';
            },

            dismissModal(){
            	$(function(){

					  // $("#exampleNifty3dSlit").removeClass("in");
					  $(".modal-backdrop").remove();
					  // $('body').removeClass('modal-open');
					  // $('body').css('padding-right', '');
					  $("#exampleNifty3dSlit").hide();
				})
            },

            storeentriizin:function(e){
                let app = this;
                var body = app.entri;
                // console.log(body);
                axios.post('/keamanan/store', body)
                .then(response => {
                  app.errors = [];
                  app.messageSuccess = response.data.response;
                  app.messageAlert = response.data.response;
                  app.entri = null;
                  app.dismissModal();
                  if (app.messageSuccess == 'success') {   
                    app.messageSuccess = 'Syariah berhasil ditambahkan ke database!';
                    app.cool_decreased_cash = true;
                  }
                  setTimeout(() => {
                    app.cool_decreased_cash = false;
                  }, 3000);
                  setTimeout(() => {
                    app.messageSuccess = false;
                    app.messageAlert = false;
                  }, 8000);
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.messageSuccess = false;
                });
            }
        },

    }
</script>
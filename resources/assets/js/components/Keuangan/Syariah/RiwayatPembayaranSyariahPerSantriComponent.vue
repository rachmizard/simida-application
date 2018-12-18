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
                    <i class="icon wb-time"></i> Riwayat Pembayaran Syariah Santri {{ santri.nama_santri }}
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">

                  <table id="pengeluaranTable" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Bulan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
						<tr v-if="santris.length != 0" v-for="santri in santris.data">
							<td>{{ santri.bulan }}</td>
							<td>{{ santri.tgl_transaksi }}</td>
							<td>{{ formatPrice(santri.nominal) }}</td>
							<td><button class="btn btn-xs btn-danger" @click="hapusRiwayat(santri.id)"><i class="icon wb-trash"></i></button></td>
						</tr>
						<tr v-else>
							<td colspan="6">Data Kosong</td>
						</tr>
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
	    	var id = this.$route.params.id;
	    	axios.get('/keuangan/syariah/'+ id +'/getOnceSantri').then(response => {
	    		this.santri.santri_id = response.data.data.santri_id;
	    		this.santri.nis = response.data.data.nis;
	    		this.santri.nama_santri = response.data.data.nama_santri;
	    		this.santri.kelas = response.data.data.kelas;
	    		this.santri.asrama = response.data.data.asrama;
	    		this.santri.bulan = response.data.data.bulan;
	    		this.santri.status_pembayaran = response.data.data.status_pembayaran;
	    		this.santri.foto = response.data.data.foto;
	    		console.log(this.santri);
	    	});
	    	this.getRiwayatPembayaranPerSantri();
        },

        data(){
            return {
                errors: [],
                errorsJenis: [],
                asramas: [],
                kelass: [],
                santris: [],
                pengeluarans: [],
                nama_jenis_pengeluarans: [],
                santri: {
                	santri_id: '',
                	nis: '',
                	nama_santri: '',
                	kelas: '',
                	asrama: '',
                	status_pembayaran: '',
                	bulan: '',
                	foto: '',
                    tgl_pemasukan: this.$route.params.tgl,
                    jumlah_pemasukan: '',
                    jenis_pengeluaran: ''
                },
                total_uang: '',
                cool_decreased_cash: '',
                message: '',
                messageAlert: ''	
            }
        },

        methods: { 
            formatPrice(value) {
                return "Rp." + value.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1\.")
            },

            customFormatter(date) {
                  return moment(date).format('MM-YYYY');
            },

            getRiwayatPembayaranPerSantri(){
            	var id = this.$route.params.id;
		    	axios.get('/keuangan/syariah/'+ id +'/riwayatPembayaranPerSantri').then(response => {
		    		this.santris = response.data;
		    	})
            },

            bayar:function(e){
                let app = this;
                var body = app.santri;
                // console.log(body);
                axios.post('/keuangan/pemasukan/storeSyariah', body)
                .then(response => {
                  app.errors = [];
                  app.message = response.data.response.message;
                  app.messageAlert = response.data.response.messageAlert;
                  app.getRiwayatPembayaranPerSantri();
                  if (app.message == 'success') {   
                    app.message = 'Syariah berhasil ditambahkan ke database!';
                    app.cool_decreased_cash = true;
                  }
                  setTimeout(() => {
                    app.cool_decreased_cash = false;
                  }, 3000);
                  setTimeout(() => {
                    app.message = false;
                    app.messageAlert = false;
                  }, 8000);
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     console.log(app.errors);
                     app.message = false;
                });
            },

            hapusRiwayat(id){
				var r=confirm("Jika riwayat ini dihapus, data syariah pada santri ini akan ikut serta di hapus, lanjutkan?");
				if (r == true){
				  	axios.delete('/keuangan/pemasukan/'+ id +'/destroy').then(response => {
	            		this.message = response.data.response;
	            		if (this.message == 'success') {
	            			this.message = 'Berhasil di hapus!';
	            		}
        				this.getRiwayatPembayaranPerSantri()
				  	})
				}
            }
        },

    }
</script>
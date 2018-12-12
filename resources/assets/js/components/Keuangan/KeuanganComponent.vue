<template>
	
 <div class="page-content container-fluid">
      <div class="row">

        <div class="col-xl-12 col-lg-12">
          <div class="row">
            <div class="col-lg-6">
              <!-- Card -->
              <div class="card p-30 flex-row justify-content-between">
                <div class="white">
                  <i class="icon icon-circle icon-2x wb-graph-up bg-green-600" aria-hidden="true"></i>
                </div>
                <div class="counter counter-md counter text-right">
                  <div class="counter-number-group">
                    <!-- <span class="counter-number">25</span> -->
                    <span class="counter-number-related text-capitalize">{{ total_pemasukan.total }}</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">Total Pemasukan Periode {{ total_pemasukan.periode }}</div>
                </div>
              </div>
              <!-- End Card -->
            </div>

            <div class="col-lg-6">
              <!-- Card -->
              <div class="card p-30 flex-row justify-content-between">
                <div class="counter counter-md text-left">
                  <div class="counter-number-group">
                    <!-- <span class="counter-number">42</span> -->
                    <span class="counter-number-related text-capitalize">Rp. 8090000</span>
                  </div>
                  <div class="counter-label text-capitalize font-size-16">Total Pengeluaran</div>
                </div>
                <div class="white">
                  <i class="icon icon-circle icon-2x wb-graph-down bg-red-600" aria-hidden="true"></i>
                </div>
              </div>
              <!-- End Card -->
            </div>
          </div>
        </div>

        <div class="col-md-12">	
          <!-- Panel Kitchen Sink -->
          <div class="panel">
            <header class="panel-heading">
              <h3 class="panel-title">
                <i class="icon wb-payment"></i> Sekilas Info Keuangan
                <!-- <span class="panel-desc">
                  Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                </span> -->
              </h3>
            </header>

            <div class="panel-body">
            	<div class="row">
            		<div class="col-lg-6">
            			<div class="form-group">
            				<div class="btn-group">
            					<router-link to="" data-target="#exampleNifty3dSlit" data-toggle="modal" class="btn btn-md btn-success"><i class="icon wb-plus"></i> Tambah Pemasukan</router-link to="">
            					<router-link to="" class="btn btn-md btn-danger"><i class="icon wb-plus"></i> Tambah Pengeluaran</router-link to="">
            				</div>
            			</div>
            		</div>
            	</div>

                  <!-- Modal -->
                  <div class="modal fade modal-3d-slit" id="exampleNifty3dSlit" aria-hidden="true"
                    aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-simple">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title"><i class="icon icon-2x wb-graph-up bg-success-600"></i> Pilih Pemasukan</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row row-lgtext-center">
                          	<div class="col-md-4">
            					<button class="btn btn-md btn-success"><i class="icon wb-payment"></i> Infaq</button>
                          	</div>
                          	<div class="col-md-4">
            					<button @click="dismissModalDonatur()" class="btn btn-md btn-success"><i class="icon wb-payment"></i> Donatur</button>
                          	</div>
                          	<div class="col-md-4">
            					<button class="btn btn-md btn-success"><i class="icon wb-payment"></i> Syariah</button>
                          	</div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal -->

              <table class="tablesaw table-striped table-bordered table-hover" data-tablesaw-mode="swipe"
                data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap
                data-tablesaw-mode-switch>
                <thead>
                  <tr>
                    <th data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="persist">No. Urut</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="4">Tanggal Pemasukan</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="3">Jenis Pemasukan</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="2">Nominal Pemasukan</th>
                    <th data-tablesaw-sortable-col data-tablesaw-priority="1">
                      <abbr title="Rotten Tomato Rating">Nama Donatur</abbr>
                    </th>
                  </tr>
                </thead>
                <tbody>
                	<tr v-for="(pemasukan, index) in pemasukans.data">
                		<td>{{ index+1 }}</td>
                		<td>{{ pemasukan.tgl_pemasukan }}</td>
                		<td v-if="pemasukan.jenis_pemasukan == 'donatur'"><span class="badge badge-sm badge-warning text-white">Donatur</span></td>
                		<td v-else-if="pemasukan.jenis_pemasukan == 'infaq'"><span class="badge badge-sm badge-warning text-white">Donatur</span></td>
                		<td v-else-if="pemasukan.jenis_pemasukan == 'syariah'"><span class="badge badge-sm badge-warning text-white">Donatur</span></td>
                		<td>{{ formatPrice(pemasukan.jumlah_pemasukan) }}</td>
                		<td>{{ pemasukan.nama_donatur }}</td>
                	</tr>	
                </tbody>
              </table>
            </div>
          </div>
          <!-- End Panel Kitchen Sink -->
        </div>
      </div>
    </div>
  <!-- End Page -->

</template>
<script>
	export default {
		mounted(){
			this.$forceUpdate();
			axios.get('/keuangan/pemasukan/sekilasKeuangan').then(response => {
				this.pemasukans = response.data;
			})

			axios.get('/keuangan/pemasukan/totalPemasukan').then(response => {
				this.total_pemasukan.total = this.formatPrice(response.data.total);
				this.total_pemasukan.periode = response.data.periode;
			})
		},

		data(){
			return {
				pemasukans: [],
				total_pemasukan: {
					total: '',
					periode: ''
				}
			}
		},

		methods: {
		    formatPrice(value) {
		        return "Rp." + value.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1\.")
		    },
			dismissModalDonatur(){
				$(function(){

					  // $("#exampleNifty3dSlit").removeClass("in");
					  $(".modal-backdrop").remove();
					  // $('body').removeClass('modal-open');
					  // $('body').css('padding-right', '');
					  $("#exampleNifty3dSlit").hide();
				})

			   setTimeout(() => {
			   		this.$router.push('/keuangan/tambahpemasukan/donatur');
			   }, 1300)
			}
		}
	}
</script>
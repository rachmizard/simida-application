<template>
	 <!-- Panel Table Tools -->
      <div class="panel" id="app">
        <div class="page-header">
            <h1 class="page-title">Hak Akses User</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Admin Panel</li>
                <li class="breadcrumb-item active">Hak Akses User</li>
            </ol>
        </div>
    <!-- MODAL -->
      <div id="deleteModalAsrama" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-data"></h4>
            </div>
            <div class="modal-body" style="margin-bottom: 50px;">
                <h5>Anda yakin ingin menghapus data tersebut?</h5>
            </div>
              <div class="modal-footer">
                <div class="btn-group">
                  <button class="btn btn-md btn-info" data-dismiss="modal">Tidak</button>
                  <button class="btn btn-md btn-danger" id="deleteBtnAsrama"><i class="fa fa-upload"></i><i class="icon wb-trash"></i> Ya</button>
                </div>
              </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <!-- END MODAL -->
        <header class="panel-heading">
          <h3 class="panel-title"></h3>
          <div class="form-group col-md-6" style="margin-left: 15px;">
          	<router-link :to="{ name: 'tambahPeriode' }" class="btn btn-sm btn-success"><i class="icon wb-plus"></i> Tambah Periode</router-link>
          </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped w-full" id="periodeTable">
            <thead>
              <tr>
                <th width="5%">ID Periode</th>
                <th width="20%">Tahun</th>
                <th width="20%">Tanggal Awal</th>
                <th width="20%">Tanggal Akhir</th>
                <th width="20%">Status</th>
                <th width="20%" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th width="5%">ID Periode</th>
                <th width="20%">Tahun</th>
                <th width="20%">Tanggal Awal</th>
                <th width="20%">Tanggal Akhir</th>
                <th width="20%">Status</th>
                <th width="20%" class="text-center">Aksi</th>
              </tr>
            </tfoot>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->
</template>
<script>

  import JQuery from 'jquery'
	export default {
		data(){
			return {
				periodes: []
			}
		},

		mounted(){
			this.listPeriode();	
			this.function();
			$(document).ready(function(){
				$('#exampleTableTools').DataTable();
			});
		},

		methods: {
			function(){
				$(function() {
			         var table = $('#periodeTable').DataTable({
			              processing: true,
			              serverSide: true,
			              ajax: {
			                url: "/pendidikan/periode/getPeriodeDataTables",
			                data:function(e){
			                  e.kategori_asrama = $('select[name="kategori_asrama"]').val();
			                }
			              },
			              columns: [
			                  { data: 'id', name: 'id' },
			                  { data: 'nama_periode', name: 'nama_periode', orderable: true },
			                  { data: 'start_date', name: 'start_date' },
			                  { data: 'end_date', name: 'end_date' },
			                  { data: 'status', name: 'status' },
			                  { data: 'action', name: 'action', orderable: false, searchable: false },
			              ]
			          }); 
			  });
			},

			listPeriode(){
				let app = this;
				axios.get('/pendidikan/periode/getPeriodeDataTables').then(response => {
					app.periodes = response.data;
				});
			}
		}
	}
</script>
<template>
	 <!-- Panel Table Tools -->
      <div class="panel" id="app">
        <header class="panel-heading">
          <h3 class="panel-title"></h3>
          <div class="form-group col-md-6" style="margin-left: 15px;">
          	<router-link :to="{ name: 'tambahSemester' }" class="btn btn-sm btn-success"><i class="icon wb-plus"></i> Tambah Semester</router-link>
          </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped w-full" id="semesterTable">
            <thead>
              <tr>
                <th width="5%">ID Semester</th>
                <th width="20%">Tingkat Semester</th>
                <th width="20%">Periode</th>
                <th width="20%">Status</th>
                <th width="20%" class="text-center">Aksi</th>
              </tr>
            </thead>
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
			         var table = $('#semesterTable').DataTable({
			              processing: true,
			              serverSide: true,
			              ajax: {
			                url: "/pendidikan/semester/getSemesterDataTables"
			              },
			              columns: [
			                  { data: 'id', name: 'id' },
			                  { data: 'tingkat_semester', name: 'tingkat_semester', orderable: true },
			                  { data: 'periode.nama_periode', name: 'periode.nama_periode' },
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
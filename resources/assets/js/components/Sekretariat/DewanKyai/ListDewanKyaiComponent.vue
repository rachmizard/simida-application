<template>
	
	<!-- Panel Table Tools -->
      <div class="panel" id="app">
        <header class="panel-heading">
          <h3 class="panel-title"><i class="icon wb-user"></i> Table Data Dewan Kyai</h3>
        </header>
        <div class="panel-body">
          <div class="form-group">
            <router-link to="/tambah_dewankyai" class="btn btn-sm btn-success">Tambah</router-link>
          </div>
          <table class="table table-hover table-bordered dataTable table-striped w-full" id="dewankyaiTable">
            <thead>
              <tr>
                <th width="5%" class="bg-info text-white">ID Dewan Kyai</th>
                <th width="10%" class="bg-info text-white">Nama Dewan Kyai</th>
                <th width="10%" class="bg-info text-white">Foto</th>
                <th width="10%" class="bg-info text-white">Aksi</th>
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

	export default {
    mounted(){
        $(function(){

               var table = $('#dewankyaiTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                      url: "/sekretariat/dewankyai/getDewanKyaiDataTables"
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'nama_dewan_kyai', name: 'nama_dewan_kyai'},
                        { data: 'foto', name: 'foto', orderable: false  },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ]
                }); 

        })
    }
	}
</script>
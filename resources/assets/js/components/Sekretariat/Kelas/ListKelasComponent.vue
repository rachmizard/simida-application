<template>
	 <!-- Panel Table Tools -->
      <div class="panel" id="app">
        <header class="panel-heading">
          <h3 class="panel-title">Table Data Kelas</h3>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped w-full" id="kelasTable">
            <thead>
              <tr>
                <th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th>Tingkat</th>
                <th>Guru</th>
                <th>Badal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
              	<th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th>Tingkat</th>
                <th>Guru</th>
                <th>Badal</th>
                <th>Aksi</th>
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

   $(function() {
         var table = $('#kelasTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/sekretariat/kelas/getKelasDatatables",
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'nama_kelas', name: 'nama_kelas' },
                  { data: 'tingkat', name: 'tingkat' },
                  { data: 'guru_id', name: 'guru_id' },
                  { data: 'badal_id', name: 'badal_id' },
                  { data: 'action', name: 'action', orderable: false, searchable: false },
              ]
          });
          table.draw();
  });

   $(document).ready(function(){
        $('#editModal').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $.get('/sekretariat/kelas/'+ id +'/show', function( data ) {
                  $("#tingkat").attr('value', data.tingkat);
                  $("#nama_kelas").attr('value', data.nama_kelas);
                  $("#tingkat_id").attr('value', data.tingkat_id);
                  $("#lokal").attr('value', data.lokal);
                  $("#guru_id").attr('value', data.guru_id);
                  $("#badal_id").attr('value', data.badal_id);
                  console.log(data);
                });
        });
      });
	export default {
		data(){
			return {
				kelas: []
			}
		},

		mounted(){
			this.listsKelas();	
			$(document).ready(function(){
				$('#exampleTableTools').DataTable();
			});
		},

		methods: {
			listsKelas(){
				let app = this;
				axios.get('/sekretariat/kelas/JSON').then(response => {
					app.kelas = response.data;
				});
			}
		}
	}
</script>
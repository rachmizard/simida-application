<template>
	<!-- Panel Table Tools -->
      <div class="panel">
        <div class="page-header">
            <h3 class="page-title"><i class="icon wb-book"></i> Predikat</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="">Pendidikan</a></li>
                <li class="breadcrumb-item active"><a href="">Predikat</a></li>
            </ol>
	      <div class="page-header-actions">
	        <router-link to="/tambah_predikat" class="btn btn-md btn-icon btn-success btn-outline btn-round"
	          data-toggle="tooltip" data-original-title="Tambah Predikat">
	          <i class="icon wb-plus" aria-hidden="true"></i>
	        </router-link>
	      </div>
        </div>
        <div class="panel-body">
          <table class="table table-hover table-bordered dataTable table-striped w-full">
            <thead>
              <tr>
                <th width="5%" class="bg-info text-white">No</th>
                <th width="20%" class="bg-info text-white">Nilai Minimal</th>
                <th width="20%" class="bg-info text-white">Nilai Maksimal</th>
                <th width="10%" class="bg-info text-white">Keterangan</th>
                <th width="20%" class="bg-info text-white">Aksi</th>
              </tr>
            </thead>
            <tbody>
            	<tr v-for="(predikat, index) in predikats">
            		<td>{{ index+1 }}</td>
            		<td>{{ predikat.nilai_minimal }}</td>
            		<td>{{ predikat.nilai_maksimal }}</td>
            		<td>{{ predikat.keterangan }}</td>
            		<td>
            			<div class="form-group text-center">
					        <router-link :to="{ path: '/edit_predikat/'+ predikat.id }" class="btn btn-sm btn-icon btn-success btn-outline btn-round"
					          data-toggle="tooltip" data-original-title="Edit Predikat">
					          <i class="icon wb-pencil" aria-hidden="true"></i>
					        </router-link>
					        <button @click="deletePredikat(predikat.id)" class="btn btn-sm btn-icon btn-danger btn-outline btn-round"
					          data-toggle="tooltip" data-original-title="Hapus Predikat">
					          <i class="icon wb-trash" aria-hidden="true"></i>
					        </button>
            			</div>
            		</td>
            	</tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->
</template>
<script>
	export default {

	    mounted(){
	    	this.getPredikats();
	    },

	    data(){
	      return {
	      	predikats: []
	      }
	    },

	    methods: {
	    	getPredikats(){
	    		axios.get('/pendidikan/getPredikatAll').then(response => {
	    			this.predikats = response.data;
	    		})
	    	},

	    	deletePredikat(id){
	    		var r=confirm("Anda yakin?");
	    		if (r) {
		    		axios.delete('/pendidikan/predikat/'+ id +'/destroy').then(response => {
		    			if (response.data) {
		    				this.getPredikats();
		    			}
		    		})
	    		}else{	
		    		this.getPredikats();
	    		}
	    	}
	    }
	}
</script>
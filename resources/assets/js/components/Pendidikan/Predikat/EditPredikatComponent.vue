<template>
	<div id="app">
      <div class="panel">
      	<div class="page-header">
	      <h1 class="page-title">Tambah Predikat</h1>
	      <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/">Home</a></li>
	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
	        <li class="breadcrumb-item">Predikat</li>
	        <li class="breadcrumb-item active">Edit Predikat</li>
	      </ol>
	      <!-- <div class="page-header-actions">
	        <button type="button" class="btn btn-md btn-icon btn-success btn-outline btn-round"
	          data-toggle="tooltip" data-original-title="Tambah Predikat">
	          <i class="icon wb-plus" aria-hidden="true"></i>
	        </button>
	      </div> -->
	    </div>
        <div class="panel-body container-fluid">
          <div class="row row-lg">
			<div class="col-md-12">
	          <!-- Example Basic Form (Form row) -->
	          <div class="example-wrap">
	            <h4 class="example-title">Form Edit Predikat</h4>
	            <div class="example">
	              <form @submit.prevent="updatePredikat" autocomplete="off">
	                <div class="form-row">
	                  <div class="form-group col-md-6">
	                    <label class="form-control-label" for="inputBasicFirstName">Nilai Minimal</label>
	                    <input type="number" v-model="predikat.nilai_minimal" class="form-control" id="inputBasicFirstName"placeholder="Nilai Minimal" autocomplete="off" />
	                    <span v-if="errors.nilai_minimal" class="badge badge-danger">
	                    	{{ errors.nilai_minimal[0] }}
	                    </span>
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label class="form-control-label" for="inputBasicLastName">Nilai Maksimal</label>
	                    <input type="number" v-model="predikat.nilai_maksimal" class="form-control" id="inputBasicLastName" placeholder="Nilai Maksimal" autocomplete="off" />
	                    <span v-if="errors.nilai_maksimal" class="badge badge-danger">
	                    	{{ errors.nilai_maksimal[0] }}
	                    </span>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <label class="form-control-label" for="inputBasicEmail">Keterangan</label>
	                  <input type="text" class="form-control" v-model="predikat.keterangan" id="inputBasicEmail" placeholder="Keterangan" autocomplete="off" />
	                    <span v-if="errors.keterangan" class="badge badge-danger">
	                    	{{ errors.keterangan[0] }}
	                    </span>
	                </div>
	                <div class="form-group">
	                  <button type="submit" class="btn btn-primary">Edit</button>
	                  <router-link to="/list_predikat" class="btn btn-default">Kembali</router-link>
	                </div>
	              </form>
	            </div>
	          </div>
	          <!-- End Example Basic Form (Form row) -->
	        </div>
          </div>
       	</div>	
   	  </div>
	</div>
</template>
<script>
	
	export default {
		data(){
			return {
				errors: [],
				id: this.$route.params.id,
				predikat : {
					nilai_minimal: '',
					nilai_maksimal: '',
					keterangan: ''
				}
			}
		},

		mounted(){
			this.getPredikatById(this.id);
		},

		methods: {
			updatePredikat:function(e){
				e.preventDefault();

				var body = this.predikat;

				axios.put('/pendidikan/predikat/'+ this.id +'/update', body).then(response => {
					if (response.data) {
						this.$router.push('/list_predikat');
					}
				}).catch((error) => {
					this.errors = error.response.data.errors;
				})
			},

			getPredikatById(id){
				axios.get('/pendidikan/predikat/'+ id +'/show').then(response => {
					this.predikat.nilai_minimal = response.data.nilai_minimal;
					this.predikat.nilai_maksimal = response.data.nilai_maksimal;
					this.predikat.keterangan = response.data.keterangan;
				})
			}
		}
	}
</script>

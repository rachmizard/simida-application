<template>
	<div id="app">
      <div class="panel">
      	<div class="page-header">
	      <h1 class="page-title">Tambah Predikat</h1>
	      <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="/">Home</a></li>
	        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
	        <li class="breadcrumb-item"><router-link to="/list_predikat">Predikat</router-link></li>
	        <li class="breadcrumb-item active">Tambah Predikat</li>
	      </ol>
	    </div>
        <div class="panel-body container-fluid">
          <div class="row row-lg">
			<div class="col-md-12">
	          <!-- Example Basic Form (Form row) -->
	          <div class="example-wrap">
	            <h4 class="example-title">Form Tambah Predikat</h4>
	            <div class="example">
	              <form @submit.prevent="storePredikat" autocomplete="off">
	                <div class="form-row">
	                  <div class="form-group col-md-6">
	                    <label class="form-control-label" for="inputBasicFirstName">Nilai Minimal</label>
	                    <input type="number" v-model="predikat.nilai_minimal" class="form-control" id="inputBasicFirstName"placeholder="Nilai Minimal" autocomplete="off" step="any" />
	                    <span v-if="errors.nilai_minimal" class="badge badge-danger">
	                    	{{ errors.nilai_minimal[0] }}
	                    </span>
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label class="form-control-label" for="inputBasicLastName">Nilai Maksimal</label>
	                    <input type="number" v-model="predikat.nilai_maksimal" class="form-control" id="inputBasicLastName" placeholder="Nilai Maksimal" autocomplete="off" step="any" />
	                    <span v-if="errors.nilai_maksimal" class="badge badge-danger">
	                    	{{ errors.nilai_maksimal[0] }}
	                    </span>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <label class="form-control-label" for="inputBasicEmail">Keterangan</label>
	                  <select autocomplete="off" class="form-control" v-model="predikat.keterangan" id="">
	                  	<option disabled selected>Keterangan Predikat</option>
	                  	<option value="Tidak Lulus">Tidak Lulus</option>
	                  	<option value="Buruk Sekali">Buruk Sekali</option>
	                  	<option value="Buruk">Buruk</option>
	                  	<option value="Cukup">Cukup</option>
	                  	<option value="Baik">Baik</option>
	                  	<option value="Baik Sekali">Baik Sekali</option>
	                  	<option value="Istimewa">Istimewa</option>
	                  </select>
	                    <span v-if="errors.keterangan" class="badge badge-danger">
	                    	{{ errors.keterangan[0] }}
	                    </span>
	                </div>
	                <div class="form-group">
	                  <button type="submit" class="btn btn-primary">Tambah</button>
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
				predikat : {
					nilai_minimal: '',
					nilai_maksimal: '',
					keterangan: ''
				}
			}
		},

		mounted(){
			// Nothing to mounted
		},

		methods: {
			storePredikat:function(e){
				e.preventDefault();

				var body = this.predikat;

				axios.post('/pendidikan/predikat/store', body).then(response => {
					if (response.data) {
						this.$router.push('/list_predikat');
					}
				}).catch((error) => {
					this.errors = error.response.data.errors;
				})
			}
		}
	}
</script>
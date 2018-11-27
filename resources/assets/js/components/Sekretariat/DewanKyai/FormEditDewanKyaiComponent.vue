<template>
	
<div id="app">
    <div class="panel">
        <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
            <div class="row row-lg">
                <div class="col-md-12">
                    <div v-if="message" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <i class="icon wb-check" aria-hidden="true"></i> {{ message }}</a>
                    </div>
                    <div v-if="messageWarning" class="alert dark alert-icon alert-warning alert-dismissible" role="alert">
                          {{ messageWarning }}
                    </div>
                    <div v-if="messageError" class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                          {{ messageError }}
                    </div>
                    <form @submit="store" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                        <h4 class="example-title"><i class="icon wb-edit"></i> Form Edit Dewan Kyai</h4>
                        <div class="example">
                            <!-- <div class="form-group">
                                <label class="form-control-label" for="">NIS</label>
                                <select class="form-control select2">
                                        <optgroup label="Tersedia">
                                            <option value="">3273110911180000</option>
                                            <option value="">3273110911180000</option>
                                            <option value="">3273110911180000</option>
                                        </optgroup>
                                        <option disabled selected></option>
                                </select>
                            </div> -->
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label class="form-control-label" for="inputBasicFirstName">Nama Dewan Kyai</label>
                                    <input type="text" class="form-control" v-model="nama_dewan_kyai">
                                    <span class="label label-danger" v-if="errors.nama_dewan_kyai">{{ errors.nama_dewan_kyai[0] }}</span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-control-label" for="inputBasicFirstName">Upload Foto</label>
                                    <input type="file" class="form-control" v-on:change="onImageChange">
                                    <span class="label label-danger" v-if="errors.foto">{{ errors.foto[0] }}</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary col-md-6" >Edit </button>
                                <router-link to="/list_dewankyai" class="btn btn-warning col-md-6" >Batal </router-link>
                           </div>
                        </div><!--/Example-->
                        </div><!--/.form-group
                        =========================-->
                        <div class="form-group col-md-3 col-sm-12" style="padding-left: 15px;">
                        <h4 class="example-title">Foto</h4>
                        <div class="example">
                            <div class="form-group">
								<div class="col-md-12 text-center">
									<img :src="image_preview" width="150" height="150" class="img-responsive" alt="">
								</div>
                            </div>
                        </div><!--/.example-->
                        </div><!--/.form-group
                        ======================-->
                     </div><!--/.form-row-->
                    </form>
                </div><!--/.col-->
            </div>
        </div>
    </div>
</div>

</template>
<script>
	export default {
		mounted() {
			this.getDewanKyaiID()
		},

		data(){
			return {
				errors: [],
				message: '',
				messageError: '',
				messageWarning: '',
				image: '',
				image_preview: '',
				nama_dewan_kyai: ''
			}
		},

		methods: {
			store(e){
                e.preventDefault();
                let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                let formData = new FormData();
                var id = currentObj.$route.params.id;
                formData.append('nama_dewan_kyai', currentObj.nama_dewan_kyai);
                formData.append('image', currentObj.image);
 
                axios.put('/sekretariat/dewankyai/'+ id +'/update', formData, config)
                .then(function (response) {
                    currentObj.errors =[];
                    currentObj.message = response.data.response.message;
                    currentObj.nama_dewan_kyai = '';
                    currentObj.foto = '';
                    currentObj.$router.push('list_dewankyai');
                })
                .catch(function (error) {
                    currentObj.errors = error.response.data.errors;
                    currentObj.messageError = response.data.response.messageError;
                    currentObj.messageWarning = response.data.response.messageWarning;
                    currentObj.message = response.data.response.message;
                });
			},

			onImageChange(e){
                console.log(e.target.files[0]);
                this.image = e.target.files[0];
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                	return;
                this.createImage(files[0]);
			},


            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image_preview = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            getDewanKyaiID(){
            	let app = this;
            	var id = app.$route.params.id;
            	axios.get('/sekretariat/dewankyai/'+ id +'/show').then(response => {
            		app.nama_dewan_kyai = response.data.nama_dewan_kyai;
            		app.image_preview = '/storage/dewan_pic/'+ response.data.foto;
            	});
            }
	}

}
</script>
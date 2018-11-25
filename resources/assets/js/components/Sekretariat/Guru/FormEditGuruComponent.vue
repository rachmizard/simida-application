<template>

    <div class="panel">
        <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
            <div class="row row-lg">
                <div class="col-md-12">
                    <div v-if="messageGuru" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <i class="icon wb-check" aria-hidden="true"></i> {{ messageGuru }}, lihat hasil <a href="/sekretariat/guru" class="text-warning">Beralih ke halaman list Kelas.</a>
                    </div>
                    <div v-if="messageGuruWarning" class="alert dark alert-icon alert-warning alert-dismissible" role="alert">
                          {{ messageGuruWarning }}
                    </div>
                    <div v-if="messageGuruError" class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                          {{ messageGuruError }}
                    </div>
                    <form autocomplete="off" @submit.prevent="store">
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                        <h4 class="example-title">Data Guru</h4>
                        <div class="example">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-control-label" for="inputBasicFirstName">Nama Guru</label>
                                    <input type="text" v-model="guru.nama_guru" class="form-control" placeholder="Nama Guru...">
                                    <span v-if="errors.nama_guru" class="label label-danger">{{ errors.nama_guru[0] }}</span>
                                </div>
                            </div>
                        </div><!--/Example-->
                        </div><!--/.form-group
                        =========================-->
                        <div class="form-group col-md-6 col-sm-12" style="padding-left: 15px;">
                        <h4 class="example-title">Data Lanjutan</h4>
                        <div class="example">
                            <div class="form-group col-md-12">
                                <label class="form-control-label" for="inputBasicFirstName">Tingkat</label>
                                <select class="form-control select2" v-model="guru.tingkat_id" placeholder="">
                                    <option selected value="" disabled="">Pilih Tingkat Guru</option>
                                    <option v-for="list in listTingkat.data" v-bind:value="list.id">{{ list.nama_tingkatan }}</option>
                                </select>
                                <span v-if="errors.tingkat_id" class="label label-danger">{{ errors.tingkat_id[0] }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-control-label" for="inputBasicFirstName">Wali Kelas</label>
                                <select class="form-control select2" v-model="guru.kelas_id" placeholder="">
                                    <option selected value="" disabled="">Pilih Kelas</option>
                                    <option v-for="kelas in listKelas.data" v-bind:value="kelas.id">{{ kelas.nama_kelas }}</option>
                                </select>
                                <span v-if="errors.kelas_id" class="label label-danger">{{ errors.kelas_id[0] }}</span>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary col-md-6" >Edit Kelas</button>
                        		<router-link :to="{path: '/'}" class="btn btn-warning col-md-6">Batal</router-link>
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
</template>
<script>
	export default {
		mounted(){
			this.listTingkatan();
			this.kelas();
			this.getGuruID();
		},

		data(){
			return {
				errors: [],
				listTingkat: [],
				listKelas: [],
				guru: {
					tingkat_id: '',
					nama_guru: '',
					kelas_id: ''
				},
				messageGuru: '',
				messageGuruWarning: '',
				messageGuruError: ''
			}
		},

		methods: {

			getGuruID(){
				let app = this;
				var id = app.$route.params.id;
				axios.get('/sekretariat/guru/'+ id +'/show').then(response => {
					app.guru.tingkat_id = response.data.tingkat_id;
					app.guru.nama_guru = response.data.nama_guru;
					app.guru.kelas_id = response.data.kelas_id;
				});
			},

			listTingkatan(){
                let app = this;
                axios.get('/sekretariat/tingkatan/getJSON').then(function(response) {
                    app.listTingkat = response.data;
                })
			},

			kelas(){
                let app = this;
                axios.get('/sekretariat/kelas/JSON').then(function(response) {
                    app.listKelas = response.data;
                })
			},

			store:function(e){
				let app = this;
				let body = this.guru;
				var id = app.$route.params.id;
				axios.put('/sekretariat/guru/'+ id +'/update', body).then(function(response){
					app.errors = [];
					app.messageGuru = response.data.response.message;
					app.messageGuruWarning = response.data.response.messageWarning;
					app.messageGuruError = response.data.response.messageError;
					app.$router.push('/');
				}).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.messageGuruError = 'Data belum lengkap, atau terjadi kesalahan teknis!';
                     app.messageGuruWarning = false;
                     app.messageGuru = false;
                });
			}
		}
	}
</script>
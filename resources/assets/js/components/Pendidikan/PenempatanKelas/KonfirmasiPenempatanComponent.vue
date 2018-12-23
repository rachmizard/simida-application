<template>
<div id="app">
    <div class="panel">
        <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
            <div class="row row-lg">
                <div class="col-md-12">
                    <div v-if="messageSuccess" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <i class="icon wb-check" aria-hidden="true"></i> {{ messageSuccess }}
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                        <h4 class="example-title"><i class="icon wb-book"></i> Silahkan Pilih Kelas & Tingkat</h4>
                        <div class="example">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label" for="">Kelas</label>
                                    <Select2 v-model="penempatankelas.kelas_id" :options="kelass"/>
                                    <span class="badge badge-danger" v-if="errors.kelas_id">{{ errors.kelas_id[0] }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label" for="">Tingkat Kelas</label>
                                    <Select2 v-model="penempatankelas.tingkat_id" :options="tingkats"/>
                                    <span class="badge badge-danger" v-if="errors.tingkat_id">{{ errors.tingkat_id[0] }}</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <button @click="storePenempatanKelas" class="btn btn-primary col-md-4"> Simpan</button>
                           </div>
                        </div><!--/Example-->
                        </div>
                     </div><!--/.form-row-->
                </div><!--/.col-->
            </div>
        </div>
    </div>
</div>

</template>
<script>
    import Select2 from 'v-select2-component';
	export default {
        components: {
            Select2
        },

		mounted() {
            this.fetchKelas();
            this.fetchTingkat();
		},

		data(){
			return {
                errors: [],
                santris: [],
                checkedRows: [],
                kelass: [],
                tingkats: [],
                penempatankelas: {
                    santri_id: this.$route.params.id,
                    kelas_id: '',
                    tingkat_id: ''
                },
                messageSuccess: '',
                messageAlert: ''
			}
		},

		methods: {
            fetchKelas(){
                axios.get('/sekretariat/kelas/KelasSelect2').then(resp =>{
                    this.kelass = resp.data.data;
                })
            },

            fetchTingkat(){
              axios.get('/sekretariat/tingkatan/TingkatanSelect2').then(resp =>{
                    this.tingkats = resp.data.data;
                })  
            },

            storePenempatanKelas:function(){
                var body = this.penempatankelas
                axios.post('/pendidikan/penempatankelas/storePenempatanKelas', body)
                    .then(response => {
                        this.$router.push('/penempatankelas');
                    }).catch((error) => {
                        this.errors = error.response.data.errors;
                    });
            }
	   }

}
</script>
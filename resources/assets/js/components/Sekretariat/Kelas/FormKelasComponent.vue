<template>
<div class="panel-body container-fluid" style="background-color: #fdfdfd;">
    <div class="row row-lg">
        <div class="col-md-12">
            <div v-if="message" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <i class="icon wb-check" aria-hidden="true"></i> {{ message }}, lihat hasil <a href="/sekretariat/kelas">Beralih ke halaman list Kelas.</a>
            </div>
            <div v-if="messageWarning" class="alert dark alert-icon alert-warning alert-dismissible" role="alert">
                  {{ messageWarning }}
            </div>
            <div v-if="messageError" class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                  {{ messageError }}
            </div>
            <form autocomplete="off" action="/sekretariat/kelas/store" @submit.prevent="store">
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                <h4 class="example-title">Data Kelas</h4>
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
                        <div class="form-group col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Nama Kelas</label>
                           <input type="text" v-model="kelas.nama_kelas" class="form-control" placeholder="Nama Kelas baru.." autocomplete="off" />
                            <span v-if="errors.nama_kelas" class="label label-danger">{{ errors.nama_kelas[0] }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Kelas</label>
                            <select v-model="kelas.tingkat" class="form-control select2" placeholder="">
                                <option selected value="" disabled="">Pilih Kelas</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <span v-if="errors.tingkat" class="label label-danger">{{ errors.tingkat[0] }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Lokal</label>
                            <select class="form-control select2" v-model="kelas.lokal" placeholder="">
                                <option selected value="" disabled="">Pilih Lokal</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                            </select>
                            <span v-if="errors.lokal" class="label label-danger">{{ errors.lokal[0] }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Tingkat</label>
                            <select class="form-control select2" v-model="kelas.tingkat_id" placeholder="">
                                <option selected value="" disabled="">Pilih Tingkat Kelas</option>
                                <option value="1">Ibtida</option>
                                <option value="2">Tsanawi</option>
                                <option value="3">Ma'had Aly</option>
                            </select>
                            <span v-if="errors.tingkat_id" class="label label-danger">{{ errors.tingkat_id[0] }}</span>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-control-label" for="inputBasicFirstName">Jenis Kelamin</label>
                            <select class="form-control" v-model="kelas.jk" placeholder="">
                                <option selected value="" disabled="">Pilih Jenis Kelamin Untuk Kelas</option>
                                <option value="Putra">Putra</option>
                                <option value="Putri">Putri</option>
                            </select>
                            <span v-if="errors.jk" class="label label-danger">{{ errors.jk[0] }}</span>
                        </div>
                    </div>
                </div><!--/Example-->
                </div><!--/.form-group
                =========================-->
                <div class="form-group col-md-6 col-sm-12" style="padding-left: 15px;">
                <h4 class="example-title">Data Guru</h4>
                <div class="example">
                    <div class="form-group">
                        <label class="form-control-label" for="">Nama Guru</label>
                        <select class="form-control select2" v-model="kelas.guru_id" placeholder="Nama Guru">
                            <option disabled selected value="">Pilih Guru</option>
                            <option value="1">Usman Khatam</option>
                            <option value="2">Jeffry Washington</option>
                        </select>
                        <span v-if="errors.guru_id" class="label label-danger">{{ errors.guru_id[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="">Badal (Pengganti)</label>
                        <select class="form-control select2" v-model="kelas.badal_id" placeholder="Nama Guru">
                            <option disabled selected value="">Pilih Guru</option>
                            <option value="1">Usman Khatam</option>
                            <option value="2">Jeffry Washington</option>
                        </select>
                        <span v-if="errors.badal_id" class="label label-danger">{{ errors.badal_id[0] }}</span>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary col-md-12" >Tambah Kelas </button>
                   </div>
                </div><!--/.example-->
                </div><!--/.form-group
                ======================-->
             </div><!--/.form-row-->
            </form>
        </div><!--/.col-->
    </div>
</div>
</template>
<script>
	
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data(){
            return {
            	errors: [],
            	kelas: {
            		nama_kelas: '',
            		tingkat: '',
            		lokal: '',
            		tingkat_id: '',
            		jk: '',
            		guru_id: '',
            		badal_id: ''
            	},
            	message: '',
            	messageError: '',
            	messageWarning: ''
            }
        },

        methods: {
            store:function(e){
            	let app = this;
            	var kelasQue = app.kelas;
            	axios.post(e.target.action, kelasQue).then(function(respon){
            		app.errors = [];
            		app.kelas.nama_kelas = '';
            		app.kelas.tingkat = '';
            		app.kelas.lokal = '';
            		app.kelas.tingkat_id = '';
            		app.kelas.jk = '';
            		app.kelas.guru_id = '';
            		app.kelas.badal_id = '';
            		app.message = respon.data.response.message;
            		app.messageError = respon.data.response.messageError;
            		app.messageWarning = respon.data.response.messageWarning;

            		setTimeout(() => {
                        app.message = false;
                        app.messageError = false;
                        app.messageWarning = false;
            		}, 5000);
            	}).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.messageError = 'Data belum lengkap, atau terjadi kesalahan teknis!';
                     app.message = false;
                     app.messageWarning = false;
                });
            }
        }

    }
</script>
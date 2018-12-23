<template>
    <div id="app">
        <div class="panel">
            <div class="panel col-md-6">
                <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                    <div class="row row-lg">
                        <div class="col-md-12">
                            <div v-if="messageDataNamaAsrama" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <i class="icon wb-check" aria-hidden="true"></i> {{ messageDataNamaAsrama }}
                            </div>
                            <form @submit.prevent="storeDataNamaAsrama" action="/sekretariat/asrama/storeNamaAsrama"  autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                    <h4 class="example-title">Tambah Data Nama Asrama</h4>
                                        <div class="example">
                                            <div class="form-row">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="inputBasicFirstName">Nama Asrama Baru</label>
                                                   <input v-model="dataNamaAsrama.nama_asrama_baru" type="text" class="form-control" placeholder="Nama Asrama baru.." autocomplete="off" />
                                                        <span v-if="errors.nama_asrama_baru" class="badge badge-danger">{{ errors.nama_asrama_baru[0] }}</span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-control-label" for="inputBasicFirstName">Kategori Asrama</label>
                                                    <select v-model="dataNamaAsrama.kategori" class="form-control" :placeholder="placeholder.kategori">
                                                        <option disabled value="">Kategori Asrama</option>
                                                        <option value="putra">Putra</option>
                                                        <option value="putri">Putri</option>
                                                        <option value="mutawasilin">Mutawasilin</option>
                                                    </select>
                                                    <span v-if="errors.kategori" class="badge badge-danger">{{ errors.kategori[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Tambah Data Nama Asrama</button>
                                           </div>
                                        </div><!--/Example-->
                                </div><!--/.form-group
                                =========================-->
                             </div><!--/.form-row-->
                            </form>
                        </div><!--/.col-->
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                <div class="row row-lg">
                    <div class="col-md-12">
                        <div v-if="message" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <i class="icon wb-check" aria-hidden="true"></i> {{ message }}
                        </div>
                        <div v-if="messageError" class="alert dark alert-icon alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            {{ messageError }}
                        </div>
                        <form @submit.prevent="store" action="/sekretariat/asrama/store"  autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                            <h4 class="example-title">Data Asrama</h4>
                            <div class="example">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label" for="inputBasicFirstName">Kategori Asrama</label>
                                        <select v-model="asrama.kategori_asrama" @change="filterAsrama()" class="form-control" :placeholder="placeholder.kategori_asrama">
                                            <option disabled value="">Kategori Asrama</option>
                                            <option value="putra">Putra</option>
                                            <option value="putri">Putri</option>
                                            <option value="mutawasilin">Mutawasilin</option>
                                        </select>
                                        <span v-if="errors.kategori_asrama" class="badge badge-danger">{{ errors.kategori_asrama[0] }}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label" for="inputBasicFirstName">Nama Asrama</label>
                                        <select v-model="asrama.nama_asrama" class="form-control" :placeholder="placeholder.nama_asrama">
                                            <option  disabled value="">Pilih Asrama</option>
                                            <option v-for="asrama in namaAsrama.data" :value="asrama.asrama_id" :key="asrama.asrama_id">{{ asrama.nama_asrama }}</option>
                                        </select>
                                        <span v-if="errors.nama_asrama" class="badge badge-danger">{{ errors.nama_asrama[0] }}</span>
                                    </div>
                                </div>
                            </div><!--/Example-->
                            </div><!--/.form-group
                            =========================-->
                            <div class="form-group col-md-6 col-sm-12" style="padding-left: 15px;">
                            <h4 class="example-title">Rais'Am</h4>
                            <div class="example">
                                <div class="form-group">
                                   <label class="form-control-label" for="inputBasicFirstName">Rais'Am Asrama</label>
                                   <input v-model="asrama.roisam_asrama" type="text" class="form-control" placeholder="First Name" autocomplete="off" />
                                        <span v-if="errors.roisam_asrama" class="badge badge-danger">{{ errors.roisam_asrama[0] }}</span>
                                </div>
                                <div class="form-row">
                                    <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Tambah Asrama</button>
                               </div>
                            </div>
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
            this.getNamaAsrama();
        },

        data(){
            return {
                errors: [],
                namaAsrama: [],
                dataNamaAsrama: {
                    nama_asrama_baru: '',
                    kategori: '',
                },
                asrama: {
                    kategori_asrama: '',
                    nama_asrama: '',
                    roisam_asrama: ''
                },
                placeholder: {
                    kategori_asrama: 'Pilih Kategori Asrama',
                    nama_asrama: 'Pilih Nama Asrama'
                },
                message: '',
                messageError: '',
                messageDataNamaAsrama: '',
                messageDataNamaAsramaError: ''
            }
        },

        methods: {
            getNamaAsrama(){
                // axios.get('/sekretariat/asrama/getAsrama').then(response => {
                //     this.namaAsrama = response.data;
                // });
            },

            storeDataNamaAsrama:function(e){
                let app = this;
                var dataNamaAsrama = app.dataNamaAsrama;
                axios.post(e.target.action, dataNamaAsrama)
                .then(function (resp) {
                  app.errors = [];
                  app.messageDataNamaAsrama = 'Berhasil menambahkan nama Asrama baru!';
                    // app.messageError = false; // showing result
                  app.dataNamaAsrama.nama_asrama_baru = ''; // clear form
                  app.dataNamaAsrama.kategori = ''; // clear form
                    // app.$router.replace('/'); // redirect to url "/"
                    setTimeout(() => {
                        app.messageDataNamaAsramaError = false;
                        app.messageDataNamaAsrama = false;
                    }, 5000);
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.messageDataNamaAsrama = false;
                });
            },

            filterAsrama(){
                var app = this;
                axios.get('/sekretariat/asrama/getAsrama/'+ app.asrama.kategori_asrama).then(response => {
                        app.namaAsrama = response.data;
                });
            },

            store:function(e){
                let app = this;
                var dataAsrama = app.asrama;
                axios.post(e.target.action, dataAsrama)
                .then(function (resp) {
                  app.errors = [];
                  app.messageError = resp.data.response.messageError;
                  app.message = resp.data.response.message;
                    // app.messageError = false; // showing result
                  app.asrama.kategori_asrama = ''; // clear form
                  app.asrama.nama_asrama = ''; // clear form
                  app.asrama.roisam_asrama = ''; // clear form
                    // app.$router.replace('/'); // redirect to url "/"
                    setTimeout(() => {
                        app.messageError = false;
                        app.message = false;
                    }, 5000);
                 app.getNamaAsrama();
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.message = false;
                });
            }
        }

    }
</script>
<template>
    <div id="app">
        <div class="panel">
            <div class="panel col-md-6">
                <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                    <div class="row row-lg">
                        <div class="col-md-12">
                            <div v-if="message" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <i class="icon wb-check" aria-hidden="true"></i> {{ message }}
                            </div>
                            <div v-if="messageWarning" class="alert dark alert-icon alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <i class="icon wb-check" aria-hidden="true"></i> {{ messageWarning }}
                            </div>
                            <form @submit.prevent="storesemester" action="/pendidikan/semester/store"  autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                    <h4 class="example-title">Tambah Semester</h4>
                                        <div class="example">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                   <label class="form-control-label" for="inputBasicFirstName">Tingkat Semester</label>
                                                   <input v-model="semester.tingkat_semester" type="text" class="form-control" placeholder="Tahun baru.." autocomplete="off" />
                                                        <span v-if="errors.tingkat_semester" class="label label-danger">{{ errors.tingkat_semester[0] }}</span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-control-label" for="inputBasicFirstName">Periode</label>
                                                    <select class="form-control" v-model="semester.periode_id">
                                                        <!-- STIL DUMMY -->
                                                        <option v-for="periode in periodes.data" :value="periode.id">{{ periode.nama_periode }}</option>
                                                        <!-- END STILL DUMMY -->
                                                    </select>
                                                    <span v-if="errors.periode_id" class="label label-danger">{{ errors.periode_id[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Tambah</button>
                                                <router-link :to="{ name: 'listSemester' }" class="btn btn-warning">Batal</router-link>
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
        </div>
</template>
<script>
	import Datepicker from 'vuejs-datepicker';

    export default {
	  components: {
	    Datepicker
	  },

        mounted() {
            this.fetchPeriode();
        },

        data(){
            return {
                errors: [],
                semester: {
                    tingkat_semester: '',
                    periode_id: ''
                },
                periodes: [],
                message: '',
                messageError: '',
                messageWarning: ''
            }
        },

        methods: {
            fetchPeriode(){
                axios.get('/pendidikan/periode/getPeriodeDataTables').then(response => {
                    this.periodes = response.data;
                })
            },

            storesemester:function(e){
                let app = this;
                var semester = app.semester;
                axios.post(e.target.action, semester)
                .then(function (resp) {
                  app.errors = [];
                  app.message = resp.data.message;
                    // app.messageError = false; // showing result
                  if (app.message == 'success') {
                      app.semester.tingkat_semester = ''; // clear form
                      app.semester.periode_id = ''; // clear form
                      app.$router.replace('/list_semester'); // redirect to url "/"
                        setTimeout(() => {
                            app.messageError = false;
                            app.message = false;
                        }, 5000);
                  }else{
                    app.message = false;
                    app.messageWarning = 'Semester sudah tersedia di periode yg sama!';
                  }
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.message = false;
                });
            }
        }

    }
</script>
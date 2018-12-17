<template>
    <div id="app">
      <div class="row row-lg">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-4">
              <div class="panel">
                  <div class="panel col-md-12">
                      <div class="panel-body container-fluid" style="background-color: #fdfdfd;">
                          <div class="row row-lg">
                              <div class="col-md-12">
                                  <div v-if="messageJenis" class="alert dark alert-icon alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                        <i class="icon wb-check" aria-hidden="true"></i> {{ messageJenis }}
                                  </div>
                                  <form @submit.prevent="postnamajns" autocomplete="off">
                                  <div class="form-row">
                                      <div class="form-group col-md-12 col-sm-12" style="padding-right: 15px;">
                                          <h4 class="example-title"><i class="icon wb-plus text-info"></i> Edit Jenis Pengeluaran</h4>
                                              <div class="example">
                                                  <div class="form-row">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                                  <div class="input-group input-group-icon">
                                                                      <input v-model="nama_jenis_pengeluarannya.name" type="text" class="form-control" placeholder="Contoh: Atk/Bangunan/Kesehatan" autocomplete="off" />
                                                                  </div>
                                                                      <span v-if="errorsJenis.nama_jenis_pengeluaran" class="badge badge-sm badge-danger">{{ errorsJenis.nama_jenis_pengeluaran[0] }}</span>
                                                          </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="form-row">
                                                      <button type="submit" class="btn btn-primary"><i class="icon wb-check"></i> Edit</button>
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
        	this.getJenisPengeluaranId()
        },

        data(){
            return {
            	errorsJenis: [],
                nama_jenis_pengeluarannya: {
                  name: '',
                },
                message: '',
                messageAlert: '',
                messageSuccess: '',
                messageJenis: ''
            }
        },

        methods: {
        	getJenisPengeluaranId(){
        		var id = this.$route.params.id;
        		axios.get('/keuangan/pengeluaran/jenispengeluaran/'+ id +'/showJenisPengeluaran').then(response => {
        			this.nama_jenis_pengeluarannya.name = response.data.nama_jenis_pengeluaran;
        		})
        	},

            postnamajns:function(a){
              var wadahna = this.nama_jenis_pengeluarannya;
              // console.log(this.wadahna);
              var id = this.$route.params.id;
              axios.put('/keuangan/pengeluaran/jenispengeluaran/'+ id +'/updateJenisPengeluaran', wadahna).then(response => {
                this.errorsJenis = [];
                this.messageJenis = response.data.response;
                if (this.messageJenis == 'success') {
                  this.messageJenis = 'Jenis pengeluaran berhasil di editkan'
                }
                setTimeout(() => {
                  this.messageJenis = false;
                  this.$router.push('/keuangan/pengeluaran');
                }, 3000);
              }).catch((error) => {
                     this.errorsJenis = error.response.data.errors;
                     this.message = false;
              });
            }
        },

    }
</script>
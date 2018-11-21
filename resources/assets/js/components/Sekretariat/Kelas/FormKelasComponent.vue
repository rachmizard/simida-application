<template>
<div class="panel-body container-fluid" style="background-color: #fdfdfd;">
    <div class="row row-lg">
        <div class="col-md-12">
            <form autocomplete="off" action="sekretariat/kelas/store" @submit.prevent="store">
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12" style="padding-right: 15px;">
                <h4 class="example-title">Data Kelas</h4>
                <div class="example">
                    <!-- <div class="form-group">
                        <label class="form-control-label" for="">NIS</label>
                        <select class="form-control selectTo">
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
                            <label class="form-control-label" for="inputBasicFirstName">Kelas</label>
                            <select class="form-control selectTo">
                                <optgroup label="Kelas">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </optgroup>
                                <option disabled selected></option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label" for="inputBasicFirstName">Tingkat</label>
                            <select class="form-control selectTo">
                                <optgroup label="Tingkat 1">
                                    <option value="">1A</option>
                                    <option value="">1B</option>
                                    <option value="">1C</option>
                                </optgroup>
                                <optgroup label="Tingkat 2">
                                    <option value="">2A</option>
                                    <option value="">2B</option>
                                    <option value="">2C</option>
                                </optgroup>
                                <optgroup label="Tingkat 3">
                                    <option value="">3A</option>
                                    <option value="">3B</option>
                                    <option value="">3C</option>
                                </optgroup>
                                <optgroup label="Tingkat 4">
                                    <option value="">4A</option>
                                    <option value="">4B</option>
                                    <option value="">4C</option>
                                </optgroup>
                                <option disabled selected></option>
                            </select>
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
                        <select class="form-control selectTo">
                            <optgroup label="Guru">
                                <option value="">Samsul Alrifin</option>
                            </optgroup>
                            <option disabled selected></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="">Badal</label>
                        <select class="form-control selectTo">
                            <optgroup label="Guru">
                                <option value="">Samsul Alrifin</option>
                            </optgroup>
                            <option disabled selected></option>
                        </select>
                    </div>
                    <div class="form-row">
                        <button type="button" class="btn btn-primary" >Submit </button>
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
            		nama_guru: '',
            		badal_guru: '',
            	},
            	message: '',
            	messageError: ''
            }
        },

        methods: {
            store:function(e){
            	let app = this;
            	var kelas = app.kelas
            	axios.post(e.target.action, kelas).then(function(respon){
            		app.errors = [];
            		app.kelas.nama_kelas = '';
            		app.kelas.tingkat = '';
            		app.kelas.nama_guru = '';
            		app.kelas.badal_guru = '';
            		app.message = respon.data.response.message;

            		setTimout(() => {
                        app.message = false;
                        app.messageError = false;
            		}, 5000);
            	}).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.message = false;
                });
            }
        }

    }
</script>
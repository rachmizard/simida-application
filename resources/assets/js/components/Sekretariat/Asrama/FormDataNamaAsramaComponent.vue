<template>
</template>
<script>
	
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data(){
            return {
                errors: [],
                asrama: {
                    nama_asrama: ''
                },
                message: '',
            }
        },

        methods: {
            store:function(e){
                let app = this;
                var dataAsrama = app.asrama;
                axios.post(e.target.action, dataAsrama)
                .then(function (resp) {
                  app.errors = [];
                  app.message = 'Berhasil menambahkan nama Asrama baru!';
                    // app.messageError = false; // showing result
                  app.asrama.nama_asrama = ''; // clear form
                    // app.$router.replace('/'); // redirect to url "/"
                }).catch((error) => {
                     app.errors = error.response.data.errors;
                     app.message = false;
                });
            }
        }

    }
</script>
<template>
	
</template>
<script>
	export default{
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Setelah status entri ini di rubah akan otomatis tersimpan di riwayat entri izin, tetap lanjutkan?");
			if (r == true){
			  	axios.put('/keamanan/'+ id +'/update/status').then(response => {
			  		app.$router.push('/list_entri');
			  	})
			}else{
					app.$router.push('/list_entri');
			}
		},

		data(){
			return {

			}
		}
	}
</script>
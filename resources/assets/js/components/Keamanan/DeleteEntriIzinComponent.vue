<template>

</template>
<script>
	export default{
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Seluruh histori pada izin santri ini akan ikut dihapus, lanjutkan?");
			if (r == true){
			  	axios.delete('/keamanan/'+ id +'/destroy').then(response => {
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

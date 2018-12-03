<template>
	
</template>
<script>
	export default{
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Hapus data ini?");
			if (r == true){
			  	axios.delete('/pendidikan/periode/'+ id +'/delete').then(response => {
			  		app.$router.push('/list_periode');
			  	})
			}else{
					app.$router.push('/list_periode');
			}
		},

		data(){
			return {

			}
		}
	}
</script>
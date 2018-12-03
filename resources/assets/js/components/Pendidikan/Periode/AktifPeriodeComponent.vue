<template>
	
</template>
<script>
	export default{
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Aktifkan tahun ini?");
			if (r == true){
			  	axios.put('/pendidikan/periode/'+ id +'/aktif').then(response => {
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
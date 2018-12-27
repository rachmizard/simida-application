<template>
	
</template>
<script>
	export default {
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Aktifkan semester ini?");
			if (r == true){
			  	axios.put('/pendidikan/semester/'+ id +'/statusActive').then(response => {
			  		app.$router.push('/list_semester');
			  	})
			}else{
					app.$router.push('/list_semester');
			}
		}
	}
</script>
<template>
	
</template>
<script>
	export default {
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Anda yakin?");
			if (r == true){
			  	axios.delete('/pendidikan/semester/'+ id +'/destroy').then(response => {
			  		app.$router.push('/list_semester');
			  	})
			}else{
					app.$router.push('/list_semester');
			}
		}
	}
</script>
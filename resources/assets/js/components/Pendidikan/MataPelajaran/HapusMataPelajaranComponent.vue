<template>
	
</template>
<script>
	export default {
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Anda yaking ingin menghapus mata pelajaran ini?");
			if (r == true){
			  	axios.delete('/pendidikan/matapelajaran/'+ id +'/destroy').then(response => {
			  		app.$router.push('/list_matapelajaran');
			  	})
			}else{
					app.$router.push('/list_matapelajaran');
			}
		}
	}
</script>
<template>
	
</template>
<script>
	export default {
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Anda yakin ingin jadwal pelajaran ini?");
			if (r == true){
			  	axios.delete('/pendidikan/jadwalpelajaran/'+ id +'/destroy').then(response => {
			  		app.$router.push('/jadwalpelajaran');
			  	})
			}else{
					app.$router.push('/jadwalpelajaran');
			}
		}
	}
</script>
<template>
	
</template>
<script>
	export default {
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Anda yakin ingin menghapus kegiatan ini?");
			if (r == true){
			  	axios.delete('/pendidikan/kegiatan/'+ id +'/destroy').then(response => {
			  		app.$router.push('/list_kegiatan');
			  	})
			}else{
					app.$router.push('/list_kegiatan');
			}
		}
	}
</script>
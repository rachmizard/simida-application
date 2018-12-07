<template>
	
</template>
<script>
	export default {
<<<<<<< HEAD
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
=======
		
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
	}
</script>
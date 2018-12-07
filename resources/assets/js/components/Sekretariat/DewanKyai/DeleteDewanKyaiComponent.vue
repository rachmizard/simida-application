<template>
	
</template>
<script>
	export default {
		mounted(){
<<<<<<< HEAD
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Anda yakin ingin menghapusnya?");
			if (r == true){
			  	axios.delete('/sekretariat/dewankyai/'+ id +'/destroy').then(response => {
			  		app.$router.push('/list_dewankyai');
			  	})
			}else{
					app.$router.push('/list_dewankyai');
=======

		},

		data(){
			return {

>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
			}
		}
	}
</script>
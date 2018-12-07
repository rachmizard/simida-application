<template>
	
</template>
<script>
	export default {
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Lanjutkan?");
			if (r == true){
			  	axios.post('/sekretariat/dewankyai/'+ id +'/aktif').then(response => {
			  		app.$router.push('/list_dewankyai');
			  	})
			}else{
					app.$router.push('/list_dewankyai');
			}
		}
	}
</script>
<template>
	
</template>
<script>
	export default {
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Anda yakin ingin menghapusnya?");
			if (r == true){
			  	axios.delete('/sekretariat/dewankyai/'+ id +'/destroy').then(response => {
			  		app.$router.push('/list_dewankyai');
			  	})
			}else{
					app.$router.push('/list_dewankyai');
			}
		},

		data(){
			return {

			}
		}
	}
</script>
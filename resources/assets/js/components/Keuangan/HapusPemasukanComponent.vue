<template>
	
</template>
<script>
	export default {
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			var r=confirm("Anda yakin?");
			if (r == true){
			  	axios.delete('/keuangan/pemasukan/'+ id +'/destroy').then(response => {
			  		app.$router.push('/keuangan/pemasukan');
			  	})
			}else{
					app.$router.push('/keuangan/pemasukan');
			}
		}
	}
</script>
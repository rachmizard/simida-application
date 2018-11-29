<template>
	<div class="panel">
		<div class="panel-body">
			<h4>Anda yakin menghapus {{ santri.nama_santri }} dari data santri?</h4>
			<div class="btn btn-group">
				<button class="btn btn-sm btn-danger" @click="deleteAction()"><i class="icon wb-trash"></i> Ya</button>
				<button class="btn btn-sm btn-default" @click="abortDelete()">Tidak</button>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		mounted(){
			let app = this;
			var id = app.$route.params.id;
			axios.get('/sekretariat/santri/'+ id +'/show').then(response => {
				app.santri.nama_santri = response.data.nama_santri;
			})
		},

		data(){
			return {
				santri: {
					nama_santri: ''
				}
			}
		},

		methods: {

			deleteAction(){
				let app = this;
				var id = app.$route.params.id;
				axios.delete('/sekretariat/santri/'+ id +'/destroy').then(response => {
					app.$router.push('/list_santri');
				});
			},

			abortDelete(){
				let app = this;
				app.$router.push('/list_santri');
			}
		}

	}
</script>
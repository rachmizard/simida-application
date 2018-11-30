<template>
	<div class="panel">
		<div class="panel-body">
			<h4>Anda yakin menghapus {{ kelas.nama_kelas }} dari data kelas?</h4>
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
			axios.get('/sekretariat/kelas/'+ id +'/show').then(response => {
				app.kelas.nama_kelas = response.data.nama_kelas;
			})
		},

		data(){
			return {
				kelas: {
					nama_kelas: ''
				}
			}
		},

		methods: {

			deleteAction(){
				let app = this;
				var id = app.$route.params.id;
				axios.delete('/sekretariat/kelas/'+ id +'/destroy').then(response => {
					app.$router.push('/list_kelas');
				});
			},

			abortDelete(){
				let app = this;
				app.$router.push('/list_kelas');
			}
		}

	}
</script>
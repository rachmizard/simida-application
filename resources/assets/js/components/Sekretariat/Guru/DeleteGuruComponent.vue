<template>
	<div class="panel">
		<div class="panel-body">
			<h4>Anda yakin menghapus {{ guru.nama_guru }} dari data Guru?</h4>
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
			axios.get('/sekretariat/guru/'+ id +'/show').then(response => {
				app.guru.nama_guru = response.data.nama_guru;
			})
		},

		data(){
			return {
				guru: {
					nama_guru: ''
				}
			}
		},

		methods: {

			deleteAction(){
				let app = this;
				var id = app.$route.params.id;
				axios.delete('/sekretariat/guru/'+ id +'/destroy').then(response => {
					app.$router.push('/');
				});
			},

			abortDelete(){
				let app = this;
				app.$router.push('/');
			}
		}

	}
</script>
<template>
	<li class="site-menu-item">
	    <a href="/pendidikan/penempatankelas#/penempatankelas"><span class="site-menu-title">Penempatan Kelas <span v-if="total != 0" class="badge badge-danger badge-sm">{{ total }}</span></span></a>
	</li>
</template>
<script>
	export default {
		data(){
			return {
				total: ''
			}
		},

		created(){
	        Echo.channel('refresh-notification')
	        .listen('RefreshNotification', (e) => {
	          	axios.get('/pendidikan/penempatankelas/countingPendidikanNotifications').then(resp => {
					this.total = resp.data.total_unread
				})
	        });
		},

		mounted(){
			// will be counting the notifications who status is unread
			axios.get('/pendidikan/penempatankelas/countingPendidikanNotifications').then(resp => {
				this.total = resp.data.total_unread
			})
		}
	}
</script>
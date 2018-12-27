<template>
	<li class="site-menu-item">
	    <a href="/keamanan/#pemberitahuan"><span class="site-menu-title">Pemberitahuan <span class="badge badge-warning badge-sm">{{ total }}</span></span></a>
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
	          	axios.get('/keamanan/countingNotifications').then(resp => {
					this.total = resp.data.total_unread
				})
	        });
		},

		mounted(){
			// will be counting the notifications who status is unread
			axios.get('/keamanan/countingNotifications').then(resp => {
				this.total = resp.data.total_unread
			})
		}
	}
</script>
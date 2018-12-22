<template>
	<li class="site-menu-item">
	    <router-link :to="{ path: '/pemberitahuan' }"><span class="site-menu-title">Pemberitahuan <span class="badge badge-warning badge-sm">{{ total }}</span></span></router-link>
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
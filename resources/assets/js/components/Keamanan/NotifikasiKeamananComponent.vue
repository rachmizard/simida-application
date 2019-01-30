<template>	
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications" aria-expanded="false" data-animation="scale-up" role="button">
        <i class="icon wb-bell" aria-hidden="true"></i>
        <span class="badge badge-pill badge-danger up">{{ total }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
        <div class="dropdown-menu-header">
            <h5>Notifikasi</h5>
            <span v-if="total.length != 0" class="badge badge-round badge-danger">Baru {{ total }}</span>
        </div>

        <div class="list-group">
            <div data-role="container">
                <div data-role="content">
                    <a v-if="total.length != 0" v-for="notification in notifications.data" class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                            <div class="pr-10">
                                <i class="icon wb-order bg-red-600 white icon-circle" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">{{ notification.judul }}</h6>
                                <time class="media-meta" datetime="2018-06-12T20:50:48+08:00">{{ notification.created_at }}</time>
                            </div>
                        </div>
                    </a>
                    <a v-if="total.length == 0" class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                            <div class="media-body">
                                <h6 class="media-heading">Notikasi kosong.</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- <div class="dropdown-menu-footer">
            <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                <i class="icon wb-settings" aria-hidden="true"></i>
            </a>
            <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
    All notifications
  </a>
        </div> -->
    </div>
</li>
</template>
<script>
	export default {
		data(){
			return {
				total: '',
				notifications: []
			}
		},

		created(){
	        Echo.channel('refresh-notification')
	        .listen('RefreshNotification', (e) => {
	          	axios.get('/keamanan/countingNotifications').then(resp => {
					this.total = resp.data.total_unread
				})
				this.fecthNotification();
	        });
		},

		mounted(){
			// will be counting the notifications who status is unread
			axios.get('/keamanan/countingNotifications').then(resp => {
				this.total = resp.data.total_unread
			})

			this.fecthNotification();
		},

		methods: {
           fecthNotification(){
              axios.get('/keamanan/getPemberitahuanWhereIsUnRead').then(response => {
                this.notifications = response.data.data;
              })
           }
		}
	}
</script>
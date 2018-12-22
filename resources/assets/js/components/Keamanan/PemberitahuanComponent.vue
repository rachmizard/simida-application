<template>
    <div id="app">
      <div class="row row-lg">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-12">
              <!-- Panel Kitchen Sink -->
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">
                    <i class="icon wb-calendar"></i> Tanggal menampilkan Pemberitahuan
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-row">
                        <div class="form-group col-md-4">
                        <datepicker :bootstrap-styling="true" required="" placeholder="Tanggal mulai.." v-model="filter.start_date" :format="customFormatter"></datepicker>
                        <!-- <span v-if="errors.start_date[0]" class="badge badge-danger badge-sm">Tanggal Awal harus di isi!</span> -->
                        </div>
                        <div class="form-group col-md-2 text-center">
                          <span>Sampai</span>
                        </div>
                        <div class="form-group col-md-4">
                          <datepicker :bootstrap-styling="true" required="" placeholder="Tanggal akhir.." v-model="filter.end_date" :format="customFormatter"></datepicker>
                          <!-- <span v-if="errors.end_date[0]" class="badge badge-danger badge-sm">Tanggal Akhir harus di isi!</span> -->
                        </div>
                        <div class="form-group col-md-2">
                          <button @click="triggerFilter" class="btn btn-sm btn-info"><i class="icon wb-search"></i> Menampilkan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Panel Kitchen Sink -->
            </div>
            <div class="col-md-12">
              <!-- Panel Kitchen Sink -->
              <div class="panel">
                <header class="panel-heading">
                  <h3 class="panel-title">
                    <i class="icon wb-bell"></i> Pemberitahuan
                    <!-- <span class="panel-desc">
                      Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch
                    </span> -->
                  </h3>
                </header>

                <div class="panel-body table-responsive">
                  <table id="listEntriIzinTable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Notifikasi ID</th>
                        <th>Pesan</th>
                        <th>Keterangan</th>
                        <th>Tanggal Pemberitahuan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="notification in notifications.data">
                        <td>
                          <input type="checkbox">
                        </td>
                        <td>
                          {{ notification.id }}
                        </td>
                        <td>{{ notification.judul }}</td>
                        <td>{{ notification.pesan }}</td>
                        <td>{{ notification.created_at }}</td>
                        <td>
                          <button v-if="notification.status == 'unread'" class="btn btn-xs btn-info" @click="markAsRead(notification.id)"><i class="icon wb-check"></i></button>
                          <button class="btn btn-xs btn-danger" title="Hapus"><i class="icon wb-trash"></i></button>
                        </td>
                      </tr>
                      <!-- <tr v-if="notifications">
                        <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                      </tr> -->
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- End Panel Kitchen Sink -->
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
  import Datepicker from 'vuejs-datepicker';
  import Select2 from 'v-select2-component';
    export default {
    components: {
      Datepicker,
      Select2
    },

        mounted() {
          this.fecthNotification();
        },

        data(){
            return {
              errors: [],
              filter: {
                start_date: '',
                end_date: ''
              },
              notifications: []
            }
        },

        methods: {
            customFormatter(date) {
                  return moment(date).format('DD-MM-YYYY');
            },

           fecthNotification(){
              axios.get('keamanan/getPemberitahuan').then(response => {
                this.notifications = response.data.data;
              })
           },

           triggerFilter(){
            axios.get('keamanan/getPemberitahuan', { params : { start_date: this.filter.start_date, end_date: this.filter.end_date } }).then(response => {
                this.notifications = response.data;
              }).catch((error) => {
                this.errors = error.response.data.errors
              });
            console.log('successfully triggered!');
           },

           markAsRead(id){
              axios.post('/keamanan/notifikasi/'+ id +'/markAsRead').then(response => {
                this.fecthNotification();
              })
           }
        },

    }
</script>
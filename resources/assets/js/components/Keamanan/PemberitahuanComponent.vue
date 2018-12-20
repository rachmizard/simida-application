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

                <div class="panel-body table-responsive">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-row">
                        <div class="form-group col-md-5">
                        <datepicker :bootstrap-styling="true" required="" placeholder="Tanggal mulai.." v-model="filter.start_date" :format="customFormatter"></datepicker>
                        </div>
                        <div class="form-group col-md-2 text-center">
                          <span>Sampai</span>
                        </div>
                        <div class="form-group col-md-5">
                          <datepicker :bootstrap-styling="true" required="" placeholder="Tanggal akhir.." v-model="filter.end_date" :format="customFormatter"></datepicker>
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
                        <th>Notifikasi ID</th>
                        <th>Pesan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="notifications" v-for="notification in notifications.data">
                        <td>{{ notification.id }}</td>
                        <td>{{ notification.pesan }}</td>
                        <td>{{ notification.keterangan }}</td>
                        <td></td>
                      </tr>
                      <tr v-if="notifications">
                        <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                      </tr>
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
              filter: {
                start_date: '',
                end_date: ''
              },
              notifications: []
            }
        },

        methods: {
          customFormatter(date) {
                return moment(date).format('MM-YYYY');
          },
            
           fecthNotification(){
              axios.get('getPemberitahuan').then(response =>
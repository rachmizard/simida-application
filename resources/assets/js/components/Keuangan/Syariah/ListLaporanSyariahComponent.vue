<template>
    <div id="app">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Tanggal Pembayaran</td>
                    <td>NIS</td>
                    <td>Nama Santri</td>
                    <td>Kelas</td>
                    <td>Asrama</td>
                    <td>Status Pembayaran</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="santri in santris.data">
                    <td>{{ santri.id }}</td>
                    <td>{{ santri.bulan }}</td>
                    <td>{{ santri.nis }}</td>
                    <td>{{ santri.nama_santri }}</td>
                    <td>{{ santri.kelas }}</td>
                    <td>{{ santri.asrama }}</td>
                    <td>
                        <span v-if="santri.status_pembayaran == 'Sudah'" class="badge badge-success">{{ santri.status_pembayaran }}</span>
                        <span v-if="santri.status_pembayaran == 'Belum'" class="badge badge-dark">{{ santri.status_pembayaran }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        props: ['kelas', 'asrama', 'bulan'],
        data(){
            return {
                santris: []
            }
        },

        mounted(){
            this.fetchSantri();
            console.log(this.kelas);
        },

        methods: {
            fetchSantri(){
                axios.get('/keuangan/syariah/getSantriForReport', { params: { kelas_id: this.kelas, asrama_id: this.asrama, bulan: this.bulan } }).then(response => {
                    this.santris = response.data;
                })
            }
        }
    }
</script>
<template>	
	<div id="app">
			<div class="panel">
				<div class="panel-body container-fluid" style="background-color: #fafafa;">
					<div class="page-header">
					    <h1 class="page-title">Input Nilai</h1>
					    <ol class="breadcrumb">
					        <li class="breadcrumb-item"><a href="/">Home</a></li>
					        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendidikan</a></li>
					        <li class="breadcrumb-item"><a href="#">Nilai</a></li>
					        <li class="breadcrumb-item active">Input Nilai</li>
					    </ol>
					</div>
					<!--/.page-header-->
				    <div class="row row-lg">
				        <div class="col-md-12 col-sm-12" style="padding-right: 15px;">
				            <table class="table table-hover table-stripped" data-mobile-responsive="true">
				                <thead>
				                    <tr>
				                        <th data-field="id">Nis</th>
				                        <th data-field="kelas">Kelas</th>
				                        <th data-field="nama">Nama</th>
				                    </tr>
				                </thead>
				                <tbody>
				                    <tr>
				                        <td>{{ santris.nis }}</td>
				                        <td>{{ santris.kelas }}</td>
				                        <td>{{ santris.nama_santri }}</td>
				                    </tr>
				                </tbody>
				            </table>
				        </div>
				        <!--/.form-group =========================-->
				    </div><!--/.row-->
				</div><!--/.panel-body-->
			</div><!--/.panel -->

			<div class="panel">
				<div class="panel-body container-fluid" style="background-color: #fafafa;">
				    <div class="row row-lg">
				            <div class="col-md-12">
				                <h4 class="example-title">Input Nilai Pelajaran</h4>
				                <p>Mata Pelajaran di tampilkan berdasarkan tingkat {{ santris.tingkat }} </p>
				                <table class="table table-hover table-stripped">
				                    <tbody>
				                        <tr v-for="(i, ii) in coba_pelajarans" :key="ii">
				                            <td v-for="(j, jj) in i" :key="jj">
				                            	{{ j.nama_mata_pelajaran }}
				                                <input type="number" @keyup="calculateAverage()" class="form-control form-control-sm" v-bind:placeholder="j.jenis_nilai" v-model="response[ii][jj]">
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
				                <div class="tombolAksi" style="margin-top: 30px;text-align: center;">
				                    <button class="btn btn-danger">Kembali</button>
				                </div><!--/.tombolAksi-->
				            </div><!--/.row-->
				            {{ mata_pelajarans }}
				        </div>
				</div><!--/.panel-body-->
			</div><!--/.panel -->
	</div>
</template>
<script>
	export default {

		data(){
			return {
				id: this.$route.params.id,
				santris: {
					nama_santri: '',
					kelas: '',
					nis: '',
					tingkat: ''
				},
				// mata_pelajarans: [],
				coba_pelajarans: null,
				mata_pelajarans: [
				    [
				      {
				        nama_mata_pelajaran: "Tauhid Rancang",
				        jenis_nilai: "nilai_mingguan"
				      },
				      {
				        nama_mata_pelajaran: "Tauhid Rancang",
				        jenis_nilai: "nilai_uts"
				      },
				      {
				        nama_mata_pelajaran: "Tauhid Rancang",
				        jenis_nilai: "nilai_uas"
				      },
				      {
				        nama_mata_pelajaran: "Tauhid Rancang",
				        jenis_nilai: "rata_rata"
				      }
				    ],
				    [
				      {
				        nama_mata_pelajaran: "Fiqih Rancang",
				        jenis_nilai: "nilai_mingguan"
				      },
				      {
				        nama_mata_pelajaran: "Fiqih Rancang",
				        jenis_nilai: "nilai_uts"
				      },
				      {
				        nama_mata_pelajaran: "Fiqih Rancang",
				        jenis_nilai: "nilai_uas"
				      },
				      {
				        nama_mata_pelajaran: "Fiqih Rancang",
				        jenis_nilai: "rata_rata"
				      }
				    ]
				  ],
				nilai_nilai: [],
			    response: [
			      ['',''],
			      ['','']
			    ]
			}
		},

		mounted(){
			this.getSantri();
			// this.fetchMataPelajaran();
		},

		methods: {
			getSantri(){
				axios.get('/pendidikan/santri/'+ this.id +'/show').then(response => {
					this.santris.nama_santri = response.data.nama_santri;
					this.santris.kelas = response.data.kelas.nama_kelas;
					this.santris.nis = response.data.nis;
					this.santris.tingkat = response.data.tingkat.nama_tingkatan;
					this.fetchMataPelajaran(response.data.tingkat_id);
					console.log(this.tingkat_id);
				});
			},

			fetchMataPelajaran(id){
				axios.get('/pendidikan/matapelajaran/'+ id +'/tingkat').then(response => {
					// this.mata_pelajarans = response.data;
					console.log(this.mata_pelajarans);
				});
			},

			calculateAverage(id){
				console.log(id);
			}
		},
	}
</script>
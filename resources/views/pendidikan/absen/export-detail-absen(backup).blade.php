<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Hasil Absensi {{ Carbon\Carbon::createFromFormat('Y-m', $tahun.'-'.$bulan)->format('M Y') }} {{ $santri->nama_santri }} Periode {{ $periode->nama_periode }} Semester {{ $semester->tingkat_semester }}</title>
        <!-- Stylesheets -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min599c.css">
        <link rel="stylesheet" href="/assets/css/bootstrap-extend.min599c.css">
        <link rel="stylesheet" href="/assets/css/site.min599c.css">
        <link rel="stylesheet" href="/assets/css/tableDesign.css">
    </head>
    <body>
        <!-- Page -->
          <div class="page">
            <div class="page-header">
              <h1 class="page-title">Absensi</h1>
            </div>

            <div class="page-content">
              <!-- Panel -->
              <div class="panel">
                <div class="panel-body container-fluid">
                  <div class="row">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-3 offset-lg-6 text-right">
                      <h4>Data Santri</h4>
                      <p>
                        <a class="font-size-20" href="javascript:void(0)">{{ $santri->nis }}</a>
                      </p>
                      <span>Nama Santri: {{ $santri->nama_santri }}</span>
                      <br>
                      <span>Kelas: {{ $kelas->nama_kelas }}</span>
                      <br>
                      <span>Periode: {{ $periode->nama_periode }}</span>
                      <br>
                      <span>Semester: {{ $semester->tingkat_semester }}</span>
                      <br>
                      <span>Tahun & Bulan : {{ Carbon\Carbon::createFromFormat('Y-m', $tahun.'-'.$bulan)->format('M Y') }}</span>
                    </div>
                  </div>

                  <div class="page-invoice-table table-responsive">
                    <table class="table table-hover text-right">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Mata Pelajaran</th>
                          <th class="text-right">Kehadiran %</th>
                          <th class="text-right">Sakit %</th>
                          <th class="text-right">Izin %</th>
                          <th class="text-right">Alfa %</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            @foreach($real_value_mapel as $key => $data1)
                          <td class="text-center">
                            {{ $key+1 }}
                          </td>
                          <td class="text-left">
                            {{ $data1['mata_pelajaran'] }}
                          </td>
                          <td>
                            {{ round($data1['persentase']['hadir'], 2) }} %
                          </td>
                          <td>
                            {{ round($data1['persentase']['sakit'], 2) }} %
                          </td>
                          <td>
                            {{ round($data1['persentase']['izin'], 2) }} %
                          </td>
                          <td>
                            {{ round($data1['persentase']['alfa'], 2) }} %
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                  <div class="page-invoice-table table-responsive">
                    <table class="table table-hover text-right">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Kegiatan</th>
                          <th class="text-right">Kehadiran %</th>
                          <th class="text-right">Sakit %</th>
                          <th class="text-right">Izin %</th>
                          <th class="text-right">Alfa %</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            @foreach($real_value_kegiatan as $key2 => $data2)
                          <td class="text-center">
                            {{ $key2+1 }}
                          </td>
                          <td class="text-left">
                            {{ $data2['kegiatan'] }}
                          </td>
                          <td>
                            {{ round($data2['persentase']['hadir'], 2) }} %
                          </td>
                          <td>
                            {{ round($data2['persentase']['sakit'], 2) }} %
                          </td>
                          <td>
                            {{ round($data2['persentase']['izin'], 2) }} %
                          </td>
                          <td>
                            {{ round($data2['persentase']['alfa'], 2) }} %
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                  <div class="text-right">
                    <form method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-animate btn-animate-side btn-primary">
                          <span><i class="icon wb-shopping-cart" aria-hidden="true"></i> Export</span>
                        </button>
                    </form>
                  </div>
                </div>
              </div>
              <!-- End Panel -->
            </div>
          </div>
          <!-- End Page -->
    </body>
</html>

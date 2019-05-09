<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Hasil Absensi</title>
    </head>
    <body>
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
          <br>
          <h3>Absensi Mata Pelajaran</h3>
        <table border="1">
          <thead>
            <tr>
              <th>#</th>
              <th>Mata Pelajaran</th>
              <th>Kehadiran %</th>
              <th>Sakit %</th>
              <th>Izin %</th>
              <th>Alfa %</th>
            </tr>
          </thead>
          <tbody>

        @foreach($real_value_mapel as $key => $data1)
            <tr>
              <td>
                {{ $key+1 }}
              </td>
              <td>
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
            <br>
            <h3>Absensi Kegiatan</h3>
          <table border="1">
            <thead>
              <tr>
                <th>#</th>
                <th>Kegiatan</th>
                <th>Kehadiran %</th>
                <th>Sakit %</th>
                <th>Izin %</th>
                <th>Alfa %</th>
              </tr>
            </thead>
            <tbody>

          @foreach($real_value_kegiatan as $key2 => $data2)
              <tr>
                <td>
                  {{ $key2+1 }}
                </td>
                <td>
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
    </body>
</html>

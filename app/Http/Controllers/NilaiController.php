<?php

namespace App\Http\Controllers;
use App\Santri;
use App\Nilai;
use App\NilaiMingguan;
use App\Periode;
use App\Semester;
use App\Tingkat;
use App\Kelas;
use App\MataPelajaran;
use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\NilaiResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pendidikan.nilai.index');
    }

    public function indexNilaiMingguan(Request $request)
    {
        // master data untuk dropdown
        $periods = Periode::orderBy('nama_periode', 'ASC')->get();
        $grades = Tingkat::orderBy('nama_tingkatan', 'ASC')->get();
        $semesters = Semester::orderBy('tingkat_semester', 'ASC')->get();
        $classes = Kelas::orderBy('nama_kelas', 'ASC')->get();

        // deklarasi variable dengan data null

        $periode = null;
        $semester_id = null;
        $tingkat_id = null;
        $kelas_id = null;

        // Untuk mengecheck status santri udah ada nilai apa belum
        function checkStatus($id, $tingkat_id, $periode_id, $semester_id){

            $status = 'Belum'; // as default variable value
            $countMapelByTingkatId = MataPelajaran::whereTingkatId($id)->count();
            $checkIfExist = NilaiMingguan::where('periode_id', $periode_id)
                                ->where('semester_id', $semester_id)
                                ->where('santri_id', $id)
                                // ->where('kelas_id', $kelas_id)
                                ->count();

            if ($checkIfExist > $countMapelByTingkatId) {
                $status = 'Sudah';
            }

            return $status;
        }

        $tingkats = Tingkat::all();

        if ($request->periode) {

            $periode = Periode::findOrFail($request->periode);
            $semester_id = Semester::findOrFail($request->semester_id);
            $tingkat_id = Tingkat::findOrFail($request->tingkat_id);
            $kelas_id = Kelas::findOrFail($request->kelas_id);

            $listsantri = Santri::whereStatus('aktif')->whereKelasId($request->kelas_id)->get();
            $realresults = array();

            foreach ($listsantri as $key => $value) {

                $results = [
                    'id' => $value->id,
                    'no' => $key+1,
                    'nis' => $value->nis,
                    'nama_santri' => $value->nama_santri,
                    'kelas' => $value->kelas['nama_kelas'],
                    'status_nilai' => checkStatus($value->id, $value->tingkat_id, $request->periode, $request->semester_id)
                ];

                array_push($realresults, $results);
            }

        }

        // dd($realresults);

        return view('pendidikan.nilai.index-nilai-mingguan',
                    compact('tingkats', 'realresults', 'periode', 'semester_id', 'tingkat_id', 'kelas_id', 'periods', 'grades', 'semesters', 'classes'));
    }

    public function showClassByTingkat($id)
    {
        $kelas = Kelas::whereTingkatId($id)->get();
        $items = array();

        foreach ($kelas as $value) {
            $item['id'] = $value->id;
            $item['text'] = $value->nama_kelas;

            array_push($items, $item);
        }

        return response()->json($items);
    }

    public function getSantri(Request $request)
    {
        $santri = array();

        if ($request->all()) {

            $this->validate($request, [
                'kelas_id' => 'required',
                'tingkat_id' => 'required',
                'periode_id' => 'required',
                'semester_id' => 'required'
            ]);

            $requestAll = $request->all();

            $santri = NilaiResource::collection(Santri::whereKelasId($requestAll['kelas_id'])
                ->whereTingkatId($requestAll['tingkat_id'])
                ->get());
        }

        return response()->json($santri);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function viewInputNilai(Request $request, $id)
    {
        $method = $request->method();
        if ($method == 'POST') {
            $santri = Santri::findOrFail($id);

            $semester_id = $request->semester_id;

            $periode_id = $request->periode_id;

            $mata_pelajarans = MataPelajaran::with('tingkat')->whereTingkatId($santri->tingkat_id)->get();

            return view('pendidikan.nilai.input-nilai', compact('santri', 'mata_pelajarans', 'semester_id', 'periode_id'));
        }else{
            return redirect('pendidikan/nilai#/nilai/pilihsantri');
        }
    }

    public function viewInputNilaiMingguan(Request $request, $id)
    {
        $method = $request->method();
        if ($method == 'POST') {

            $santri = Santri::findOrFail($id);

            $semester_id = $request->semester_id;

            $periode_id = $request->periode;

            $bulan_ke = $request->bulan_ke;

            $minggu_ke = $request->minggu_ke;

            $mata_pelajarans = MataPelajaran::with('tingkat')->whereTingkatId($santri->tingkat_id)->get();

            // dd($mata_pelajarans);
            return view('pendidikan.nilai.input-nilai-mingguan', compact('santri', 'mata_pelajarans', 'semester_id', 'periode_id', 'bulan_ke',
'minggu_ke'));
        }else{
            return redirect()->route('pendidikan.nilai.indexNilaiMingguan')->withInput();
        }
    }

    public function inputBulanDanMinggu(Request $request, $id)
    {
        if ($request->method() == 'POST') {

            // $santri = $id; // bisa mengambil dari parameter;
            $santri = Santri::findOrFail($id); // bisa mengambil dari Eloquent;
            $semester_id = $request->semester_id;
            $periode_id = $request->periode;

            // dd($request->all());
            return view('pendidikan.nilai.input-bulan-dan-minggu', compact('santri', 'semester_id', 'periode_id'));
        }else{
            return redirect()->back()->withInput();
        }
    }

    public function editInputBulanDanMinggu(Request $request, $id)
    {
        if ($request->method() == 'POST') {

            // $santri = $id; // bisa mengambil dari parameter;
            $santri = Santri::findOrFail($id); // bisa mengambil dari Eloquent;
            $semester_id = $request->semester_id;
            $periode_id = $request->periode;
            $bulan_ke = $request->bulan_ke;
            $minggu_ke = $request->minggu_ke;

            // dd($request->all());
            return view('pendidikan.nilai.edit-bulan-dan-minggu', compact('santri', 'semester_id', 'periode_id', 'bulan_ke', 'minggu_ke'));
        }else{
            return redirect()->back()->withInput();
        }
    }

    public function editInputNilaiMingguan(Request $request, $id)
    {
        $method = $request->method();
        if ($method == 'POST') {

            $santri = Santri::findOrFail($id);

            $semester_id = $request->semester_id;

            $periode_id = $request->periode;

            $bulan_ke = $request->bulan_ke;

            $minggu_ke = $request->minggu_ke;

            $mata_pelajarans = NilaiMingguan::where('santri_id', $id)
                                ->where('periode_id', $periode_id)
                                ->where('semester_id', $semester_id)
                                ->where('bulan_ke', $bulan_ke)
                                ->where('minggu_ke', $minggu_ke)
                                ->get();

            // dd($mata_pelajarans);
            return view('pendidikan.nilai.edit-nilai-mingguan', compact('santri', 'mata_pelajarans', 'semester_id', 'periode_id', 'bulan_ke',
'minggu_ke'));
        }else{
            return redirect()->route('pendidikan.nilai.indexNilaiMingguan')->withInput();
        }
    }

    /**
     * Memulai memasukan Nilai ke database dengan source code dibawah ini.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */

    public function storeNilai(Request $request, $id)
    {
        // dd($request->all());
        $santri = Santri::findOrFail($id);

        $data = [];

        $rata_rata = [];

        $total_jenis_nilai = 3; // (nilai mingguan, nilai uts, nilai uas)

        $mapelByTingkat = MataPelajaran::whereTingkatId($santri->tingkat_id)->get();

        $total_bobot = $mapelByTingkat->sum('bobot');

        foreach ($request->mata_pelajaran_id as $key => $value) {

            $getBobot = MataPelajaran::find($value);

            // Menghitung rata-rata / 3 (nilai mingguan, nilai uts, nilai uas)
            $nilai = $request->nilai_mingguan[$key] + $request->nilai_uts[$key] + $request->nilai_uas[$key];

            $rata_rata = $nilai / $total_jenis_nilai; // total nilai / 3 jenis mata pelajaran

            $ip_ujian = $getBobot['bobot'] * $rata_rata;

            $data = array(
                'santri_id' => $id,
                'kelas_id' => $santri->kelas_id,
                'semester_id' => $request->semester_id, // hardcore
                'periode_id' => $request->periode_id,
                'mata_pelajaran_id' => $value,
                'nilai_mingguan' => $request->nilai_mingguan [$key],
                'nilai_uts' => $request->nilai_uts [$key],
                'nilai_uas' => $request->nilai_uas [$key],
                'rata_rata' => $rata_rata, // nanti tinggal kesiniin si variable;
                'ip_ujian' => $ip_ujian // index prestasi nilai ujian
            );

            Nilai::create($data);

            /* ini akan segera digunakan jika dibutuhkan
             $hitung_ip_asli = '';

             DB::table('index_prestasi')->insert([
                 'santri_id' => $id,
                 'mata_pelajaran_id' => $value,
                 'nilai_ip' =>
             ]);
            */

            // print_r($data);
        }
        // return response($data);
        // var_dump($data);
        $message = 'Nilai santri'. $santri->nama_santri .' berhasil dimasukan ke database!';
        // return redirect('pendidikan/nilai#/nilai/pilihsantri')->with('message', );
        return redirect()->back()->with('message', $message);
    }

    public function storeNilaiMingguan(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);

        $data = [];

        $rata_rata = [];

        // dd($request->all());
        foreach ($request->mata_pelajaran_id as $key => $value) {
            $getBobot = MataPelajaran::find($value);

            // Memasukan nilai yg ada
            // Ngechek apa bila nilai sudah ada apa belum, kalo belum di akan masuk, kalo udh engga bakal;
            $checkIfExistGrade = NilaiMingguan::where('santri_id', $id)
                                                ->where('periode_id', $request->periode_id)
                                                ->where('semester_id', $request->semester_id)
                                                ->where('bulan_ke', $request->bulan_ke)
                                                ->where('minggu_ke', $request->minggu_ke)
                                                ->where('mata_pelajaran_id', $value)
                                                ->first();
            if (count($checkIfExistGrade) > 0) {
                // pake yang dulu
                $data = array(
                    'santri_id' => $id,
                    'periode_id' => $request->periode_id,
                    'kelas_id' => $santri->kelas_id,
                    'semester_id' => $request->semester_id, // hardcore;
                    'bulan_ke' => $request->bulan_ke, // getting from request body;
                    'minggu_ke' => $request->minggu_ke, // getting from request body;
                    'mata_pelajaran_id' => $value,
                    // 'jumlah_nilai' => $request->jumlah_nilai[$key],
                );

                NilaiMingguan::find($checkIfExistGrade['id'])
                                ->update($data);

                return redirect()->route('pendidikan.nilai.detailNilaiMingguan', ['id' => $id, 'periode_id' => $request->periode_id, 'semester_id' => $request->semester_id, 'bulan_ke' => $request->bulan_ke, 'minggu_ke' => $request->minggu_ke])
                ->with('messageError',
                'Nilai mingguan pada Periode '. Periode::find($request->periode_id)->nama_periode .' di Semester '. Semester::find($request->semester_id)->tingkat_semester .' Bulan-Ke '. $request->bulan_ke .' Minggu-Ke '. $request->minggu_ke .' sudah tersedia, silahkan melakukan edit jika ada nilai yg masih kosong atau belum di masukan.
                ');

            }else{
                // buat baru
                $data = array(
                    'santri_id' => $id,
                    'periode_id' => $request->periode_id,
                    'kelas_id' => $santri->kelas_id,
                    'semester_id' => $request->semester_id, // hardcore;
                    'bulan_ke' => $request->bulan_ke, // getting from request body;
                    'minggu_ke' => $request->minggu_ke, // getting from request body;
                    'mata_pelajaran_id' => $value,
                    'jumlah_nilai' => $request->jumlah_nilai[$key],
                );

                NilaiMingguan::create($data);

            }

        }

        return redirect()->route('pendidikan.nilai.detailNilaiMingguan', ['id' => $id, 'periode_id' => $request->periode_id, 'semester_id' => $request->semester_id, 'bulan_ke' => $request->bulan_ke, 'minggu_ke' => $request->minggu_ke]);
        // return $this->detailNilaiMingguan($id, $request->periode_id, $request->semester_id, $request->bulan_ke, $request->minggu_ke);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function viewEditNilai(Request $request)
    {
        $santri = Santri::find($request->santri_id);

        $semester_id = $request->semester_id;

        $periode_id = $request->periode_id;

        $mata_pelajarans = Nilai::where('periode_id', $request->periode_id)
                            ->where('semester_id', $request->semester_id)
                            ->where('santri_id', $request->santri_id)
                            ->get();

        // dd($mata_pelajarans);
        return view('pendidikan.nilai.edit-nilai', compact('santri', 'mata_pelajarans' ,'semester_id', 'periode_id'));
    }

    public function detailNilaiMingguan($id, $periode_id, $semester_id, $bulan_ke, $minggu_ke)
    {
        $santri = Santri::find($id);

        $mata_pelajarans = NilaiMingguan::where('santri_id', $id)
                            ->where('periode_id', $periode_id)
                            ->where('semester_id', $semester_id)
                            ->where('bulan_ke', $bulan_ke)
                            ->where('minggu_ke', $minggu_ke)
                            ->get();

        $total_mata_pelajaran_by_query = NilaiMingguan::where('santri_id', $id)
                            ->where('periode_id', $periode_id)
                            ->where('semester_id', $semester_id)
                            // ->where('kelas_id', $kelas_id)
                            ->where('bulan_ke', $bulan_ke)
                            ->where('minggu_ke', $minggu_ke)
                            ->count();

        $sum_nilai_per_mapel = NilaiMingguan::where('santri_id', $id)
                            ->where('periode_id', $periode_id)
                            ->where('semester_id', $semester_id)
                            // ->where('kelas_id', $kelas_id)
                            ->where('bulan_ke', $bulan_ke)
                            ->where('minggu_ke', $minggu_ke)
                            ->sum('jumlah_nilai');

        $hasil_rata_rata = $sum_nilai_per_mapel / $total_mata_pelajaran_by_query;

        return view('pendidikan.nilai.detail-nilai-mingguan', compact('santri', 'periode_id', 'semester_id', 'bulan_ke', 'minggu_ke', 'mata_pelajarans', 'hasil_rata_rata'));
    }

    public function detailNilaiMingguanOtherMethod(Request $request, $id)
    {
        $santri = Santri::find($id);
        // Variable
        $periode_id = $request->periode_id;
        $semester_id = $request->semester_id;
        $kelas_id = $request->kelas_id; // jika digunakan bisa di masukan kedalam query
        $bulan_ke = $request->bulan_ke;
        $minggu_ke = $request->minggu_ke;


        $mata_pelajarans = NilaiMingguan::where('santri_id', $id)
                            ->where('periode_id', $request->periode_id)
                            ->where('semester_id', $request->semester_id)
                            // ->where('kelas_id', $request->kelas_id)
                            ->where('bulan_ke', $request->bulan_ke)
                            ->where('minggu_ke', $request->minggu_ke)
                            ->get();

        $total_mata_pelajaran_by_query = NilaiMingguan::where('santri_id', $id)
                            ->where('periode_id', $request->periode_id)
                            ->where('semester_id', $request->semester_id)
                            // ->where('kelas_id', $request->kelas_id)
                            ->where('bulan_ke', $request->bulan_ke)
                            ->where('minggu_ke', $request->minggu_ke)
                            ->count();

        $sum_nilai_per_mapel = NilaiMingguan::where('santri_id', $id)
                            ->where('periode_id', $request->periode_id)
                            ->where('semester_id', $request->semester_id)
                            // ->where('kelas_id', $request->kelas_id)
                            ->where('bulan_ke', $request->bulan_ke)
                            ->where('minggu_ke', $request->minggu_ke)
                            ->sum('jumlah_nilai');

        $cari_nilai_tertinggi = NilaiMingguan::where('santri_id', $id)
                            ->where('periode_id', $request->periode_id)
                            ->where('semester_id', $request->semester_id)
                            // ->where('kelas_id', $request->kelas_id)
                            ->where('bulan_ke', $request->bulan_ke)
                            ->where('minggu_ke', $request->minggu_ke)
                            ->whereBetween('jumlah_nilai', [9, 6])
                            ->first();

        $cari_nilai_terendah = NilaiMingguan::where('santri_id', $id)
                            ->where('periode_id', $request->periode_id)
                            ->where('semester_id', $request->semester_id)
                            // ->where('kelas_id', $request->kelas_id)
                            ->where('bulan_ke', $request->bulan_ke)
                            ->where('minggu_ke', $request->minggu_ke)
                            ->whereBetween('jumlah_nilai', [1, 6])
                            ->get();

                            // dd($cari_nilai_terendah);

        $hasil_rata_rata = $sum_nilai_per_mapel / $total_mata_pelajaran_by_query;

        // dd($sum_nilai_per_mapel);

            return view('pendidikan.nilai.detail-nilai-mingguan', compact('santri', 'periode_id', 'semester_id', 'kelas_id', 'bulan_ke', 'minggu_ke', 'mata_pelajarans', 'hasil_rata_rata'));
    }

    public function detailInputBulanDanMinggu($id, $periode_id, $semester_id, $kelas_id)
    {
        return view('pendidikan.nilai.detail-bulan-dan-minggu', compact('id', 'periode_id', 'semester_id', 'kelas_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function updateNilai(Request $request, $id)
    {
        $this->validate($request, [
            'nilai_mingguan.*' => 'required|max:10',
            'nilai_uts.*' => 'required|max:10',
            'nilai_uas.*' => 'required|max:10',
        ]);

        // dd($request->all());
        $santri = Santri::findOrFail($id);

        $data = [];

        $total_jenis_nilai = 3;

        $rata_rata = [];

        $getter = Nilai::where('periode_id', $request->periode_id)
                        ->where('semester_id', $request->semester_id)
                        ->where('santri_id', $id)
                        ->get();

        foreach ($request->mata_pelajaran_id as $key => $value) {

            $getBobot = MataPelajaran::find($value);

            $nilai = $request->nilai_mingguan[$key] + $request->nilai_uts[$key] + $request->nilai_uas[$key];

            $rata_rata = $nilai / $total_jenis_nilai;

            $ip_ujian = $getBobot['bobot'] * $rata_rata;

            $data[$key] = array(
                'santri_id' => $id,
                'kelas_id' => $santri->kelas_id,
                'semester_id' => $request->semester_id, // hardcore
                'periode_id' => $request->periode_id,
                'mata_pelajaran_id' => $value,
                'nilai_mingguan' => $request->nilai_mingguan [$key],
                'nilai_uts' => $request->nilai_uts [$key],
                'nilai_uas' => $request->nilai_uas [$key],
                'rata_rata' => $rata_rata,
                'ip_ujian' => $ip_ujian
            );
        }

        foreach ($getter as $index => $nilaiValue) {
            $updatePerItem = Nilai::find($nilaiValue->id);
            $updatePerItem->update($data[$index]);
        }
        return redirect()->back();
    }

    public function updateNilaiMingguan(Request $request, $id)
    {

        $santri = Santri::findOrFail($id);

        $data = [];

        $getter = NilaiMingguan::where('santri_id', $id)
                        ->where('periode_id', $request->periode_id)
                        ->where('semester_id', $request->semester_id)
                        ->where('bulan_ke', $request->bulan_ke)
                        ->where('minggu_ke', $request->minggu_ke)
                        ->get();

        foreach ($request->mata_pelajaran_id as $key => $value) {

            $data[$key] = array(
                'santri_id' => $id,
                'periode_id' => $request->periode_id,
                'kelas_id' => $santri->kelas_id,
                'semester_id' => $request->semester_id, // hardcore;
                'bulan_ke' => $request->bulan_ke, // getting from request body;
                'minggu_ke' => $request->minggu_ke, // getting from request body;
                'mata_pelajaran_id' => $value,
                'jumlah_nilai' => $request->jumlah_nilai[$key],
            );
        }

        foreach ($getter as $index => $nilaiValue) {
            $updatePerItem = NilaiMingguan::find($nilaiValue->id);
            $updatePerItem->update($data[$index]);
        }

        return redirect()->route('pendidikan.nilai.detailNilaiMingguan', ['id' => $id, 'periode_id' => $request->periode_id, 'semester_id' => $request->semester_id, 'bulan_ke' => $request->bulan_ke, 'minggu_ke' => $request->minggu_ke])->with('messageSuccess', 'Nilai berhasil di update!');

    }

    public function viewReport(Request $request)
    {
        $semesters = Semester::orderBy('tingkat_semester', 'DESC')->get();

        $periodes = Periode::orderBy('nama_periode', 'ASC')->get();

        $tingkats = Tingkat::all();

        $kelass = Kelas::all();

        // we need define these variable :
        $semester = '';

        $periode = '';

        $tingkat = '';

        $kelas = '';

        if ($request->method()=='POST') {

            $semester = $request->semester_id;

            $periode = $request->periode_id;

            $tingkat = $request->tingkat_id;

            $kelas = $request->kelas_id;

            return $this->reportResults($semester, $periode, $tingkat, $kelas);

        }else{
            return view('pendidikan.nilai.report-nilai', compact('semesters', 'periodes', 'tingkats', 'kelass', 'semester', 'periode', 'tingkat', 'kelas'));
        }
    }


    public function reportResults($semesterId, $periodeId, $tingkatId, $kelasId)
    {

        $semesters = Semester::orderBy('tingkat_semester', 'DESC')->get();

        $periodes = Periode::orderBy('nama_periode', 'ASC')->get();

        $tingkats = Tingkat::all();

        $kelass = Kelas::all();

        $mapelByTingkat = MataPelajaran::whereTingkatId($tingkatId)->get();

        $total_bobot = MataPelajaran::whereTingkatId($tingkatId)->sum('bobot');

        // dd($total_bobot);

        // recent search will be saved

        $semester = $semesterId;

        $periode = $periodeId;

        $tingkat = $tingkatId;

        $kelas = $kelasId;

        $santri = Santri::orderBy('nama_santri', 'ASC')->whereTingkatId($tingkatId)
                        ->whereKelasId($kelasId)
                        ->get();


        return view('pendidikan.nilai.report-nilai', compact('santri', 'semesters', 'periodes', 'tingkats', 'kelass', 'mapelByTingkat', 'semester', 'periode', 'tingkat', 'kelas', 'total_bobot'));
    }

    public function exportNilai(Request $request)
    {
        $req = $request->all();

        $className = Kelas::find($req['kelas_id']);

        $periodName = Periode::find($req['periode_id']);

        $name_of_file = 'nilai_'. $className->nama_kelas .'_'. $periodName->nama_periode .'.xlsx';

        return Excel::download(new NilaiExport($req['semester_id'], $req['periode_id'], $req['tingkat_id'], $req['kelas_id']), $name_of_file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }
}

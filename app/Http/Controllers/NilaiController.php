<?php

namespace App\Http\Controllers;
use App\Santri;
use App\Nilai;
use App\Periode;
use App\Semester;
use App\Tingkat;
use App\Kelas;
use App\MataPelajaran;
use App\Http\Resources\NilaiResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
                'rata_rata' => $rata_rata, // nanti tinggal kesiniin si variable ,
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
        return redirect('pendidikan/nilai#/nilai/pilihsantri');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function updateNilai(Request $request, $id)
    {
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
        // return response($data);
        // var_dump($data);
        return redirect()->back();
    }

    public function viewReport(Request $request)
    {
        $semesters = Semester::orderBy('tingkat_semester', 'DESC')->get();

        $periodes = Periode::orderBy('nama_periode', 'ASC')->get();

        $tingkats = Tingkat::all();

        $kelass = Kelas::all();

        // we need define this variable
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

    public function exportGrade(Request $request, $id)
    {
        # code...
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

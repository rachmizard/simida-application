<?php

namespace App\Http\Controllers;

use App\Absen;
use App\Santri;
use App\Asrama;
use App\Kelas;
use App\Kegiatan;
use App\MataPelajaran;
use App\Periode;
use App\Tingkat;
use App\Semester;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Resources\AbsenSantriResource;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // deklarasi variable dengan data null
        $periode = null;
        $semester_id = null;
        $tingkat_id = null;
        $kelas_id = null;

        // master data untuk dropdown
        $periods = Periode::orderBy('nama_periode', 'ASC')->get();
        $grades = Tingkat::orderBy('nama_tingkatan', 'ASC')->get();
        $semesters = Semester::orderBy('tingkat_semester', 'ASC')->get();
        $classes = Kelas::orderBy('nama_kelas', 'ASC')->get();

        // hasil array di kosongkan dahulu untuk mendeklarasi wadah
        $result = array();
        $realresults = array();

        if ($request->periode) {

            $periode_a = $request->periode;
            $semester_b = $request->semester_id;
            $kelas_c = $request->kelas_id;
            $tingkat_d = $request->tingkat_id;

            $students = Santri::orderBy('nama_santri', 'ASC')
                            ->whereKelasId($request->kelas_id)
                            ->whereStatus('aktif')
                            ->get();
            $semester = Semester::findOrFail($request->semester_id);

            foreach ($students as $key => $student) {
                $result = [
                    'id' => $student->id,
                    'nama_santri' => $student->nama_santri,
                    'nis' => $student->nis,
                    'kelas' => $student->kelas['nama_kelas'],
                    'semester' => $semester->tingkat_semester,
                    'tgl_masuk' => Carbon::parse($student->tgl_masuk)->format('Y')
                ];

                array_push($realresults, $result);
            }

            // dd($realresults);
        }

        return view('pendidikan.absen.absen', compact('periods', 'grades', 'semesters', 'classes', 'periode_a', 'semester_b', 'kelas_c', 'tingkat_d', 'periode', 'semester_id', 'tingkat_id', 'kelas_id', 'realresults'));
    }

    public function tambahAbsenLaluPilihTanggalAbsen(Request $request, $id, $periode_id, $semester_id, $kelas_id, $tingkat_id)
    {
        $santri = Santri::findOrFail($id);
        return view('pendidikan.absen.pilih-tanggal-tambah-absen', compact('santri', 'id', 'periode_id', 'semester_id', 'kelas_id', 'tingkat_id'));
    }

    public function editAbsenLaluPilihTanggalAbsen(Request $request, $id, $periode_id, $semester_id, $kelas_id, $tingkat_id)
    {
        $santri = Santri::findOrFail($id);
        $periods = Periode::orderBy('nama_periode', 'ASC')->get();
        return view('pendidikan.absen.pilih-tanggal-edit-absen', compact('santri', 'id', 'periode_id', 'semester_id', 'kelas_id', 'tingkat_id', 'periods'));
    }

    public function listHariByFilter(Request $request, $id)
    {
        $periode = Periode::findOrFail($request->periode);
        $semester = Semester::findOrFail($request->semester_id);
        $santri = Santri::findOrFail($id);
        $dateRangePeriod = CarbonPeriod::create($request->bulan_awal, $request->bulan_akhir);

        $months = [];

        $realmonths = [];

        function checkIfPresenceDoneOrNot($santri, $tingkat, $periode, $semester, $tgl_absen){
            $checkMapel = Absen::where('santri_id', $santri)
                                ->where('periode_id', $periode)
                                ->where('semester_id', $semester)
                                ->where('type', 'mapel')
                                ->where('keterangan', '!=', null)
                                ->whereDate('tgl_absen', $tgl_absen)
                                ->count();

            $checkKegiatan = Absen::where('santri_id', $santri)
                                ->where('periode_id', $periode)
                                ->where('semester_id', $semester)
                                ->where('type', 'kegiatan')
                                ->where('keterangan', '!=', null)
                                ->whereDate('tgl_absen', $tgl_absen)
                                ->count();

            $totalMapel = MataPelajaran::whereTingkatId($tingkat)
                                        ->count();


            $totalKegiatan = Kegiatan::count();

            $percentageMapel = $checkMapel / $totalMapel * 100 . '%';

            $percentageKegiatan = $checkKegiatan / $totalKegiatan * 100 . '%';

            return array(
                'mata_pelajaran_percentage' => $percentageMapel,
                'kegiatan_percentage' => $percentageKegiatan
            );

        }

        foreach ($dateRangePeriod as $key => $value) {

            $months = [
                    'tgl' => $value->format('d M Y'),
                    'tgl_original' => $value->format('Y-m-d'),
                    'status_absen' => checkIfPresenceDoneOrNot($santri->id, $santri->tingkat_id, $periode->id, $semester->id, $value->format('Y-m-d'))
            ];

            array_push($realmonths, $months);
        }

        // dd($realmonths);
        // return response($realmonths);
        return view('pendidikan.absen.list-hari-by-filter', compact('periode', 'semester', 'santri', 'realmonths'));
    }

    public function viewInputAbsen(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);
        $periode = Periode::findOrFail($request->periode);
        $semester = Semester::findOrFail($request->semester_id);
        $tgl_absen = $request->tgl_absen;

        $mata_pelajarans = MataPelajaran::whereTingkatId($santri->tingkat_id)->get();

        $checkifMapelExistOrNot = Absen::where('santri_id', $santri->id)
                                    ->where('periode_id', $request->periode)
                                    ->where('semester_id', $request->semester_id)
                                    ->whereType('mapel')
                                    ->whereDate('tgl_absen', $request->tgl_absen);

        $checkifKegiatanExistOrNot = Absen::where('santri_id', $santri->id)
                                    ->where('periode_id', $request->periode)
                                    ->where('semester_id', $request->semester_id)
                                    ->whereType('kegiatan')
                                    ->whereDate('tgl_absen', $request->tgl_absen);

        $kegiatans = Kegiatan::all();

        // dd($checkifKegiatanExistOrNot->get());
        return view('pendidikan.absen.view-input-absen', compact('santri', 'periode', 'semester', 'tgl_absen', 'mata_pelajarans', 'kegiatans', 'checkifMapelExistOrNot', 'checkifKegiatanExistOrNot'));
    }

    public function viewEditAbsen(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);
        $periode = Periode::findOrFail($request->periode);
        $semester = Semester::findOrFail($request->semester_id);
        $tgl_absen = $request->tgl_absen;

        $mata_pelajarans = MataPelajaran::whereTingkatId($santri->tingkat_id)->get();

        $checkifMapelExistOrNot = Absen::where('santri_id', $santri->id)
                                    ->where('periode_id', $request->periode)
                                    ->where('semester_id', $request->semester_id)
                                    ->whereType('mapel')
                                    ->whereDate('tgl_absen', $request->tgl_absen);

        $checkifKegiatanExistOrNot = Absen::where('santri_id', $santri->id)
                                    ->where('periode_id', $request->periode)
                                    ->where('semester_id', $request->semester_id)
                                    ->whereType('kegiatan')
                                    ->whereDate('tgl_absen', $request->tgl_absen);

        $kegiatans = Kegiatan::all();

        // dd($checkifKegiatanExistOrNot->get());
        return view('pendidikan.absen.view-edit-absen', compact('santri', 'periode', 'semester', 'tgl_absen', 'mata_pelajarans', 'kegiatans', 'checkifMapelExistOrNot', 'checkifKegiatanExistOrNot'));
    }

    public function storeInputAbsenMapel(Request $request, $id)
    {
        $data = array();

        $realdata = array();

        $santri = Santri::findOrFail($id);

        foreach ($request->mata_pelajaran_id as $key => $value) {

            $data = array(
                    'santri_id' => $santri->id,
                    'periode_id' => $request->periode_id,
                    'semester_id' => $request->semester_id,
                    'kelas_id' => $request->kelas_id,
                    'mata_pelajaran_id' => $value,
                    'keterangan' => $request->keterangan[$key],
                    'type' => $request->type,
                    'tgl_absen' => $request->tgl_absen
            );
            Absen::create($data);
            // array_push($realdata, $data);
        }

        if (count($data) > 0) {
            $messageSuccess = 'Absen mata-pelajaran berhasil di tambahkan!';
        }else{
            $messageSuccess = 'Tidak dapat meng-update data!';
        }

        return redirect()->back()->with('messageSuccess', $messageSuccess);
    }

    public function storeInputAbsenKegiatan(Request $request, $id)
    {
        $data = array();

        $realdata = array();

        $santri = Santri::findOrFail($id);

        foreach ($request->kegiatan_id as $key => $value) {

            $data = array(
                    'santri_id' => $santri->id,
                    'periode_id' => $request->periode_id,
                    'semester_id' => $request->semester_id,
                    'kelas_id' => $request->kelas_id,
                    'kegiatan_id' => $value,
                    'keterangan' => $request->keterangan[$key],
                    'type' => $request->type,
                    'tgl_absen' => $request->tgl_absen
            );
            Absen::create($data);
            // array_push($realdata, $data);
        }

        if (count($data) > 0) {
            $messageSuccess = 'Absen kegiatan berhasil di tambahkan!';
        }else{
            $messageSuccess = 'Tidak dapat meng-update data!';
        }

        return redirect()->back()->with('messageSuccess', $messageSuccess);
    }


    public function updateInputAbsenMapel(Request $request, $id)
    {
        $data = array();

        $realdata = array();

        $santri = Santri::findOrFail($id);

        $getOldMapel = Absen::where('santri_id', $santri->id)
                                    ->where('periode_id', $request->periode_id)
                                    ->where('semester_id', $request->semester_id)
                                    ->whereType('mapel')
                                    ->whereDate('tgl_absen', $request->tgl_absen)
                                    ->get();

        foreach ($request->mata_pelajaran_id as $key => $value) {

            $data[$key] = array(
                    'santri_id' => $santri->id,
                    'periode_id' => $request->periode_id,
                    'semester_id' => $request->semester_id,
                    'kelas_id' => $request->kelas_id,
                    'mata_pelajaran_id' => $value,
                    'keterangan' => $request->keterangan[$key],
                    'type' => $request->type,
                    'tgl_absen' => $request->tgl_absen
            );

        }

        foreach ($getOldMapel as $index => $toValue) {
            $update = Absen::find($toValue->id);
            $update->update($data[$index]);
        }

        if (count($getOldMapel) > 0) {
            $messageSuccess = 'Absen mata-pelajaran berhasil di update!';
        }else{
            $messageSuccess = 'Tidak dapat meng-update data!';
        }

        return redirect()->back()->with('messageSuccess', $messageSuccess);
    }


    public function updateInputAbsenKegiatan(Request $request, $id)
    {
        $data = [];

        $realdata = array();

        $santri = Santri::findOrFail($id);

        $getOldKegiatan = Absen::where('santri_id', $santri->id)
                                    ->where('periode_id', $request->periode_id)
                                    ->where('semester_id', $request->semester_id)
                                    ->whereType('kegiatan')
                                    ->whereDate('tgl_absen', $request->tgl_absen)
                                    ->get();

        foreach ($request->kegiatan_id as $key => $value) {

            $data[$key] = array(
                    'santri_id' => $santri->id,
                    'periode_id' => $request->periode_id,
                    'semester_id' => $request->semester_id,
                    'kelas_id' => $request->kelas_id,
                    'kegiatan_id' => $value,
                    'keterangan' => $request->keterangan[$key],
                    'type' => $request->type,
                    'tgl_absen' => $request->tgl_absen
            );

        }

        foreach ($getOldKegiatan as $uyq => $toValue) {
            $update = Absen::find($toValue->id);
            $update->update($data[$uyq]);
        }

        if (count($getOldKegiatan) > 0) {
            $messageSuccess = 'Absensi kegiatan berhasil di update!';
        }else{
            $messageSuccess = 'Tidak dapat meng-update data!';
        }

        return redirect()->back()->with('messageSuccess', $messageSuccess);
    }

    public function deleteBulkAbsen(Request $request, $id)
    {
        $bulk_delete = Absen::where('santri_id', $id)
                ->where('periode_id', $request->periode)
                ->where('semester_id', $request->semester_id)
                ->whereIn('type', ['mapel', 'kegiatan'])
                ->whereDate('tgl_absen', $request->tgl_absen)
                ->delete();

        if (count($bulk_delete) > 0) {
            $messageSuccess = 'Berhasil di hapus!';
        }else{
            $messageSuccess = 'Data tidak ditemukan';
        }

        return redirect()->back()->with('messageSuccess', $messageSuccess);
    }



    ////////////////////////////////////////////////////////////////////////////////////////////

    public function getSantriDataTables(Request $request)
    {
        return AbsenSantriResource::collection(Santri::orderBy('nama_santri', 'ASC')->with([
                                'asrama.ngaran',
                                'kobong',
                                'tingkat',
                                'kelas',
                                'dewan'
                                ])->whereAsramaId($request->asrama_id)->whereStatus('aktif')->select('santri.*')->get());
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkDuplicatePresence = Absen::whereSantriId($request->santri_id)->whereKegiatanId($request->kegiatan_id)->whereDate('created_at', Carbon::parse($request->created_at)->format('Y-m-d'))->count();
        if ($checkDuplicatePresence > 0) {
            $data['message'] = 'Santri '. \App\Santri::find($request->santri_id)->nama_santri. ' sudah melakukan absen di kegiatan ini!';
        }else{
            $absen = new Absen();
            $absen->santri_id = $request->santri_id;
            $absen->kegiatan_id = $request->kegiatan_id;
            $absen->keterangan = $request->keterangan;
            $absen->created_at = Carbon::parse($request->created_at)->format('Y-m-d');
            $absen->updated_at = Carbon::parse($request->created_at)->format('Y-m-d');
            $absen->save();
            $data['message'] = 'Berhasil di absen!';
        }
        return response()->json(['response' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absen = Absen::find($id)->delete();
        return response()->json(['response' => 'success']);
    }

    public function santri(Request $request)
    {
        $santri = array();
        if ($request->kelas_id) {
            $santri = Santri::whereKelasId($request->kelas_id)->whereStatus('aktif')->get();
        }
        if($request->asrama_id)
        {
            $santri = Santri::whereAsramaId($request->asrama_id)->whereStatus('aktif')->get();
        }

        return response()->json(['data' => $santri]);
    }

    public function listKegiatan()
    {
        $listKegiatan = Kegiatan::orderBy('mulai_kegiatan', 'ASC')->get();
        return response()->json(['data' => $listKegiatan]);
    }

    public function report()
    {

    }

    public function reportView(Request $request)
    {
        $asramas = Asrama::all();
        $kelass = Kelas::all();
        $listSantris = array();
        $listKegiatans = Kegiatan::all();
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        // if ($request->kelas_id) {
        //     $listSantris = Santri::whereKelasId($request->kelas_id)->get();
        // }else if($request->asrama_id){
        //     $listSantris = Santri::whereAsramaId($request->asrama_id)->get();
        // }
            $listSantris = Santri::whereAsramaId($request->asrama_id)->orWhere('kelas_id', $request->kelas_id)->whereStatus('aktif')->get();


        return view('pendidikan.absen.report', compact('asramas', 'kelass', 'listSantris', 'listKegiatans', 'start_date', 'end_date'));
    }
}

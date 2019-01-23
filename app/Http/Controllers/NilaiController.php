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

    public function viewInputNilai($id)
    {
        $santri = Santri::findOrFail($id);

        $mata_pelajarans = MataPelajaran::with('tingkat')->whereTingkatId($santri->tingkat_id)->get();

        return view('pendidikan.nilai.input-nilai', compact('santri', 'mata_pelajarans'));
    }

    public function storeNilai(Request $request, $id)
    {
        // dd($request->all());
        $santri = Santri::findOrFail($id);
        $data = [];
        foreach ($request->mata_pelajaran_id as $key => $value) {
            $data = array(
                'santri_id' => $id,
                'kelas_id' => $santri->kelas_id,
                'semester_id' => 1, // hardcore
                'periode_id' => 1,
                'mata_pelajaran_id' => $value,
                'nilai_mingguan' => $request->nilai_mingguan [$key],
                'nilai_uts' => $request->nilai_uts [$key],
                'nilai_uas' => $request->nilai_uas [$key],
                'rata_rata' => $request->rata_rata [$key]
            );
            Nilai::create($data);
        }
        // return response($data);
        // var_dump($data);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function viewEditNilai(Request $request)
    {
        $santri = Santri::findOrFail($request->santri_id);
        $mata_pelajarans = Nilai::where('santri_id', $request->santri_id)
                            ->where('periode_id', $request->periode_id)
                            ->orWhere('semester_id', $request->semester_id)
                            ->get();
        return view('pendidikan.nilai.edit-nilai', compact('santri', 'mata_pelajarans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
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

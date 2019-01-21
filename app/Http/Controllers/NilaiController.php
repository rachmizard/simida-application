<?php

namespace App\Http\Controllers;
use App\Santri;
use App\Nilai;
use App\Periode;
use App\Semester;
use App\Tingkat;
use App\Kelas;
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
    public function edit(Nilai $nilai)
    {
        //
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

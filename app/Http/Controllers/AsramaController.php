<?php

namespace App\Http\Controllers;

use App\Asrama;
use App\DataNamaAsrama;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\AsramaResource;

class AsramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sekretariat.asrama.asrama');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sekretariat.asrama.tambah');
    }

    public function getAsramaKategori(Request $request, $kategori): JsonResponse
    {
        $asrama = AsramaResource::collection(DataNamaAsrama::whereKategori($kategori)->get());
        return response()->json(['data' => $asrama]);
    }

    public function getAsramaAllKategori()
    {
        $asrama = AsramaResource::collection(DataNamaAsrama::orderBy('kategori', 'ASC')->get());
        return response()->json(['data' => $asrama]);
    }

    public function getAsramaPutra()
    {
        $asrama = AsramaResource::collection(DataNamaAsrama::orderBy('kategori', 'ASC')->whereKategori('Putra')->get());
        return response()->json(['data' => $asrama]);
    }

    public function getAsramaPutri()
    {
        $asrama = AsramaResource::collection(DataNamaAsrama::orderBy('kategori', 'ASC')->whereKategori('Putri')->get());
        return response()->json(['data' => $asrama]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeNamaAsrama(Request $request)
    {
        $this->validate($request, [
            'nama_asrama_baru' => 'required'
        ]);

        $namaAsrama = new DataNamaAsrama();
        $namaAsrama->nama_asrama = request('nama_asrama_baru');
        $namaAsrama->kategori = request('kategori');
        $namaAsrama->save();
        $data['messageError'] = false;
        $data['message'] = 'Berhasil menambahkan Asrama!';
        $data['type'] = 'success';

        return response()->json(['response' => $data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori_asrama' => 'required', 'nama_asrama' => 'required', 'roisam_asrama' => 'required'
        ]);

        $validate = Asrama::whereNamaAsrama(request('nama_asrama'))->whereKategoriAsrama(request('kategori_asrama'))->count();
        if ($validate > 1) {
            $data['messageError'] = 'Asrama sudah tersedia!';
            $data['message'] = false;
            $data['type'] = 'error';
        }else{
            $asrama = new Asrama();
            $asrama->kategori_asrama = request('kategori_asrama');
            $asrama->nama_asrama = request('nama_asrama');
            $asrama->roisam_asrama = request('roisam_asrama');
            $asrama->save();
            $data['messageError'] = false;
            $data['message'] = 'Berhasil menambahkan Asrama!';
            $data['type'] = 'success';
        }
        return response()->json(['response' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asrama  $asrama
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asrama = Asrama::whereId($id)->get();
        return response()->json(['data' => $asrama]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asrama  $asrama
     * @return \Illuminate\Http\Response
     */
    public function edit(Asrama $asrama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asrama  $asrama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $asrama = Asrama::find($id)->update($request->all());
            $data['messageError'] = false;
            $data['message'] = 'Berhasil menambahkan Asrama!';
            $data['type'] = 'success';
        } catch (Exception $e) {
            $data['messageError'] = 'Terjadi kesalahan!';
            $data['message'] = true;
            $data['type'] = 'error';
        }
        return response()->json(['response' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asrama  $asrama
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $asrama = Asrama::find($id)->delete();
            $data['messageError'] = false;
            $data['message'] = 'Berhasil menghapus Asrama!';
            $data['type'] = 'success';
        } catch (Exception $e) {
            $data['messageError'] = 'Terjadi kesalahan!';
            $data['message'] = true;
            $data['type'] = 'error';
        }
        return response()->json(['response' => $data]);
    }
}

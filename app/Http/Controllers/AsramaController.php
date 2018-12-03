<?php

namespace App\Http\Controllers;

use App\Asrama;
use App\Kobong;
use App\DataNamaAsrama;
use App\Events\DrawTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Resources\AsramaResource;
use App\Http\Resources\AsramaKobongResource;
use DB;

class AsramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asramaPutra = Asrama::whereKategoriAsrama('putra')->get();
        $asramaPutri = Asrama::whereKategoriAsrama('putri')->get();
        $asramas = DataNamaAsrama::orderBy('id', 'ASC')->get();
        return view('sekretariat.asrama.asrama', compact('asramaPutra', 'asramaPutri', 'asramas'));
    }

    public function getAsramaDataTables(Request $request, Datatables $datatables)
    {
        // $asramas = Asrama::leftJoin('data_nama_asrama', 'asrama.nama_asrama', '=', 'data_nama_asrama.id')
        //     ->select(['asrama.id', 'data_nama_asrama.nama', 'asrama.kategori_asrama', 'asrama.roisam_asrama', 'asrama.created_at', 'asrama.updated_at']);
        $asramas = Asrama::with('ngaran')->select(['id', 'kategori_asrama', 'nama_asrama', 'roisam_asrama', 'created_at', 'updated_at']);
        return $datatables->eloquent($asramas)
                ->addColumn('action', function($asramas){
                    return '
                        <div class="text-center">

                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#tambahModalKobongAsrama"  title="Tambah Kobong" data-id="'. $asramas->id .'"><i class="icon wb-plus"></i></button>
                            <button data-target="#editModalAsrama" data-toggle="modal" data-content="Edit"
                            data-trigger="hover" data-original-title="Hover to trigger"
                            tabindex="0" title="" data-id="'. $asramas->id .'" class="btn btn-sm btn-warning"><i class="icon wb-edit"></i></button>

                            <button data-target="#deleteModalAsrama" data-toggle="modal" data-id="'. $asramas->id .'" class="btn btn-sm btn-danger"><i class="icon wb-trash"></i></button>

                        </div>

                            ';
                })
                ->addColumn('kobong', function($asramas){
                    $countKobong = Kobong::whereAsramaId($asramas->id)->count();
                        return '<a href="'. route('sekretariat.asrama.kobong', $asramas->id) .'" class="btn btn-sm btn-info">'. $countKobong .'</a>';
                })
                  ->filter(function($query) use ($request){
                    if (request()->get('kategori_asrama')) {
                      return $query->where('kategori_asrama', request()->get('kategori_asrama'))->get();
                    }
                  }, true)
                ->rawColumns(['action', 'kobong'])
                ->make(true);
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
        $asrama = AsramaResource::collection(Asrama::whereKategoriAsrama($kategori)->get());
        return response()->json(['data' => $asrama]);
    }

    public function getAsramaAllKategori()
    {
        $asrama = AsramaResource::collection(Asrama::orderBy('kategori_asrama', 'ASC')->get());
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

    public function kobong($id)
    {
        $kobong_asrama = Asrama::find($id);
        return view('sekretariat.asrama.kobong-asrama', compact('kobong_asrama'))->with([
            'title' => 'Data Kobong di Asrama',
            'name' => $kobong_asrama->ngaran->nama
        ]);
    }

    public function kobongJSON($id)
    {
        $asramaKobong = AsramaKobongResource::collection(Kobong::whereAsramaId($id)->get());
        return Datatables::of($asramaKobong)
                ->addColumn('action', function($asramaKobong){
                    return '
                    <button data-target="#editModalAsramaKobong" data-toggle="modal" data-content="Edit"
                    data-trigger="hover" data-original-title="Hover to trigger"
                    tabindex="0" title="" data-id="'. $asramaKobong['id'] .'" class="btn btn-sm btn-warning"><i class="icon wb-edit"></i></button>
                            <button data-target="#deleteModalKobongAsrama" data-toggle="modal" data-id="'. $asramaKobong['id'] .'" class="btn btn-sm btn-danger"><i class="icon wb-trash"></i></button>
                            ';
                })
                ->rawColumns(['action'])
                ->make(true);
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
        $namaAsrama->nama = request('nama_asrama_baru');
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
        if ($validate > 0) {
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
            event(new DrawTable());
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
        // $asrama = Asrama::whereId($id)->get();
        // return response()->json(['data' => $asrama]);
        return Asrama::find($id);
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
        // return response()->json(['response' => $data]);
        return back();
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

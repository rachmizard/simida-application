<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;
use App\Http\Resources\KelasResource;
use Yajra\Datatables\Datatables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sekretariat.kelas.kelas');
    }

    public function getKelasDatatables()
    {
        $karyawans = Kelas::all();
        return Datatables::of(KelasResource::collection(Kelas::all()))
                ->addColumn('action', function($karyawans){
                    return '<button data-target="#editModal" data-toggle="modal" data-id="'. $karyawans['id'] .'" class="btn btn-sm btn-warning">Edit</button>
                            <button data-target="#hapusModal" data-toggle="modal" data-url="'. route('sekretariat.kelas.destroy', $karyawans['id']) .'" class="btn btn-sm btn-danger">Hapus</button>
                            ';
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sekretariat.kelas.tambah');
    }

    public function getKelasJSON()
    {
        return KelasResource::collection(Kelas::get());
    }

    public function getKelasPutra()
    {
        return KelasResource::collection(Kelas::whereJk('Putra')->get());
    }

    public function getKelasPutri()
    {
        return KelasResource::collection(Kelas::whereJk('Putri')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kelas' => 'required', 
            'tingkat_id' => 'required', 
            'tingkat' => 'required', 
            'lokal' => 'required' , 
            'jk' => 'required' , 
            'guru_id' => 'required', 
            'badal_id' => 'required'
        ]);

        try {
            $validator = Kelas::where(
                [
                    'tingkat_id' => request('tingkat_id'),
                    'tingkat' => request('tingkat'),
                    'lokal' => request('lokal'),
                    'jk' => request('jk')
                ])->count();
            if ($validator > 1) {
                $data['messageWarning'] = 'Data kelas sudah tersedia!';
                $data['messageError'] = false;
                $data['message'] = false;
                $data['type'] = 'error';
            }else{
                $newKelas = Kelas::create($request->all());   
                $data['messageWarning'] = false;
                $data['messageError'] = false;
                $data['message'] = 'Berhasil menambahkan Kelas!';
                $data['type'] = 'success';   
            }
        } catch (Exception $e) {
            $data['messageError'] = 'Terjadi kesalahan!';
            $data['message'] = false;
            $data['type'] = 'error';
        }

        return response()->json(['response' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = new KelasResource(Kelas::find($id));
        return response()->json($kelas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateKelas = Kelas::find($id)->update($request->all());
        $data['messageWarning'] = false;
        $data['messageError'] = false;
        $data['message'] = 'Berhasil mengedit Kelas!';
        return response()->json(['response' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $updateKelas = Kelas::find($id)->delete();
            $data['messageWarning'] = false;
            $data['messageError'] = false;
            $data['message'] = 'Berhasil menghapus Kelas!';   
        } catch (Exception $e) {
            $data['messageWarning'] = false;
            $data['messageError'] = 'Terjadi kesalahan!';
            $data['message'] = false;  
        }
        return response()->json(['response' => $data]);
    }
}

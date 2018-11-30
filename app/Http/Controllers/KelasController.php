<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Guru;
use App\Tingkat;
use Illuminate\Http\Request;
use App\Http\Resources\KelasResource;
use Yajra\Datatables\Datatables;
use App\Events\DrawTable;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tingkat = Tingkat::all();
        $gurus = Guru::all();
        return view('sekretariat.kelas.kelas', compact('tingkat', 'gurus'));
    }

    public function getKelasDatatables()
    {
        $karyawans = Kelas::all();
        return Datatables::of(KelasResource::collection(Kelas::all()))
                ->addColumn('action', function($karyawans){
                    return '
                    <a href="#/kelas/list_santri/'.$karyawans['id'].'" class="btn btn-xs btn-info" title="Lihat Santri di dalam kelas '. $karyawans['nama_kelas'] .'"><i class="icon wb-user-circle"></i></a>
                    <a data-target="#editModal" data-toggle="modal" data-content="Edit"
                    data-trigger="hover" data-original-title="Hover to trigger"
                    tabindex="0" title="" data-id="'. $karyawans['id'] .'" class="btn btn-xs btn-warning text-white"><i class="icon wb-edit"></i></a>
                            <a href="#/kelas/hapus/'.  $karyawans['id'] .'" class="btn btn-xs btn-danger text-white"><i class="icon wb-trash"></i></a>
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
            if ($validator > 0) {
                $data['messageWarning'] = 'Data kelas sudah tersedia!';
                $data['messageError'] = false;
                $data['message'] = false;
                $data['type'] = 'error';
            }else{
                $newKelas = new Kelas();   
                $newKelas->nama_kelas = $request->tingkat.$request->lokal.' '.$request->tingkat_id. ' '.$request->jk;
                
                // INSERT
                $newKelas->tingkat = $request->tingkat;
                $newKelas->lokal = $request->lokal;
                $newKelas->tingkat_id = $request->tingkat_id;
                $newKelas->jk = $request->jk;
                $newKelas->guru_id = $request->guru_id;
                $newKelas->badal_id = $request->badal_id;
                $newKelas->save();

                // UPDATE
                $updateKelas = Kelas::find($newKelas->id);
                $updateKelas->nama_kelas = $request->tingkat.$request->lokal.' '.$newKelas['tingkatKelas']['nama_tingkatan']. ' '.$request->jk;
                $updateKelas->update();
                event(new DrawTable());

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
        // return response()->json(['response' => $data]);
        event(new DrawTable());
        return redirect(route('sekretariat.kelas').'#/list_kelas');
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

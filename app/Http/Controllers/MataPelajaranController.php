<?php

namespace App\Http\Controllers;

use App\MataPelajaran;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendidikan.mata_pelajaran.mata_pelajaran');
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

    public function getMataPelajaranDataTables(Datatables $datatables)
    {
        $mapels = MataPelajaran::select('mata_pelajaran.*')->with(['tingkat', 'kelas']);
        return $datatables->eloquent($mapels)
                              ->addColumn('action', function($var){
                                return '
                                        <div class="btn-group text-center">
                                            <a href="#/mata_pelajaran/detail/'. $var->id .'" class="btn btn-sm btn-warning text-white" title="Lihat detil mata pelajaran"><i class="icon wb-eye"></i></a>
                                            <a href="#/mata_pelajaran/edit/'. $var->id .'" class="btn btn-sm btn-warning text-white"><i class="icon wb-edit"></i></a>
                                            <a href="#/mata_pelajaran/hapus/'. $var->id .'" class="btn btn-sm btn-danger text-white"><i class="icon wb-trash"></i></a>
                                        </div>

                                        ';
                              })
                              ->make(true);
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
            'nama_mata_pelajaran' => 'required',
            'tingkat_id' => 'tingkat_id',
            'kelas_id' => 'kelas_id',
        ]);
        $mataPelajaran = MataPelajaran::create($request->all());
        $data['message'] = 'Mata Pelajaran berhasil ditambahkan!';
        $data['messageError'] = false;
        $data['messageWarning'] = false;
        return response()->json(['response' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return MataPelajaran::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(MataPelajaran $mataPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_mata_pelajaran' => 'required',
            'tingkat_id' => 'tingkat_id',
            'kelas_id' => 'kelas_id',
        ]);

        $mataPelajaran = MataPelajaran::find($id)->update($request->all());
        $data['message'] = 'Mata Pelajaran berhasil diedit!';
        $data['messageError'] = false;
        $data['messageWarning'] = false;
        return response()->json(['response' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mataPelajaran = MataPelajaran::find($id)->delete();
        $data['message'] = 'Mata Pelajaran telah terhapus!';
        $data['messageError'] = false;
        $data['messageWarning'] = false;
        return response()->json(['response' => $data]);
    }
}

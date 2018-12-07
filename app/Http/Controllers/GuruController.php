<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Events\DrawTable;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sekretariat.guru.guru');
    }

    public function getGuruDataTables(Request $request, Datatables $datatables)
    {
        $gurus = Guru::select('guru.*')->with(['tingkat', 'kelas']);
        return $datatables->eloquent($gurus)
                              ->addColumn('action', function($var){
                                return '
                                        <div class="btn-group text-center">
                                            <a href="#/edit/guru/'. $var->id .'" class="btn btn-sm btn-warning text-white"><i class="icon wb-edit"></i></a>
                                            <a href="#/hapus/guru/'. $var->id .'" class="btn btn-sm btn-danger text-white"><i class="icon wb-trash"></i></a>
                                        </div>

                                        ';
                              })
                              ->addColumn('kelas', function($var){
                                return $var->kelas == null ? 'Kosong' : $var->kelas->nama_kelas;
                              })
<<<<<<< HEAD
                              ->filter(function($query) use ($request){
                                if (request()->get('filter_tingkat')) {
                                  return $query->whereHas('tingkat', function($q){
                                    $q->where('id', request()->get('filter_tingkat'));
                                  })->get();
                                }
                              }, true)
=======
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
                              ->orderColumn('kelas_id', '-kelas_id $1')
                              ->make(true);
    }

    public function getJSON()
    {
        return Guru::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sekretariat.guru.tambah');
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
            'nama_guru' => 'required'
        ]);

        try {
            $guru = Guru::create($request->all());
            $data['messageWarning'] = false;
            $data['messageError'] = false;
            $data['message'] = 'Berhasil menambahkan Guru!';
            $data['type'] = 'success';
            event(new DrawTable());
        } catch (Exception $e) {
            $data['messageError'] = 'Terjadi kesalahan!';
            $data['messageWarning'] = false;
            $data['message'] = false;
            $data['type'] = 'error';
        }

        return response()->json(['response' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Guru::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tingkat_id' => 'required', 
            'nama_guru' => 'required'
        ]);

        try {
            $guru = Guru::find($id)->update($request->all());
            $data['messageError'] = false;
            $data['messageWarning'] = false;
            $data['message'] = 'Berhasil mengedit data Guru!';
            $data['type'] = 'success';
            event(new DrawTable());
        } catch (Exception $e) {
            $data['messageError'] = 'Terjadi kesalahan!';
            $data['messageWarning'] = false;
            $data['message'] = false;
            $data['type'] = 'error';
        }

        return response()->json(['response' => $data, 'guru' => $guru]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $guru = Guru::find($id)->delete();
            $data['messageError'] = false;
            $data['message'] = 'Berhasil menghapus data Guru!';
            $data['type'] = 'success';       
            event(new DrawTable());
        } catch (Exception $e) {
            $data['messageError'] = 'Terjadi kesalahan!';
            $data['message'] = false;
            $data['type'] = 'error';       
        }
        return response()->json(['response' => $data]);
    }
}

<?php

namespace App\Http\Controllers;

use App\DewanKyai;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class DewanKyaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sekretariat.dewan_kyai.dewankyai');
    }

    public function getDewanKyaiDataTables(Datatables $datatables)
    {
        $dewankyai = DewanKyai::select('dewan_kyai.*');
        return $datatables->eloquent($dewankyai)
                ->addColumn('action', function($dewankyai){
                    return '
                        <div class="text-center">

                            <a href="#/dewankyai/edit/'. $dewankyai->id .'" class="btn btn-sm btn-success text-white" title="Edit"><i class="icon wb-edit"></i></a>
                            <a href="#/dewankyai/hapus/'. $dewankyai->id .'" title="Hapus" class="btn btn-sm btn-danger text-white"><i class="icon wb-trash"></i></a>

                        </div>

                            ';
                })
                ->addColumn('foto', function($dewankyai){
                    return '
                        <div class="text-center">
                            <img src="/storage/dewan_pic/'. $dewankyai->foto .'" src="100" height="100" alt="Foto Dewan Kyai '. $dewankyai->nama_dewan_kyai .'">
                        </div>
                    ';
                })
                ->rawColumns(['action', 'foto'])
                ->make(true);
    }

    public function getDewanKyaiJSON()
    {
        
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
        $this->validate($request, [
            'nama_dewan_kyai' => 'required',
            'foto' => 'mimes:jpeg,jpg,png | max:5000',
        ]);

        try {
            $dewanKyai = new DewanKyai();
            $dewanKyai->nama_dewan_kyai = $request->nama_dewan_kyai;
            $uploadFile = $request->image;
            $imageName = time().'.'.$uploadFile->getClientOriginalExtension();
            $uploadFile->move(public_path('/storage/dewan_pic/'), $imageName);
            $dewanKyai->foto = $imageName;
            $dewanKyai->save();
            $data['message'] = 'Berhasil menambahkan Dewan Kyai!';
            $data['messageError'] = false;
            $data['messageWarning'] = false;
            $data['type'] = 'success';
        } catch (Exception $e) {
            $data['message'] = false;
            $data['messageError'] = 'Terjadi Kesalahan!';
            $data['messageWarning'] = false;
            $data['type'] = 'error';
        }

        return response()->json(['response' => $data]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DewanKyai  $dewanKyai
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DewanKyai::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DewanKyai  $dewanKyai
     * @return \Illuminate\Http\Response
     */
    public function edit(DewanKyai $dewanKyai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DewanKyai  $dewanKyai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_dewan_kyai' => 'required',
            'foto' => 'mimes:jpeg,jpg,png | max:5000',
        ]);

        try {
            $dewanKyai = DewanKyai::findOrFail($id);
            $dewanKyai->nama_dewan_kyai = $request->nama_dewan_kyai;
            $uploadFile = $request->image;
            if ($uploadFile == null) {
                $imageName = $dewanKyai->foto;
            }else{
                // Delete File
                if (file_exists(public_path('storage/dewan_pic/'. $dewanKyai->foto))) {
                    unlink(public_path('storage/dewan_pic/'.$dewanKyai->foto));
                }
                // Set image name and moving the file
                $imageName = time().'.'.$uploadFile->getClientOriginalExtension();
                $uploadFile->move(public_path('/storage/dewan_pic/'), $imageName);
            }
            $dewanKyai->foto = $imageName;
            $dewanKyai->update();
            $data['message'] = 'Berhasil mengedit Dewan Kyai!';
            $data['messageError'] = false;
            $data['messageWarning'] = false;
            $data['type'] = 'success';
        } catch (Exception $e) {
            $data['message'] = false;
            $data['messageError'] = 'Terjadi Kesalahan!';
            $data['messageWarning'] = false;
            $data['type'] = 'error';
        }

        return response()->json(['response' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DewanKyai  $dewanKyai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        $dewankyai = DewanKyai::find($id)->delete();            
        $data['message'] = 'Berhasil menghapus '. $dewankyai->nama_dewan_kyai .' dari data Dewan Kyai!';
        $data['messageError'] = false;
        $data['messageWarning'] = false;
        $data['type'] = 'success';
        } catch (Exception $e) {
            $data['message'] = false;
            $data['messageError'] = 'Terjadi Kesalahan!';
            $data['messageWarning'] = false;
            $data['type'] = 'error';
        }
    }
}

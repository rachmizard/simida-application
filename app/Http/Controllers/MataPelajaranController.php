<?php

namespace App\Http\Controllers;

use App\MataPelajaran;
use App\Kelas;
use App\Tingkat;
use App\Santri;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Resources\MataPelajaranSelect2Resource;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MataPelajaranExport;
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

    public function getMataPelajaranDataTables(Request $request, Datatables $datatables)
    {
        $mapels = MataPelajaran::select('mata_pelajaran.*')->with(['tingkat']);
        return $datatables->eloquent($mapels)
                              ->addColumn('action', function($var){
                                return '
                                        <div class="btn-group text-center">
                                            <a href="#/mata_pelajaran/edit/'. $var->id .'" class="btn btn-sm btn-warning text-white"><i class="icon wb-edit"></i></a>
                                            <a href="#/mata_pelajaran/hapus/'. $var->id .'" class="btn btn-sm btn-danger text-white"><i class="icon wb-trash"></i></a>
                                        </div>

                                        ';
                              })
                              ->filter(function($query) use ($request){
                                // if (request()->get('filter_kelas')) {
                                //   return $query->whereHas('kelas', function($q){
                                //     $q->where('nama_kelas', request()->get('filter_kelas'));
                                //   })->get();
                                // }
                                
                                if (request()->get('filter_tingkat')) {
                                  return $query->whereHas('tingkat', function($q){
                                    $q->where('id', request()->get('filter_tingkat'));
                                  })->get();
                                }
                              }, true)
                              ->make(true);
    }

    public function MataPelajaranSelect2()
    {
        return MataPelajaranSelect2Resource::collection(MataPelajaran::all());
    }

    public function showMapelByTingkat($id)
    {
        $matapelajaran = [];
        $jenis_nilai = [
            'Nilai Mingguan',
            'Nilai Uas',
            'Rata Rata'
        ];
        $items = array();
        $putih = array();

        $datas = MataPelajaran::with('tingkat')->whereTingkatId($id)->get();
        $i = 0;
        foreach ($datas as $data) {
            $matapelajaran['nama_mata_pelajaran'] = $data->nama_mata_pelajaran;
            for($i=0; $i < count($jenis_nilai); $i++) 
            {
                $matapelajaran['jenis_nilai'] = $jenis_nilai[$i]; 
                array_push($items, $matapelajaran);
            }
            array_push($putih, $items);
            $items = array();
        }
        return response()->json(['data' => $putih]);
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
            'tingkat_id' => 'required',
            'bobot' => 'required'
            // 'kelas_id' => 'required',
        ]);

        // $validator = MataPelajaran::where(['nama_mata_pelajaran' => $request->nama_mata_pelajaran])->where('tingkat_id', $request->tingkat_id)->where('kelas_id', $request->kelas_id)->count();
        $validator = MataPelajaran::where(['nama_mata_pelajaran' => $request->nama_mata_pelajaran])->where('tingkat_id', $request->tingkat_id)->count();
        if ($validator > 0) {
            $data['message'] = false;
            $data['messageError'] = false;
            // $data['messageWarning'] = 'Mata Pelajaran '. $request->nama_mata_pelajaran .' sudah ada di kelas '. Kelas::find($request->kelas_id)->nama_kelas .'';
            $data['messageWarning'] = 'Mata Pelajaran '. $request->nama_mata_pelajaran .' sudah ada di tingkat '. Tingkat::find($request->tingkat_id)->nama_tingkatan .'';
        }else{
            $data['message'] = 'Mata Pelajaran berhasil ditambahkan!';
            $data['messageError'] = false;
            $data['messageWarning'] = false;
            $post = MataPelajaran::create($request->all());
            $data['message'] = 'Mata Pelajaran berhasil ditambahkan!';
            $data['messageError'] = false;
            $data['messageWarning'] = false;
        }
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
            'tingkat_id' => 'required',
            'bobot' => 'required'
            // 'kelas_id' => 'required',
        ]);

        // $validator = MataPelajaran::where(['nama_mata_pelajaran' => $request->nama_mata_pelajaran])->where('tingkat_id', $request->tingkat_id)->where('kelas_id', $request->kelas_id)->count();

        $validator = MataPelajaran::where(['nama_mata_pelajaran' => $request->nama_mata_pelajaran])->where('tingkat_id', $request->tingkat_id)->count();

        // Turn off condition
        // if ($validator > 0) {
            // $data['message'] = false;
            // $data['messageError'] = false;
            // $data['messageWarning'] = 'Mata Pelajaran '. $request->nama_mata_pelajaran .' sudah ada di tingkat '. Tingkat::find($request->tingkat_id)->nama_tingkatan .'';
        // }else{
            $data['message'] = 'Mata Pelajaran berhasil di edit!';
            $data['messageError'] = false;
            $data['messageWarning'] = false;
            $post = MataPelajaran::find($id)->update($request->all());
        // }
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

    public function export()
    {
        return Excel::download(new MataPelajaranExport(), 'mata_pelajaran_'. Carbon::now()->format('d-m-Y') .'.xlsx');        
    }
}


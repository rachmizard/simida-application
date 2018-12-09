<?php

namespace App\Http\Controllers;

use App\JadwalPelajaran;
use App\Periode;
use App\MataPelajaran;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class JadwalPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendidikan.jadwalpelajaran.jadwalpelajaran');
    }

    public function getJadwal(Request $request, Datatables $datatables)
    {
        $jadwalpels = JadwalPelajaran::with(['matapelajaran', 'guru', 'kelas']);
        return $datatables->eloquent($jadwalpels)
                ->addColumn('aksi', function($jadwalpels){
                    return '
                            <a href="#/jadwalpelajaran/edit/'. $jadwalpels['id'] .'" class="btn btn-xs btn-warning"><i class="icon wb-edit"></i></a>
                            <a href="#/jadwalpelajaran/hapus/'. $jadwalpels['id'] .'" class="btn btn-xs btn-danger"><i class="icon wb-trash"></i></a>
                    ';
                })
                ->filter(function($query) use ($request){
                    if (request()->get('filter_kelas')) {
                        $query->whereHas('kelas', function($q){
                            $q->where('nama_kelas', request()->get('filter_kelas'));
                        })->get();
                    }
                }, true)
                ->rawColumns(['aksi'])
                ->make(true);
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
            'mata_pelajaran_id' => 'required', 
            'hari' => 'required', 
            'guru_id' => 'required', 
            'kelas_id' => 'required', 
            'hari' => 'required',
            // 'semester_id' => 'required', 
            'jam_masuk' => 'required', 
            'jam_selesai' => 'required', 
            // 'periode' => 'required',
        ]);

        $getDefaultPeriode = Periode::whereStatus('aktif')->first();
        $validator = JadwalPelajaran::where('mata_pelajaran_id', $request->mata_pelajaran_id)
                                    ->where('guru_id', $request->guru_id)
                                    ->where('kelas_id', $request->kelas_id)
                                    ->where('hari', $request->hari)
                                    // ->where('semester_id', $request->semester_id) // Still waiting for decision
                                    ->where('jam_masuk', $request->jam_masuk)
                                    ->where('jam_selesai', $request->jam_selesai)
                                    ->where('periode', $getDefaultPeriode['nama_periode'])
                                    ->count();
        if ($validator > 0) {
            $data['message'] = 'Jadwal '. MataPelajaran::find($request->mata_pelajaran_id)->value('nama_mata_pelajaran') .' sudah tersedia di hari '. $request->hari .' pada periode '. $getDefaultPeriode['nama_periode'] .', silahkan cek lagi Jadwal yang kosong.';
        }else{
            $jadwalpelajaran = JadwalPelajaran::create([
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'guru_id' => $request->guru_id,
                'kelas_id' => $request->kelas_id,
                'hari' => $request->hari,
                'semester_id' => $request->semester_id,
                'jam_masuk' => $request->jam_masuk,
                'jam_selesai' => $request->jam_selesai,
                'periode' => $getDefaultPeriode['nama_periode']
            ]);
            $data['message'] = 'Jadwal berhasil disimpan!';   
        }

        return response()->json(['response' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JadwalPelajaran  $jadwalPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return JadwalPelajaran::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JadwalPelajaran  $jadwalPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalPelajaran $jadwalPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JadwalPelajaran  $jadwalPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'mata_pelajaran_id' => 'required', 
            'hari' => 'required', 
            'guru_id' => 'required', 
            'kelas_id' => 'required', 
            'semester_id' => 'required', 
            'jam_masuk' => 'required', 
            'jam_selesai' => 'required', 
            'periode' => 'required',
        ]);

        $getDefaultPeriode = Periode::whereStatus('aktif')->first();
        $validator = JadwalPelajaran::where('mata_pelajaran_id', $request->mata_pelajaran_id)
                                    ->where('guru_id', $request->guru_id)
                                    ->where('kelas_id', $request->kelas_id)
                                    // ->where('semester_id', $request->semester_id) // Still waiting for decision
                                    ->where('jam_masuk', $request->jam_masuk)
                                    ->where('jam_selesai', $request->jam_selesai)
                                    ->where('periode', $getDefaultPeriode['nama_periode'])
                                    ->count();
        if ($validator > 0) {
            $data['message'] = 'Jadwal '. MataPelajaran::find($request->mata_pelajaran_id)->value('nama_mata_pelajaran') .' sudah tersedia di hari '. $request->hari .' pada periode '. $getDefaultPeriode['nama_periode'] .', silahkan cek lagi Jadwal yang kosong.';
        }else{
            $jadwalpelajaran = JadwalPelajaran::find($id)->update([
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'guru_id' => $request->guru_id,
                'kelas_id' => $request->kelas_id,
                'semester_id' => $request->semester_id,
                'jam_masuk' => $request->jam_masuk,
                'jam_selesai' => $request->jam_selesai,
                'periode' => $getDefaultPeriode['nama_periode']
            ]);
            $data['message'] = 'Jadwal berhasil edit!';   
        }

        return response()->json(['response' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JadwalPelajaran  $jadwalPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JadwalPelajaran::find($id)->delete();

        return response()->json(['message' => 'Jadwal berhasil di hapus!']);
    }
}


<?php

namespace App\Http\Controllers;

use App\Santri;
use App\Kelas;
use App\Tingkat;
use App\DewanKyai;
use App\Kobong;
use App\Location\Province;
use App\Location\Regency;
use App\Location\District;
use App\Location\Village;
use Illuminate\Http\Request;
use App\DataNamaAsrama;
use App\Asrama;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SantriExport;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Http\Resources\SantriResource;
use DB;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sekretariat.santri.santri');   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function santri_aktif()
    {
        return view('sekretariat.data-santri-aktif.data-santri-aktif');   
    }

    public function pendaftaran()
    {

        $asramaPutra = Asrama::whereKategoriAsrama('Putra')->get();
        $asramaPutri = Asrama::whereKategoriAsrama('Putri')->get();
        $tingkats = Tingkat::orderBy('nama_tingkatan')->get();
        $dewankyai = DewanKyai::all();
        return view('sekretariat.santri.pendaftaran', compact('asramaPutra', 'asramaPutri', 'tingkats', 'dewankyai'));
    }

    public function getSantriDataTables(Request $request, Datatables $datatables)
    {
        $santri = Santri::with([
                                'asrama.ngaran',
                                'kobong',
                                'tingkat',
                                'kelas',
                                'dewan'
                                ])->select('santri.*')->where('status', 'aktif');
        return $datatables->eloquent($santri) 
                              ->addColumn('action', function($var){
                                return '
                                        <div class="btn-group text-center">
                                            <a href="#/detail/santri/'. $var->id .'" class="btn btn-xs btn-info text-white"><i class="icon wb-eye"></i></a>
                                            <a href="'. route('sekretariat.santri.edit', $var->id) .'" class="btn btn-xs btn-warning text-white"><i class="icon wb-edit"></i></a>
                                            <a href="#/hapus/santri/'. $var->id .'" class="btn btn-xs btn-danger text-white"><i class="icon wb-trash"></i></a>
                                        </div>

                                        ';
                              })
                              ->addColumn('status', function($var){
                                    if ($var['status'] == 'aktif') {
                                        return '<span class="badge badge-round badge-md badge-success">'. $var['status'] .'</span>';
                                    }else{
                                        return '<span class="badge badge-round badge-md badge-danger">'. $var['status'] .'</span>';
                                    }
                              })
                              ->editColumn('foto', function($var){
                                    return '<img src="/storage/santri_pic/'. $var->foto .'" width="100" height="100" alt="Foto Santri '. $var->nama_santri .'">';
                              })
                              ->filter(function($query) use ($request){
                                if (request()->get('filter_kelas')) {
                                  return $query->whereHas('kelas', function($q){
                                    $q->where('nama_kelas', request()->get('filter_kelas'));
                                  })->get();
                                }

                                if (request()->get('filter_asrama')) {
                                  return $query->whereHas('asrama', function($q){
                                    $q->where('id', request()->get('filter_asrama'));
                                  })->get();
                                }
                              }, true)
                              // ->addColumn('foto', function($var){
                              //       return '<img src="/storage/santri_pic/'. $var->foto .'" width="100" height="100" alt="Foto Santri '. $var->nama_santri .'">';
                              // })
                              // ->addColumn('foto', function($var){
                              //       return '<img src="/storage/santri_pic/'. $var->foto .'" width="100" height="100" alt="Foto Santri '. $var->nama_santri .'">';
                              // })
                              ->rawColumns(['action', 'foto', 'status'])
                              ->make(true);
    }

    public function getSantriAktifDataTables(Request $request, Datatables $datatables)
    {
        $santri = Santri::with([
                                'asrama.ngaran',
                                'kobong',
                                'tingkat',
                                'kelas',
                                'dewan'
                                ])->select('santri.*')->where('status', 'aktif');
        return $datatables->eloquent($santri) 
                              ->addColumn('action', function($var){
                                return '
                                        <div class="btn-group text-center">
                                            <a href="#/detail/santri/'. $var->id .'" class="btn btn-xs btn-info text-white"><i class="icon wb-eye"></i></a>
                                            <a href="'. route('sekretariat.santri.edit', $var->id) .'" class="btn btn-xs btn-warning text-white"><i class="icon wb-edit"></i></a>
                                            <a href="#/hapus/santri/'. $var->id .'" class="btn btn-xs btn-danger text-white"><i class="icon wb-trash"></i></a>
                                        </div>

                                        ';
                              })
                              ->addColumn('status', function($var){
                                    if ($var['status'] == 'aktif') {
                                        return '<span class="badge badge-round badge-md badge-success">'. $var['status'] .'</span>';
                                    }else{
                                        return '<span class="badge badge-round badge-md badge-danger">'. $var['status'] .'</span>';
                                    }
                              })
                              ->filter(function($query) use ($request){
                                if (request()->get('filter_kelas')) {
                                  return $query->whereHas('kelas', function($q){
                                    $q->where('nama_kelas', request()->get('filter_kelas'));
                                  })->get();
                                }

                                if (request()->get('filter_asrama')) {
                                  return $query->whereHas('asrama', function($q){
                                    $q->where('id', request()->get('filter_asrama'));
                                  })->get();
                                }
                              }, true)
                              // ->addColumn('foto', function($var){
                              //       return '<img src="/storage/santri_pic/'. $var->foto .'" width="100" height="100" alt="Foto Santri '. $var->nama_santri .'">';
                              // })
                              // ->addColumn('foto', function($var){
                              //       return '<img src="/storage/santri_pic/'. $var->foto .'" width="100" height="100" alt="Foto Santri '. $var->nama_santri .'">';
                              // })
                              ->rawColumns(['action', 'foto', 'status'])
                              ->make(true);
    }

    public function getSantriJSON()
    {
        return SantriResource::collection(Santri::whereStatus('aktif')->get());
    }

    public function showByClass(Datatables $datatables, $id_kelas)
    {
        $santri = Santri::whereKelasId($id_kelas)->with([
                                'asrama.ngaran',
                                'kobong',
                                'tingkat',
                                'kelas',
                                'dewan'
                                ])->select('santri.*')->whereStatus('aktif');
        return $datatables->eloquent($santri) 
                              ->addColumn('action', function($var){
                                return '
                                        <div class="btn-group text-center">
                                            <a href="#/detail/santri/'. $var->id .'" class="btn btn-xs btn-info text-white"><i class="icon wb-eye"></i></a>
                                            <a href="'. route('sekretariat.santri.edit', $var->id) .'" class="btn btn-xs btn-warning text-white"><i class="icon wb-edit"></i></a>
                                            <a href="#/hapus/santri/'. $var->id .'" class="btn btn-xs btn-danger text-white"><i class="icon wb-trash"></i></a>
                                        </div>

                                        ';
                              })
                              ->rawColumns(['action', 'foto'])
                              ->make(true);
    }

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
            'nik' => 'required', 
            'nama_santri' => 'string|required', 
            'tgl_lahir' => 'required', 
            'jenis_kelamin' => 'required', 
            'provinsi' => 'required', 
            'kabupaten_kota' => 'required', 
            'kecamatan' => 'required', 
            'kelurahan' => 'required', 
            'alamat' => 'required', 
            'kode_pos' => 'required', 
            'nama_ortu' => 'required', 
            'nama_wali' => 'required', 
            'no_telp' => 'required', 
            'pendidikan_terakhir' => 'required', 
            'asrama_id' => 'required', 
            'kobong_id' => 'required', 
            // 'tingkat_id' => 'required', 
            // 'kelas_id' => 'required', 
            'tgl_masuk' => 'required', 
            'himpunan' => 'required', 
            'dewan_id' => 'required', 
            'pesantren_sebelumnya' => 'required', 
            // 'foto'
        ]);

        $newSantri = new Santri();
        $newSantri->nis = $request->provinsi.substr($request->kabupaten_kota, -2).substr($request->kecamatan, -2).date('dmy', strtotime($request->tgl_masuk));
        $newSantri->nik = $request->nik;
        $newSantri->nama_santri = $request->nama_santri;
        $newSantri->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
        $newSantri->jenis_kelamin = $request->jenis_kelamin;
        $newSantri->provinsi = $request->provinsi;
        $newSantri->kabupaten_kota = $request->kabupaten_kota;
        $newSantri->kecamatan = $request->kecamatan;
        $newSantri->kelurahan = $request->kelurahan;
        $newSantri->alamat = $request->alamat;
        $newSantri->kode_pos = $request->kode_pos;
        $newSantri->nama_ortu = $request->nama_ortu;
        $newSantri->nama_wali = $request->nama_wali;
        $newSantri->no_telp = $request->no_telp;
        $newSantri->pendidikan_terakhir = $request->pendidikan_terakhir;
        $newSantri->asrama_id = $request->asrama_id;
        $newSantri->kobong_id = $request->kobong_id;
        // $newSantri->tingkat_id = $request->tingkat_id;
        // $newSantri->kelas_id = $request->kelas_id;
        $newSantri->tgl_masuk = Carbon::parse($request->tgl_masuk)->format('Y-m-d');
        $newSantri->himpunan = $request->himpunan;
        $newSantri->dewan_id = $request->dewan_id;
        $newSantri->pesantren_sebelumnya = $request->pesantren_sebelumnya;
        if ($request->file('foto')) {
            $imageName = time().'_'.$request->nama_santri.'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/storage/santri_pic/'), $imageName);
            $newSantri->foto = $imageName;
        }else{
            $newSantri->foto = null;
        }
        $newSantri->save();

        // $getSantri = Santri::find($newSantri->id);
        // $getSantri->provinsi = Province::whereId($request->provinsi)->value('name');
        // $getSantri->kabupaten_kota = Regency::whereId($request->kabupaten_kota)->value('name');
        // $getSantri->kecamatan = District::whereId($request->kecamatan)->value('name');
        // $getSantri->update();


        // return response()->json(['message' => 'success']);
        return redirect(route('sekretariat.santri').'#/list_santri');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Santri::with([
                            'asrama.ngaran',
                            'kobong',
                            'tingkat',
                            'kelas',
                            'dewan'
                            ])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $idSantri = Santri::find($id);
        $asramaPutra = Asrama::whereKategoriAsrama('Putra')->get();
        $asramaPutri = Asrama::whereKategoriAsrama('Putri')->get();
        $tingkats = Tingkat::orderBy('nama_tingkatan')->get();
        $kobongs = Kobong::orderBy('nama_kobong')->get();
        $dewankyai = DewanKyai::all();
        $provinces = Province::all();
        $regencies = Regency::all();
        $districts = District::all();
        $villages = DB::table('villages')->get();
        return view('sekretariat.santri.edit', compact('asramaPutra', 'asramaPutri', 'tingkats', 'dewankyai', 'idSantri', 'dewankyai', 'provinces', 'regencies', 'districts', 'villages', 'kobongs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nik' => 'required', 
            'nama_santri' => 'string|required', 
            'tgl_lahir' => 'required', 
            'jenis_kelamin' => 'required', 
            // 'provinsi' => 'required', 
            // 'kabupaten_kota' => 'required', 
            // 'kecamatan' => 'required', 
            // 'kelurahan' => 'required', 
            'alamat' => 'required', 
            'kode_pos' => 'required', 
            'nama_ortu' => 'required', 
            'nama_wali' => 'required', 
            'no_telp' => 'required', 
            'pendidikan_terakhir' => 'required', 
            'asrama_id' => 'required', 
            'kobong_id' => 'required', 
            // 'tingkat_id' => 'required', 
            // 'kelas_id' => 'required', 
            'tgl_masuk' => 'required', 
            'himpunan' => 'required', 
            'dewan_id' => 'required', 
            'pesantren_sebelumnya' => 'required', 
            // 'foto'
        ]);

       try { 
            $newSantri = Santri::find($id);
            $newSantri->nis = $request->provinsi.substr($request->kabupaten_kota, -2).substr($request->kecamatan, -2).date('dmy', strtotime($request->tgl_masuk));
            $newSantri->nik = $request->nik;
            $newSantri->nama_santri = $request->nama_santri;
            $newSantri->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
            $newSantri->jenis_kelamin = $request->jenis_kelamin;
            $newSantri->provinsi = $request->provinsi == '' ? $request->provinsi_old : $request->provinsi;
            $newSantri->kabupaten_kota = $request->kabupaten_kota == '' ? $request->kabupaten_kota_old : $request->kabupaten_kota;;
            $newSantri->kecamatan = $request->kecamatan == '' ? $request->kecamatan_old : $request->kecamatan;;
            $newSantri->kelurahan = $request->kelurahan == '' ? $request->kelurahan_old : $request->kelurahan;;
            $newSantri->alamat = $request->alamat;
            $newSantri->kode_pos = $request->kode_pos;
            $newSantri->nama_ortu = $request->nama_ortu;
            $newSantri->nama_wali = $request->nama_wali;
            $newSantri->no_telp = $request->no_telp;
            $newSantri->pendidikan_terakhir = $request->pendidikan_terakhir;
            $newSantri->asrama_id = $request->asrama_id;
            $newSantri->kobong_id = $request->kobong_id;
            // $newSantri->tingkat_id = $request->tingkat_id;
            // $newSantri->kelas_id = $request->kelas_id;
            $newSantri->tgl_masuk = date('Y-m-d', strtotime($request->tgl_masuk));
            $newSantri->himpunan = $request->himpunan;
            $newSantri->dewan_id = $request->dewan_id;
            $newSantri->pesantren_sebelumnya = $request->pesantren_sebelumnya;
            if ($request->foto) {
                // Delete File
                if (file_exists(public_path('storage/santri_pic/'. $newSantri->foto))) {
                    unlink(public_path('storage/santri_pic/'.$newSantri->foto));
                }
                $imageName = time().'_'.$request->nama_santri.'.'.$request->foto->getClientOriginalExtension();
                $request->foto->move(public_path('/storage/santri_pic/'), $imageName);
                $newSantri->foto = $imageName;
            }else{
                $newSantri->foto = $request->foto_old;
            }
            $newSantri->save();

            // $getSantri = Santri::find($newSantri->id);
            // $getSantri->provinsi = Province::whereId($request->provinsi)->value('name');
            // $getSantri->kabupaten_kota = Regency::whereId($request->kabupaten_kota)->value('name');
            // $getSantri->kecamatan = District::whereId($request->kecamatan)->value('name');
            // $getSantri->update();

            $data['message'] = 'Berhasil mengedit Data Santri!';
            $data['messageError'] = false;
            $data['messageWarning'] = false;
            $data['type'] = 'success';
       } catch (Exception $e) {
            $data['message'] = false;
            $data['messageError'] = 'Terjadi kesalahan!';
            $data['messageWarning'] = false;
            $data['type'] = 'error';
       }

        // return response()->json(['response' => $data]);
       return redirect(route('sekretariat.santri').'#/list_santri');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $santri = Santri::find($id)->delete();
        return response()->json(['message' => 'success']);
    }

    public function export(Request $request)
    {
      return Excel::download(new SantriExport, 'santri_'.Carbon::now().'.xlsx');
    }
}

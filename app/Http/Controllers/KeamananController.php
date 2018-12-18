<?php

namespace App\Http\Controllers;
use App\Keamanan;
use App\Santri;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class KeamananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function listSantriIzin(Request $request)
    {
        
    }

    public function listSantriIzinWithFilter(Request $request)
    {
        $santri = Santri::with(['kelas', 'asrama'])->where('nama_santri', $request->nama_santri )->orWhere('nis', $request->nis)->get();
        $available = count($santri) > 0 ? true : false;
        return response()->json(['data' => $santri, 'available' => $available]);
    }

    public function getListSantriIzinDataTables(Datatables $datatables)
    {
        $entriIzin = Keamanan::with('santri')->select('keamanan.*');
        return $datatables->eloquent($entriIzin)->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Keamanan::whereSantriId($request->santri_id)
                            ->whereKategori($request->kategori)
                            ->whereStatus($request->status)
                            ->get();

        $entri = new Keamanan();
        if ($request->kategori == 'jauh') {
            $this->validate($request, [
                'santri_id' => 'required', 
                'kategori' => 'required', 
                'alasan' => 'required', 
                'durasi' => 'required', 
                'status' => 'required', 
                'pemberi_izin' => 'required'
            ]);

            if (count($validator) > 0) {
                $message['message'] = 'Santri tersebut sudah melakukan izin!';
            }else{
                $entri->santri_id = $request->santri_id;
                $entri->kategori = $request->kategori;
                $entri->alasan = $request->alasan;
                $entri->tujuan = $request->tujuan;
                $entri->status = $request->status;
                $entri->pemberi_izin = $request->pemberi_izin;
                $message['message'] = 'Santri berhasil di masukan ke entri izin!';
            }
        }else{

            $this->validate($request, [
                'santri_id' => 'required', 
                'kategori' => 'required', 
                'alasan' => 'required', 
                'durasi' => 'required', 
                'status' => 'required', 
            ]);
                $entri->santri_id = $request->santri_id;
                $entri->kategori = $request->kategori;
                $entri->alasan = $request->alasan;
                $entri->tujuan = $request->tujuan;
                $entri->status = $request->status;
                $message['message'] = 'Santri berhasil di masukan ke entri izin!';
        }

        $entri->save();

        return response()->json(['response' => $message]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Keamanan::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'santri_id' => 'required', 
            'kategori' => 'required', 
            'alasan' => 'required', 
            'durasi' => 'required', 
            'status' => 'required', 
            // 'pemberi_izin' => 'required'
        ]);

        // $validator = Keamanan::whereSantriId($request->santri_id)
        //                     ->whereKategori($request->kategori)
        //                     ->whereStatus($request->status)
        //                     ->get();
                            
        $entri = Keamanan::findOrFail($id);
        // if (count($validator) > 0) {
        //     $message['message'] = 'Santri tersebut sudah melakukan izin!';
        // }else{
            $entri->santri_id = $request->santri_id;
            $entri->kategori = $request->kategori;
            $entri->alasan = $request->alasan;
            $entri->tujuan = $request->tujuan;
            $entri->status = $request->status;
            $entri->pemberi_izin = $request->pemberi_izin;
            $entri->update();

            $message['message'] = 'Entri Izin Santri berhasil diupdate!';
        // }

        return response()->json(['response' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entri = Keamanan::find($id)->delete();

        return response()->json(['response' => 'success']);
    }
}

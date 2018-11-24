<?php

namespace App\Http\Controllers;

use App\Kobong;
use Illuminate\Http\Request;

class KobongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sekretariat.kobong.kobong');
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
    public function storeJSON(Request $request)
    {
        $this->validate($request, [
            'nama_kobong' => 'required',
            'roisam_kobong' => 'required',
        ]);
        try {
            $kobong = Kobong::create($request->all());
            $data['messageKobong'] = 'Berhasil menambahkan kobong!';
            $data['messageErrorKobong'] = false;
            $data['messageWarningKobong'] = false;
            $data['type'] = 'success';
        } catch (Exception $e) {
            $data['messageKobong'] = false;
            $data['messageErrorKobong'] = 'Terjadi kesalahan!';
            $data['messageWarningKobong'] = false;
            $data['type'] = 'error';
        }
        return response()->json(['response' => $data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kobong' => 'required',
            'roisam_kobong' => 'required',
        ]);
        try {
            $kobong = Kobong::create($request->all());
            $data['messageKobong'] = 'Berhasil menambahkan kobong!';
            $data['messageErrorKobong'] = false;
            $data['messageWarningKobong'] = false;
            $data['type'] = 'success';
        } catch (Exception $e) {
            $data['messageKobong'] = false;
            $data['messageErrorKobong'] = 'Terjadi kesalahan!';
            $data['messageWarningKobong'] = false;
            $data['type'] = 'error';
        }
        // return response()->json(['response' => $data]);
        return back();
    }

    public function storeByAsramaId(Request $request, $id)
    {
     
        $this->validate($request, [
            'nama_kobong' => 'required',
            'roisam_kobong' => 'required',
        ]);
        $kobong = new Kobong();
        $kobong->asrama_id = $id;
        $kobong->nama_kobong = $request->nama_kobong;
        $kobong->roisam_kobong = $request->roisam_kobong;
        $kobong->save();
        $data['messageKobong'] = 'Berhasil menambahkan kobong!';
        $data['messageErrorKobong'] = false;
        $data['messageWarningKobong'] = false;
        $data['type'] = 'success';
        return response()->json(['response' => $data]);
        // return back();   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kobong  $kobong
     * @return \Illuminate\Http\Response
     */
    public function show(Kobong $kobong)
    {
        
    }

    public function showJSON($id)
    {
        return Kobong::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kobong  $kobong
     * @return \Illuminate\Http\Response
     */
    public function edit(Kobong $kobong)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kobong  $kobong
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kobong' => 'required',
            'roisam_kobong' => 'required',
        ]);

        try {
            $kobong = Kobong::find($id)->update($request->all());
            $data['messageKobong'] = 'Berhasil mengedit! kobong!';
            $data['messageErrorKobong'] = false;
            $data['messageWarningKobong'] = false;
            $data['type'] = 'success';
        } catch (Exception $e) {
            $data['messageKobong'] = false;
            $data['messageErrorKobong'] = 'Terjadi kesalahan!';
            $data['messageWarningKobong'] = false;
            $data['type'] = 'error';
        }
        return response()->json(['response' => $data]);
        // return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kobong  $kobong
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kobong = Kobong::find($id)->delete();
        return back();
    }
}

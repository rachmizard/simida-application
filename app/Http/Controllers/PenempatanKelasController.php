<?php

namespace App\Http\Controllers;

use App\Santri;
use Carbon\Carbon;
use App\Http\Resources\SantriYangBelumPunyaKelasResource;
use Illuminate\Http\Request;

class PenempatanKelasController extends Controller
{

	public function penempatankelas()
	{
		return view('pendidikan.penempatankelas.penempatankelas');
	}

    public function listSantri()
    {
        Carbon::setLocale('id');
		return SantriYangBelumPunyaKelasResource::collection(Santri::whereStatus('tidak_aktif')->get());
    }

    public function storePenempatanKelas(Request $request)
    {
    	$this->validate($request, [
    		'santri_id' => 'required',
    		'kelas_id' => 'required',
    		'tingkat_id' => 'required',
    	]);
    	$storePenempatanKelas = Santri::whereIn('id', [$request->santri_id])
    							->update([
    								'kelas_id' => $request->kelas_id,
    								'tingkat_id' => $request->tingkat_id,
    								'status' => 'aktif'
    							]);
    	return response()->json(['response' => 'success']);
    }

    public function oneByOne(Request $request, $id)
    {
    	$oneByOne = Santri::findOrFail($id);
    	$oneByOne->kelas = $request->kelas_id;
    	$oneByOne->tingkat = $request->tingkat_id;
    	$oneByOne->status = 'aktif';
    	$oneByOne->update();

    	return response()->json(['response' => 'success']);
    }
}

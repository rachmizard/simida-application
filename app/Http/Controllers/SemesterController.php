<?php

namespace App\Http\Controllers;

use App\Semester;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendidikan.semester.semester');
    }

    public function getSemesterDataTables(Datatables $datatables)
    {
        return $datatables->of(Semester::query())
                ->addColumn('action', function($var){
                    return '
                    <a href="" class="btn btn-sm btn-info" title="Aktifkan semester"><i class="icon wb-check"></i></a>
                    <a href="" class="btn btn-sm btn-danger" title="Hapus"><i class="icon wb-trash"></i></a>
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
            'tingkat_semester' => 'required',
            'periode_id' => 'required',
        ]);

        $semester = Semester::create([
            'tingkat_semester' => $request->tingkat_semester,
            'periode_id' => $request->periode_id,
            'status' => 'tidak_aktif'
        ]);

        return response()->json(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Semester::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tingkat_semester' => 'required',
            'periode_id' => 'required',
        ]);

        $semester = Semester::find($id)->update([
            'tingkat_semester' => $request->tingkat_semester,
            'periode_id' => $request->periode_id,
            'status' => 'tidak_aktif'
        ]);

        return response()->json(['message' => 'success']);
    }

    public function statusActive($id)
    {
        $default = Semester::whereStatus('aktif')->update(['status' => 'tidak_aktif']);
        if ($default) {
            $setActive = Semester::find($id)->update(['status' => 'aktif']);
        }
        return response()->json(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semester = Semester::find($id)->delete();

        return response()->json(['message' => 'success']);
    }
}

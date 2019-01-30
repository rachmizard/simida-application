<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserLevelController extends Controller
{

    private $model;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(User $user)
    {
        return $this->model = $user;
    }

    public function index()
    {
        $users = $this->model->all();

        return view('admin.user-level', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $user = $this->model->create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'password' => bcrypt($data['password']),
                    'role' => $data['role'],
                    'status' => $data['status'],
                ]);

        return redirect()->back()->with('messageSuccess', 'User akun berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->model->findOrFail($id);
        return view('admin.edit', compact('user'));
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
        $data = $request->all();

        $userId = $this->model->find($id);

        $user = $this->model->find($id)->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'password' => $data['password'] ? bcrypt($data['password']) : $userId->password,
                    'role' => $data['role'],
                    'status' => $data['status'],
                ]);

        return redirect()->back()->with('messageSuccess', 'User akun berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->model->findOrFail($id)->delete();

        return redirect()->back()->with('messageSuccess', 'Akun berhasil dihapus!');
    }
}

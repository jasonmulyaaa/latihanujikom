<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.register.index');
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
        $validate = $request->validate([
            'nik' => 'required|max:16|unique:masyarakat',
            'nama' => 'required|max:36',
            'username' => 'required|max:25',
            'password' => 'required|max:32',
            'telp' => 'required|max:13',
        ]);

        Masyarakat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'telp' => $request->telp,
        ]);

        // User::create([
        //     'nik' => $request->nik,
        //     'nama' => $request->nama,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        //     'telp' => $request->telp,
        //     'role' => 'masyarakat'
        // ])

        return redirect()->route('register.index')->with('success', 'Anda Berhasil Registrasi. Harap Login!');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

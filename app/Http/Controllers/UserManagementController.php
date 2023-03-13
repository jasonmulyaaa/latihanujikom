<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usermanagements = Petugas::where('level', 'petugas')->get();
        return view('admin.usermanagement.index', compact('usermanagements'));
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
            'nama_petugas' => 'required|max:35',
            'username' => 'required|max:25',
            'telp' => 'required|max:13',
            'password' => 'required|max:255',
            'level' => 'required',
        ]);

        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'telp' => $request->telp,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);


        return redirect()->route('usermanagement.index')->with('success', 'Data Berhasil Ditambah!');
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
        $usermanagement = Petugas::find($id);

        return view('admin.usermanagement.edit', compact('usermanagement'));
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
        $rules = ([
            'nama_petugas' => 'required|max:35',
            'username' => 'required|max:25',
            'telp' => 'required|max:13',
            'password',
            'level' => 'required',
        ]);

        $validate = $request->validate($rules);

        if($request['password'] == '')
        {
            $request['password'] == $request['oldPass'];
        }
        else{
            $validate['password'] == bcrypt($request['password']);
        }

        $usermanagement = Petugas::find($id);
        $usermanagement->update($validate);
        return redirect()->route('usermanagement.index')->with('success', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usermanagement = Petugas::find($id);
        $usermanagement->delete();
    return redirect()->route('usermanagement.index')->with('success', 'Berhasil Menghapus Data!');
    }
}

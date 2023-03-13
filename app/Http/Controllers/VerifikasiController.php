<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verifikasis = Pengaduan::where('status', '0')->get();
        return view('admin.verifikasi.index', compact('verifikasis'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $verifikasi = Pengaduan::find($id);
        $nama = Masyarakat::where('nik', $verifikasi->nik)->first();
         return view('admin.verifikasi.show', compact('verifikasi', 'nama'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $verifikasi = Pengaduan::find($id);
        $nama = Masyarakat::where('nik', $verifikasi->nik)->first();
        return view('admin.verifikasi.edit', compact('verifikasi', 'nama'));
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

        $verifikasi = Pengaduan::find($id);
        $verifikasi->status = 'proses';
        $verifikasi->update();
        return redirect()->route('verifikasi.index')->with('success', 'Data Berhasil Diubah!');
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

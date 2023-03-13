<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Auth;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
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

        if(Auth::guard('masyarakat')->check()){

        $validate = $request->validate([
            'isi_laporan' => 'required',
            'foto' => 'image|file|required',
            'status' => 'required',
        ]);

        $image = $request->file('foto')->store('post-images/pengaduan');

        $validate['foto'] = $image;

        // return dd($validate);
                
        $pengaduan = Pengaduan::create([
            'isi_laporan' => $request->isi_laporan,
            'foto' => $validate['foto'],
            'status' => $request->status,
            'tgl_pengaduan' => date('Y-m-d'),
            'nik' => Auth::guard('masyarakat')->user()->nik
        ]);

        return back()->with('success', 'Pengaduan Berhasil Ditambah. Silahkan Periksa Pengaduan Anda di Dashboard!');
    }
    else{
        return view('user.login.index');
    }

    
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

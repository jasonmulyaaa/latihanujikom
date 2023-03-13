<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Pengaduan;
use App\Models\Masyarakat;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Auth;

class ValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $validasis = Pengaduan::where('status', 'proses')->Orwhere('status', 'selesai')->get();
        return view('admin.validasi.index', compact('validasis'));
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
            'tanggapan' => 'required',
            'id_pengaduan'
        ]);

        Tanggapan::create([
            'id_pengaduan' => $request->id_pengaduan,
            'tanggapan' => $request->tanggapan,
            'tgl_tanggapan' => date('Y-m-d'),
            'id_petugas' => Auth::guard('petugas')->user()->id_petugas,
        ]);

        return redirect()->route('validasi.index')->with('success', 'Tanggapan Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $validasi = Pengaduan::find($id);
        $nama = Masyarakat::where('nik', $validasi->nik)->first();
         return view('admin.validasi.show', compact('validasi', 'nama'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $validasi = Pengaduan::find($id);
        $nama = Masyarakat::where('nik', $validasi->nik)->first();
        return view('admin.validasi.edit', compact('validasi', 'nama'));
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
        $validasi = Pengaduan::find($id);
        $validasi->status = 'selesai';
        $validasi->update();
        return redirect()->route('validasi.index')->with('success', 'Data Berhasil Diubah!');
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

    public function generatepdf(){

        $validasi = Pengaduan::all();

        $pdf = PDF::loadview('pdf', compact('validasi'));

        $pdf->setPaper('A4', 'potrait');

        return $pdf->download('pdf_file.pdf');
    }
}

?>

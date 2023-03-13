<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatepdf(){

        $validasis = Pengaduan::all();

        $pdf = PDF::loadview('admin.validasi.pdf', compact('validasis'));

        $pdf->setPaper('A4', 'potrait');

        return $pdf->download('pdf_file.pdf');
    }
}

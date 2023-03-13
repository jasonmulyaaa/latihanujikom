<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $primaryKey = 'id_pengaduan';
    protected $table = 'pengaduan';
    protected $guarded;
    use HasFactory;

    // public function masyarakat()
    // {
    //     return $this->belongsTo('App\Models\Masyarakat', 'nik');
    // }
}

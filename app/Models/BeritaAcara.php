<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_input'; // Primary Key
    public $timestamps = true; // Pastikan timestamps aktif

    protected $fillable = [
        'nama_rapat',
        'tanggal',
        'ruang',
        'jumlah_peserta',
        'hasil_rapat',
    ];
}

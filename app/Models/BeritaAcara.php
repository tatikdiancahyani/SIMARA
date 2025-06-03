<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;
    protected $table = 'berita_acaras';
    protected $primaryKey = 'id_berita_acara'; // Primary Key
    public $timestamps = true; // Pastikan timestamps aktif
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_rapat',
        'tanggal',
        'ruang',
        'jumlah_peserta',
        'hasil_rapat',
        'id_jadwal',
    ];

    public function jadwalRapat()
    {
        return $this->belongsTo(JadwalRapat::class, 'id_jadwal');
    }
}

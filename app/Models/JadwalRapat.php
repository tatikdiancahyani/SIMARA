<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalRapat extends Model
{
    use HasFactory;

    protected $table = 'jadwal_rapats';
    protected $primaryKey = 'id_jadwal';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'judul',
        'tanggal',
        'waktu',
        'tempat',
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function konsumsi()
    {
        return $this->hasOne(Konsumsi::class, 'id_jadwal');
    }

    public function sarpras()
    {
        return $this->hasOne(Sarpras::class, 'id_jadwal');
    }

    public function beritaAcara()
    {
        return $this->hasOne(BeritaAcara::class, 'id_jadwal');
    }
}

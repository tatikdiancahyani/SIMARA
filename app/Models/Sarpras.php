<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
    use HasFactory;

    protected $table = 'sarpras';
    protected $primaryKey = 'id_sarpras';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_sarpras',
        'jumlah',
        'anggaran',
        'harga',
        'pajak',
        'total',
        'id_jadwal',
    ];
    public function jadwal()
    {
        return $this->belongsTo(JadwalRapat::class, 'id_jadwal');
    }
}

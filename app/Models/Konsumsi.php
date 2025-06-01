<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumsi extends Model
{
    use HasFactory;

    protected $table = 'konsumsis';
    protected $primaryKey = 'id_konsumsi';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'jenis_konsumsi',
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
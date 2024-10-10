<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stokBahanBaku extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'kodeBahanBaku',
        'namaBahanBaku',
        'unitBahanBaku',
        'hargaBahanBaku',
        'jumlahBahanBaku',
        'hargaBBperunit',
        'jumlahBBmasuk',
        'jumlahBBKeluar',
        'saldoAkhirBB',
        'jenisBahanBaku',
        'ratarataPemakaian',
        'jumlah_min'
    ];
}

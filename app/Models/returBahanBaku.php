<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returBahanBaku extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaSupplier',
        'kodeBahanBaku',
        'namaBahanBaku',
        'jumlahBahanBaku',
        'hargaRetur',
        'satuanBahanBaku',
        'tanggalRetur',
    ];
}

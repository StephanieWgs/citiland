<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelianBahanBaku extends Model
{
    use HasFactory;
    protected $fillable = [
        'kodeBahanBaku',
        'namaBahanBaku',
        'namaSupplier',
        'jumlahPembelian',
        'unitBB',
        'tanggalPembelian',
        'hargaBB',
        'jenisBahanBaku',
    ];
}

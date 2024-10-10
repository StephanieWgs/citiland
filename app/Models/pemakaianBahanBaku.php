<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemakaianBahanBaku extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'kodeBahanBaku',
        'namaBahanBaku',
        'jumlahPemakaian',
        'unitBB',
        'tanggalPemakaian',
        'jenisBahanBaku'
    ];
}

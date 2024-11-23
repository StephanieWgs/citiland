<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemakaianBahanBaku extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'tanggalPemakaian',
        'kodeBahanBaku',
        'kodeProduksi',
        'jumlahPemakaian',
    ];

    public function produksi()
    {
        return $this->belongsTo(Produksi::class);
    }
}

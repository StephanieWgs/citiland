<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggalProduksi',
        'kodeProduksi',
        'namaBarang',
    ];

    public function pemakaian()
    {
        return $this->hasMany(PemakaianBahanBaku::class, 'kodeProduksi', 'kodeProduksi');
    }
}

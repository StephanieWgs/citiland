<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelianBahanBaku extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggalPembelian',
        'kodeSupplier',
        'kodeBahanBaku',
        'jumlahPembelian',
        'hargaBB',
        'totalHarga',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->totalHarga = $model->hitungTotalHarga();
        });
    }

    public function hitungTotalHarga()
    {
        return $this->jumlahPembelian * $this->hargaBB;
    }
}

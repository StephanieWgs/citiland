<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returBahanBaku extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggalRetur',
        'referensi',
        'kodeBahanBaku',
        'jumlahRetur',
        'alasan',
    ];

    protected static function boot()
    {
        parent::boot();

        // Tambah stok & update harga
        static::created(function ($model) {
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();
            if ($bahanBaku) {
                $bahanBaku->jumlahBahanBaku -= $model->jumlahRetur;
                $bahanBaku->save();
            }
        });
    }

    public function pembelian()
    {
        return $this->belongsTo(pembelianBahanBaku::class, 'referensi', 'noInv');
    }
}

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
        'kodeProduksi',
        'jumlahPemakaian',
    ];

    protected static function boot()
    {
        parent::boot();

        // Kurangi stok
        static::created(function ($model) {
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();
            if ($bahanBaku) {
                $bahanBaku->jumlahBahanBaku -= $model->jumlahPemakaian;
                $bahanBaku->save();
            }
        });
    }

    public function produksi()
    {
        return $this->belongsTo(Produksi::class, 'kodeProduksi', 'kodeProduksi');
    }

    public function bahanBaku()
    {
        return $this->belongsTo(stokBahanBaku::class, 'kodeBahanBaku', 'kodeBahanBaku');
    }
}

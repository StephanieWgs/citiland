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

        // Kurangi stok jika retur
        static::created(function ($model) {
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();
            if ($bahanBaku) {
                $bahanBaku->jumlahBahanBaku -= $model->jumlahRetur;
                $bahanBaku->save();
            }
        });

        //jika data di edit
        static::updating(function ($model) {
            $original = $model->getOriginal();
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();

            if ($bahanBaku) {
                // Kembalikan stok lama sebelum ada retur
                $bahanBaku->jumlahBahanBaku += $original['jumlahRetur'];
                // Kurangi stok baru berdasarkan jumlah retur yang diedit
                $bahanBaku->jumlahBahanBaku -= $model->jumlahRetur;
                $bahanBaku->save();
            }
        });

        // Tambahkan kembali stok ketika data retur dihapus, berarti salah input dan stok bertambah
        static::deleting(function ($model) {
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();
            if ($bahanBaku) {
                $bahanBaku->jumlahBahanBaku += $model->jumlahRetur;
                $bahanBaku->save();
            }
        });
    }

    public function pembelian()
    {
        return $this->belongsTo(pembelianBahanBaku::class, 'referensi', 'noInv');
    }
}

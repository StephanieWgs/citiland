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

        // Kurangi stok ketika diinput
        static::created(function ($model) {
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();
            if ($bahanBaku) {
                $bahanBaku->jumlahBahanBaku -= $model->jumlahPemakaian;
                $bahanBaku->save();
            }
        });

        //jika data di edit
        static::updating(function ($model) {
            $original = $model->getOriginal();
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();

            if ($bahanBaku) {
                // Kembalikan stok lama sebelum ada jumlah pemakaian
                $bahanBaku->jumlahBahanBaku += $original['jumlahPemakaian'];
                // Kurangi stok baru berdasarkan jumlah pemakaian yang diedit
                $bahanBaku->jumlahBahanBaku -= $model->jumlahPemakaian;
                $bahanBaku->save();
            }
        });

        // Tambahkan kembali stok ketika data pemakaian dihapus, berarti salah input dan stok bertambah
        static::deleting(function ($model) {
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();
            if ($bahanBaku) {
                $bahanBaku->jumlahBahanBaku += $model->jumlahPemakaian;
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelianBahanBaku extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggalPembelian',
        'noInv',
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

        // Tambah stok & update harga
        static::created(function ($model) {
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();
            if ($bahanBaku) {
                $bahanBaku->jumlahBahanBaku += $model->jumlahPembelian;
                $bahanBaku->hargaBBperunit = $model->hargaBB;
                $bahanBaku->save();
            }
        });

        //jika data di edit
        static::updating(function ($model) {
            $original = $model->getOriginal();
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();

            if ($bahanBaku) {
                // Kembalikan stok lama sebelum ada pembelian
                $bahanBaku->jumlahBahanBaku -= $original['jumlahPembelian'];
                // Tambah stok baru berdasarkan jumlah pembelian yang diedit
                $bahanBaku->jumlahBahanBaku += $model->jumlahPembelian;
                $bahanBaku->save();
            }
        });

        // Kurangi kembali stok ketika data pembelian dihapus, berarti salah input dan stok berkurang
        static::deleting(function ($model) {
            $bahanBaku = stokBahanBaku::where('kodeBahanBaku', $model->kodeBahanBaku)->first();
            if ($bahanBaku) {
                $bahanBaku->jumlahBahanBaku -= $model->jumlahPembelian;
                $bahanBaku->save();
            }
        });
    }

    public function hitungTotalHarga()
    {
        return $this->jumlahPembelian * $this->hargaBB;
    }

    public function bahanBaku()
    {
        return $this->belongsTo(stokBahanBaku::class, 'kodeBahanBaku', 'kodeBahanBaku');
    }

    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'kodeSupplier', 'kodeSupplier');
    }

    public function retur()
    {
        return $this->hasMany(returBahanBaku::class, 'referensi', 'noInv');
    }
}

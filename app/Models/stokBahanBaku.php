<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stokBahanBaku extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'kodeBahanBaku',
        'namaBahanBaku',
        'jenisBahanBaku',
        'jumlahBahanBaku',
        'unitBahanBaku',
        'hargaBBperunit',
        'maxLeadTime',
        'ratarataLeadTime',
        'maxBBKeluar',
        'ratarataPemakaian',
        'safetyStock',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->safetyStock = $model->hitungSafetyStock();
            $model->status = $model->statusStock();
        });
    }

    const STATUS_SAFE = "Safe";
    const STATUS_NEED_RESTOCK = "Need Restock";
    const STATUS_OUT_OF_STOCK = "Out of Stock";

    public function hitungSafetyStock()
    {
        $safetyStock = ($this->maxLeadTime * $this->maxBBKeluar) - ($this->ratarataLeadTime * $this->ratarataPemakaian);

        return max(0, $safetyStock);
    }

    public function statusStock()
    {
        $this->safetyStock = $this->hitungSafetyStock();

        if ($this->jumlahBahanBaku > $this->safetyStock) {
            return self::STATUS_SAFE;
        } elseif ($this->jumlahBahanBaku < $this->safetyStock && $this->jumlahBahanBaku > 0) {
            return self::STATUS_NEED_RESTOCK;
        } elseif ($this->jumlahBahanBaku == 0) {
            return self::STATUS_OUT_OF_STOCK;
        }

        return self::STATUS_NEED_RESTOCK; // Default case
    }
}

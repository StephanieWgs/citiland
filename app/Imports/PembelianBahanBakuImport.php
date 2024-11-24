<?php

namespace App\Imports;

use App\Models\PembelianBahanBaku;
use Maatwebsite\Excel\Concerns\ToModel;

class PembelianBahanBakuImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $rowCount = 0;
    public function model(array $row)
    {
        if ($this->rowCount++ > 0 && isset($row[0])) {
            return new PembelianBahanBaku([
                //table - excel
                'tanggalPembelian' => $row['tanggalpembelian'],
                'noInv' => $row['noinv'],
                'kodeSupplier' => $row['kodesupplier'],
                'kodeBahanBaku' => $row['kodebahanbaku'],
                'jumlahPembelian' => $row['jumlahpembelian'],
                'hargaBB' => $row['hargabb'],
                'totalHarga' => $row['totalharga'],
            ]);
        } else {
            return null;
        };
    }
}

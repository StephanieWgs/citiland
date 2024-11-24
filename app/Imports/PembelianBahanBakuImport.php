<?php

namespace App\Imports;

use App\Models\PembelianBahanBaku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PembelianBahanBakuImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $rowCount = 1;
    public function model(array $row)
    {
        $this->rowCount++;
        if ($this->rowCount > 1) {
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

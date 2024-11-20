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
                'kodeBahanBaku' => $row['kodebahanbaku'],
                'namaBahanBaku' => $row['namabahanbaku'],
                'namaSupplier' => $row['namasupplier'],
                'jumlahPembelian' => $row['jumlahpembelian'],
                'unitBB' => $row['unitbb'],
                'tanggalPembelian' => $row['tanggalpembelian'],
                'hargaBB' => $row['hargabb'],
                'jenisBahanBaku' => $row['jenisbahanbaku'],
            ]);
        } else {
            return null;
        };
    }
}

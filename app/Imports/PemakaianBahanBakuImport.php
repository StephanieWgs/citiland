<?php

namespace App\Imports;

use App\Models\PemakaianBahanBaku;
use Maatwebsite\Excel\Concerns\ToModel;

class PemakaianBahanBakuImport implements ToModel
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
            return new pemakaianBahanBaku([
                //table - excel
                'kodeBahanBaku' => $row['kodebahanbaku'],
                'namaBahanBaku' => $row['namabahanbaku'],
                'jumlahPemakaian' => $row['jumlahpemakaian'],
                'unitBB' => $row['unitbb'],
                'tanggalPemakaian' => $row['tanggalpemakaian'],
                'jenisBahanBaku' => $row['jenisbahanbaku'],
            ]);
        } else {
            return null;
        };
    }
}

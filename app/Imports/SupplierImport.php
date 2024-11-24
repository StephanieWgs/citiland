<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierImport implements ToModel, WithHeadingRow
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
            return new supplier([
                //table - excel
                'kodeSupplier' => $row['kodesupplier'],
                'namaSupplier' => $row['nama'],
                'nomorHpSupplier' => $row['nohp'],
                'alamatSupplier' => $row['alamat'],
            ]);
        } else {
            return null;
        };
    }
}

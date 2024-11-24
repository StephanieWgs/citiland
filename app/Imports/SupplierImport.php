<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;

class SupplierImport implements ToModel
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

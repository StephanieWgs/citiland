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
                'kodesupplier' => $row['kodesupplier'],
                'namasupplier' => $row['nama'],
                'nomorHPsupplier' => $row['nohp'],
                'alamatsupplier' => $row['alamat'],
            ]);
        } else {
            return null;
        };
    }
}

<?php

namespace App\Imports;

use App\Models\Gudang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GudangImport implements ToModel, WithHeadingRow
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
            return new gudang([
                //table - excel
                'nama' => $row['nama'],
                'noHp' => $row['nohp'],
                'email' => $row['email'],
            ]);
        } else {
            return null;
        };
    }
}

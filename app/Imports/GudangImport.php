<?php

namespace App\Imports;

use App\Models\Gudang;
use Maatwebsite\Excel\Concerns\ToModel;

class GudangImport implements ToModel
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

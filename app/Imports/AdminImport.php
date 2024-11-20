<?php

namespace App\Imports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\ToModel;

class AdminImport implements ToModel
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
            return new admin([
                //table - excel
                'nama' => $row['nama'],
                'noHP' => $row['nohp'],
                'email' => $row['email'],
            ]);
        } else {
            return null;
        };
    }
}

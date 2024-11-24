<?php

namespace App\Imports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdminImport implements ToModel, WithHeadingRow
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
            return new admin([
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

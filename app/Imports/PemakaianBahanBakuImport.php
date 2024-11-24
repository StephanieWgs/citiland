<?php

namespace App\Imports;

use App\Models\PemakaianBahanBaku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PemakaianBahanBakuImport implements ToModel, WithHeadingRow
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
            return new pemakaianBahanBaku([
                //table - excel
                'kodeBahanBaku' => $row['kodebahanbaku'],
                'kodeProduksi' => $row['kodeproduksi'],
                'jumlahPemakaian' => $row['jumlahpemakaian'],
            ]);
        } else {
            return null;
        };
    }
}

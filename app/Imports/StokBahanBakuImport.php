<?php

namespace App\Imports;

use App\Models\StokBahanBaku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StokBahanBakuImport implements ToModel, WithHeadingRow
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
            return new StokBahanBaku([
                // Log::info('Row Data:', $row);
                //table - excel
                'kodeBahanBaku' => $row['kodebahanbaku'],
                'namaBahanBaku' => $row['namabahanbaku'],
                'jenisBahanBaku' => $row['jenisbahanbaku'],
                'jumlahBahanBaku' => $row['jumlahbahanbaku'],
                'unitBahanBaku' => $row['unitbahanbaku'],
                'hargaBBperunit' => $row['hargabbperunit'],
                'maxLeadTime' => $row['maxleadtime'],
                'ratarataLeadTime' => $row['ratarataleadtime'],
                'maxBBKeluar' => $row['maxbbkeluar'],
                'ratarataPemakaian' => $row['rataratapemakaian'],
                'safetyStock' => $row['safetystock'],
                'status' => $row['status'],
            ]);
        } else {
            return null;
        };
    }
}

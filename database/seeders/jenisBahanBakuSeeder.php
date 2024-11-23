<?php

namespace Database\Seeders;

use App\Models\jenisBahanBaku;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class jenisBahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisBahanBaku = new jenisBahanBaku();
        $jenisBahanBaku->jenisBahanBaku = 'Kayu';
        $jenisBahanBaku->save();

        $jenisBahanBaku = new jenisBahanBaku();
        $jenisBahanBaku->jenisBahanBaku = 'Logam';
        $jenisBahanBaku->save();

        $jenisBahanBaku = new jenisBahanBaku();
        $jenisBahanBaku->jenisBahanBaku = 'Kain';
        $jenisBahanBaku->save();

        $jenisBahanBaku = new jenisBahanBaku();
        $jenisBahanBaku->jenisBahanBaku = 'Kaca';
        $jenisBahanBaku->save();

        $jenisBahanBaku = new jenisBahanBaku();
        $jenisBahanBaku->jenisBahanBaku = 'Batu';
        $jenisBahanBaku->save();

        $jenisBahanBaku = new jenisBahanBaku();
        $jenisBahanBaku->jenisBahanBaku = 'Cat';
        $jenisBahanBaku->save();

        $jenisBahanBaku = new jenisBahanBaku();
        $jenisBahanBaku->jenisBahanBaku = 'Aksesoris';
        $jenisBahanBaku->save();
    }
}

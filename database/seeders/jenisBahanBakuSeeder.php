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
        // $faker = Faker::create('id_ID');
        // for ($i = 1; $i <= 5; $i++) {
        //     DB::table('jenis_bahan_bakus')->insert([
        //         'kodeBahanBaku' => 'BHN' . str_pad($i, 7, '0', STR_PAD_LEFT),
        //         'jenisBahanBaku' => 'Kayu',
        //     ]);
        // }

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

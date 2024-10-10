<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class stokBahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 5; $i++) {
            DB::table('stok_bahan_bakus')->insert([
                'kodeBahanBaku' => 'BB' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'namaBahanBaku' => $faker->word,
                'unitBahanBaku' => '10m^3',
                'hargaBahanBaku' => $faker->numberBetween(10000, 100000),
                'jumlahBahanBaku' => $faker->numberBetween(1, 10),
                'hargaBBperunit' => $faker->numberBetween(100, 10000),
                'jumlahBBmasuk' =>  $faker->numberBetween(1, 10),
                'jumlahBBKeluar' =>  $faker->numberBetween(0, 1),
                'saldoAkhirBB' =>  $faker->numberBetween(10000, 100000),
                'jenisBahanBaku' => 'Kayu',
                'ratarataPemakaian' => $faker->numberBetween(1, 10),
                'jumlah_min' => $faker->numberBetween(10, 50),
            ]);
        }
    }
}

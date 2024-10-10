<?php

namespace Database\Seeders;

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
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 5; $i++) {
            DB::table('jenis_bahan_bakus')->insert([
                'kodeBahanBaku' => 'BHN' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'jenisBahanBaku' => 'Kayu',
            ]);
        }
    }
}

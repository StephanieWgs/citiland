<?php

namespace Database\Seeders;

use App\Models\produksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class produksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produksi = new produksi();
        $produksi->kodeProduksi = 'PRO001';
        $produksi->namaBarang = 'Meja';
        $produksi->tanggalProduksi = '2024-11-01';
        $produksi->save();

        $produksi = new produksi();
        $produksi->kodeProduksi = 'PRO002';
        $produksi->namaBarang = 'Kursi';
        $produksi->tanggalProduksi = '2024-11-05';
        $produksi->save();

        $produksi = new produksi();
        $produksi->kodeProduksi = 'PRO003';
        $produksi->namaBarang = 'Lemari';
        $produksi->tanggalProduksi = '2024-11-10';
        $produksi->save();
    }
}

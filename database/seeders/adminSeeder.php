<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 3; $i++) {
            DB::table('admins')->insert([
                'nama' => $faker->name,
                'noHP' => '08' . mt_rand(100000000, 9999999999),
                'email' => $faker->email,
            ]);
        }
    }
}

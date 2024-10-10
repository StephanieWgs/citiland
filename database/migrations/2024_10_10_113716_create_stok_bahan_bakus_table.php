<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stok_bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->char('kodeBahanBaku', length: 10);
            $table->char('namaBahanBaku', length: 100);
            $table->char('unitBahanBaku', length: 5);
            $table->char('hargaBahanBaku', length: 30);
            $table->char('jumlahBahanBaku', length: 10);
            $table->char('hargaBBperunit', length: 50);
            $table->char('jumlahBBmasuk', length: 10);
            $table->char('jumlahBBKeluar', length: 10);
            $table->char('jsaldoAkhirBB', length: 50);
            $table->char('juenisBahanBaku', length: 5);
            $table->char('ratarataPemakaian', length: 25);
            $table->char('jumlah_min', length: 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_bahan_bakus');
    }
};

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
        Schema::create('pemakaian_bahan_bakus', function (Blueprint $table) {
            $table->id()->primary();
            $table->char("kodeBahanBaku", length: 10);
            // $table->char("namaBahanBaku", length: 100);
            $table->char("jumlahPemakaian", length: 20);
            // $table->char("unitBB", length: 5);
            $table->date("tanggalPemakaian");
            // $table->char("jenisBahanBaku", length: 5);
            $table->timestamps();

            $table->foreign('kodeBahanBaku')->references('kodeBahanBaku')->on('stok_bahan_bakus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaian_bahan_bakus');
    }
};

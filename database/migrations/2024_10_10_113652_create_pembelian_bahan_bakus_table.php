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
        Schema::create('pembelian_bahan_bakus', function (Blueprint $table) {
            $table->id()->primary();
            $table->char("kodeBahanBaku", length: 10);
            // $table->char("namaBahanBaku", length: 100);
            $table->integer("jumlahPembelian");
            // $table->char("unitBB", length: 100);
            // $table->char("namaSupplier", length: 40);
            $table->char("kodeSupplier", length:10);
            $table->char("hargaBB", length: 25);
            $table->datetime("tanggalPembelian");
            $table->char("jenisBahanBaku", length: 5);
            $table->timestamps();

            $table->foreign('kodeBahanBaku')->references('kodeBahanBaku')->on('stok_bahan_bakus');
            $table->foreign('kodeSupplier')->references('kodeSupplier')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_bahan_bakus');
    }
};

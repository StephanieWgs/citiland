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
        Schema::create('retur_bahan_bakus', function (Blueprint $table) {
            $table->id();            
            $table->date("tanggalRetur");
            $table->char("kodeSupplier", length: 10);
            $table->char("kodeBahanBaku", length: 10);
            $table->integer("jumlahBahanBaku");
            $table->timestamps();

            // Foreign keys
            $table->foreign('kodeBahanBaku')->references('kodeBahanBaku')->on('stok_bahan_bakus');
            $table->foreign('kodeSupplier')->references('kodeSupplier')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur_bahan_bakus');
    }
};
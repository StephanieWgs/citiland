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
            $table->char("referensi", length: 50);
            $table->char("kodeBahanBaku", length: 10);
            $table->integer("jumlahRetur");
            $table->text("alasan");
            $table->timestamps();

            // Foreign keys
            $table->foreign('kodeBahanBaku')->references('kodeBahanBaku')->on('stok_bahan_bakus');
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

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
            $table->id();
            $table->char('kodeBahanBaku', 6);
            $table->char('kodeProduksi'); 
            $table->integer('jumlahPemakaian'); 
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('kodeBahanBaku')->references('kodeBahanBaku')->on('stok_bahan_bakus')->onDelete('cascade');
            $table->foreign('kodeProduksi')->references('kodeProduksi')->on('produksis')->onDelete('cascade');
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

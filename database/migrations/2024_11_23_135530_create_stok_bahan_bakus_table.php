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
            $table->char('kodeBahanBaku', length: 6)->unique();
            $table->char('namaBahanBaku', length: 100);
            $table->char("jenisBahanBaku", length: 5);
            $table->integer('jumlahBahanBaku');
            $table->char('unitBahanBaku', length: 12);
            $table->integer('hargaBBperunit');

            $table->integer('maxLeadTime');
            $table->integer('ratarataLeadTime');
            $table->integer('maxBBKeluar');
            $table->integer('ratarataPemakaian');

            $table->integer('safetyStock');
            $table->char('status', length: 12);
            $table->timestamps();

            // Foreign key
            $table->foreign('jenisBahanBaku')->references('jenisBahanBaku')->on('jenis_bahan_bakus');
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

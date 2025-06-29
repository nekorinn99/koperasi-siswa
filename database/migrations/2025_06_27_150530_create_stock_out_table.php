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
        Schema::create('stock_out', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah_pack');
            $table->integer('jumlah_pcs');
            $table->text('keterangan')->nullable(); // bisa isi: terjual, rusak,dipakai,dll
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_out');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['pemasukan', 'pengeluaran']);
            $table->date('tanggal');
            $table->string('nama_vendor')->nullable(); // hanya untuk pengeluaran
            $table->string('no_faktur')->nullable();   // terhubung ke faktur pembelian
            $table->decimal('jumlah', 15, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};

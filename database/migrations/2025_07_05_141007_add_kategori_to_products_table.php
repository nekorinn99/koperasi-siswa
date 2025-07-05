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
        Schema::table('products', function (Blueprint $table) {
            $table->enum('kategori', [
                'makanan_ringan',
                'minuman',
                'alat_tulis',
                'buku',
                'seragam',
                'kebersihan',
                'aksesoris',
                'makanan_berat',
            ])
            ->change()
            ->nullable() // or default('makanan_ringan')  
            ->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};

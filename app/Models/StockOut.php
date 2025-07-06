<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\FinancialTransaction;

class StockOut extends Model
{
    protected $fillable = [
        'tanggal',
        'product_id',
        'jumlah_pack',
        'jumlah_pcs',
        'keterangan',
    ];
    protected static function booted()
{
    static::created(function ($stockOut) {
        // Pastikan relasi 'product' dimuat
        $stockOut->loadMissing('product');

       // Ambil harga jual dari produk
       $hargaJual = $stockOut->product->harga_jual ?? 0;

       // Hitung total dari jumlah pack dan harga jual per pack
       $total = $stockOut->jumlah_pack * $hargaJual;

        // Jika total lebih dari 0, buat transaksi
        if ($total > 0) {
            FinancialTransaction::create([
                'tipe' => 'pemasukan',
                'jumlah' => $total,
                'tanggal' => now(),
                'keterangan' => 'Penjualan produk: ' . $stockOut->product->nama,
                'stock_out_id' => $stockOut->id,
            ]);
        }
    });
}


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}



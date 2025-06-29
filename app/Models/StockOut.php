<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockOut extends Model
{
    protected $fillable = [
        'tanggal',
        'product_id',
        'jumlah_pack',
        'jumlah_pcs',
        'keterangan',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}



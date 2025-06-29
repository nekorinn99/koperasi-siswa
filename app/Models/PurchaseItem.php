<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'jumlah_pack',
        'jumlah_pcs',
        'harga_beli',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    
}



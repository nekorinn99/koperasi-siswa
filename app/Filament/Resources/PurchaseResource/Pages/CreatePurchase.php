<?php

namespace App\Filament\Resources\PurchaseResource\Pages;

use App\Filament\Resources\PurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\FinancialTransaction;

class CreatePurchase extends CreateRecord
{
    protected static string $resource = PurchaseResource::class;
    protected function afterCreate(): void
    {
        $purchase = $this->record;

        $total = $purchase->items->sum(function ($item) {
            return $item->jumlah_pack * $item->harga_beli;
        });

        FinancialTransaction::create([
            'tipe' => 'pengeluaran',
            'jumlah' => $total,
            'tanggal' => now(),
            'keterangan' => 'Pembelian barang - No Faktur: ' . $purchase->no_faktur,
            'purchase_id' => $purchase->id,
        ]);
    }
}

<?php

namespace App\Filament\Resources\PurchaseResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PurchaseResource;

class ListPurchases extends ListRecords
{
    protected static string $resource = PurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getTableQuery(): Builder
    {
        // Eager load vendor dan items beserta product-nya
        return parent::getTableQuery()->with([
            'vendor',
            'items.product',
        ]);
    }
}

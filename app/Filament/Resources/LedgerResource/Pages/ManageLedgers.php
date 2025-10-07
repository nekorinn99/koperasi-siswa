<?php

namespace App\Filament\Resources\LedgerResource\Pages;

use Filament\Forms;
use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\LedgerResource;
use Filament\Resources\Pages\ManageRecords;

class ManageLedgers extends ManageRecords
{
    protected static string $resource = LedgerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make('tambahPemasukan')
                ->label('Tambah Pemasukan')
                ->form(fn (Forms\Form $form) => LedgerResource::formPemasukan($form))
                ->mutateFormDataUsing(fn (array $data) => array_merge($data, ['tipe' => 'pemasukan'])),

            CreateAction::make('tambahPengeluaran')
                ->label('Tambah Pengeluaran')
                ->form(fn (Forms\Form $form) => LedgerResource::formPengeluaran($form))
                ->mutateFormDataUsing(fn (array $data) => array_merge($data, ['tipe' => 'pengeluaran'])),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'pemasukan' => Tab::make('Pemasukan')->query(fn($query) => $query->where('tipe', 'pemasukan')),
            'pengeluaran' => Tab::make('Pengeluaran')->query(fn($query) => $query->where('tipe', 'pengeluaran')),
        ];
    }
}

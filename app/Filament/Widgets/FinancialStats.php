<?php

namespace App\Filament\Widgets;

use App\Models\FinancialTransaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinancialStats extends BaseWidget
{
    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 12;
    protected function getStats(): array
    {
        $pemasukan = FinancialTransaction::where('tipe', 'pemasukan')->sum('jumlah');
        $pengeluaran = FinancialTransaction::where('tipe', 'pengeluaran')->sum('jumlah');
        $saldo = $pemasukan - $pengeluaran;

        return [
            Stat::make('Saldo Sekarang', 'Rp ' . number_format($saldo, 0, ',', '.'))
                ->description('Pemasukan - Pengeluaran')
                ->color('primary'),
            Stat::make('Total Pemasukan', 'Rp ' . number_format($pemasukan, 0, ',', '.'))
                ->description('Uang masuk')
                ->color('success'),

            Stat::make('Total Pengeluaran', 'Rp ' . number_format($pengeluaran, 0, ',', '.'))
                ->description('Uang keluar')
                ->color('danger'),

            
        ];
    }
}

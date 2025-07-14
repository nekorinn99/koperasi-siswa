<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\FinancialTransaction;
use Carbon\Carbon;

class SaldoChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Saldo Harian Koperasi';

    protected int | string | array $columnSpan = 6;

    protected function getData(): array
    {
        $transactions = FinancialTransaction::select(['tanggal', 'tipe', 'jumlah'])
            ->orderBy('tanggal')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->tanggal)->format('d-m-Y');
            });

        $saldo = 0;
        $labels = [];
        $values = [];

        foreach ($transactions as $tanggal => $harian) {
            foreach ($harian as $transaksi) {
                if ($transaksi->tipe === 'pemasukan') {
                    $saldo += $transaksi->jumlah;
                } elseif ($transaksi->tipe === 'pengeluaran') {
                    $saldo -= $transaksi->jumlah;
                }
            }

            $labels[] = $tanggal;
            $values[] = $saldo;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Saldo (Rp)',
                    'data' => $values,
                    'fill' => true,
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

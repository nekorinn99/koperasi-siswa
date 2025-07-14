<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\FinancialTransaction;

class PemasukanChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pemasukan Harian';

    protected int | string | array $columnSpan = 8;

    protected function getData(): array
    {
        $data = FinancialTransaction::where('tipe', 'pemasukan')
            ->selectRaw("strftime('%Y-%m-%d', tanggal) as hari, sum(jumlah) as total")
            ->groupBy('hari')
            ->orderBy('hari')
            ->pluck('total', 'hari');

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan (Rp)',
                    'data' => $data->values(),
                    'fill' => true, // ⬅️ TAMBAHKAN INI
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)', // Bayangan lembut hijau
                    'tension' => 0.4, // Opsional: bikin garis lebih halus/melengkung
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

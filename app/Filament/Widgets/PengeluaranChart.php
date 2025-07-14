<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Purchase;
use Illuminate\Support\Carbon;

class PengeluaranChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pengeluaran Harian Koperasi';

    protected int | string | array $columnSpan = 4;

    protected function getData(): array
    {
        $data = Purchase::selectRaw("tanggal, sum(purchase_items.jumlah_pack * purchase_items.harga_beli) as total")
            ->join('purchase_items', 'purchases.id', '=', 'purchase_items.purchase_id')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    Carbon::parse($item->tanggal)->format('d-m-Y') => $item->total,
                ];
            });

        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran (Rp)',
                    'data' => $data->values(),
                    'borderColor' => '#EF4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)', // bayangan lembut di bawah garis
                    'fill' => true,
                    'tension' => 0.4, // garis sedikit melengkung
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FinancialTransaction;
use App\Models\Category;
use App\Models\Vendor;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\StockOut;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total keuntungan dari transaksi keuangan
        $totalPemasukan = FinancialTransaction::where('tipe', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = FinancialTransaction::where('tipe', 'pengeluaran')->sum('jumlah');
        $totalKeuntungan = $totalPemasukan - $totalPengeluaran;

        // Hitung total produk
        $totalProduk = Product::count();

        // Hitung total vendor
        $totalVendor = Vendor::count();

        // Hitung Total Pemasukan
        $data = FinancialTransaction::where('tipe', 'pemasukan')->sum('jumlah');

        // Hitung Total Pengeluaran
        $pengeluaran = FinancialTransaction::where('tipe', 'pengeluaran')->sum('jumlah');

        // Ambil kategori terlaris berdasarkan jumlah item yang dibeli
        $kategoriTerlaris = Product::withCount('purchaseItems')
            ->orderByDesc('purchase_items_count')
            ->first();

        // Data untuk chart penjualan 6 bulan terakhir (default)
        $monthlyChartData = $this->getMonthlyChartData();

        // Data untuk chart penjualan harian (30 hari terakhir)
        $dailyChartData = $this->getDailyChartData();

        return view('dashboard', [
            'totalKeuntungan' => $totalKeuntungan,
            'totalProduk' => $totalProduk,
            'totalVendor' => $totalVendor,
            'kategoriTerlaris' => $kategoriTerlaris,
            'monthlyChartData' => $monthlyChartData,
            'dailyChartData' => $dailyChartData,
            'chartData' => $monthlyChartData['data'],
            'chartLabels' => $monthlyChartData['labels'],
            'data' => $data,
            'pengeluaran' => $pengeluaran,
        ]);
    }

    private function getMonthlyChartData()
    {
        $chartData = [];
        $chartLabels = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthName = $month->format('F Y');

            $monthlyTotal = PurchaseItem::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->get()
                ->sum(function ($item) {
                    return ($item->harga_beli * $item->jumlah_pack) +
                        ($item->harga_beli * $item->jumlah_pcs);
                });

            $chartLabels[] = $monthName;
            $chartData[] = $monthlyTotal;
        }

        return [
            'labels' => $chartLabels,
            'data' => $chartData
        ];
    }

    private function getDailyChartData()
    {
        $chartData = [];
        $chartLabels = [];

        // Ambil data 30 hari terakhir
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dayLabel = $date->format('d M'); // Format: "01 Jun"

            // Hitung total penjualan harian
            $dailyTotal = PurchaseItem::whereDate('created_at', $date->toDateString())
                ->get()
                ->sum(function ($item) {
                    return ($item->harga_beli * $item->jumlah_pack) +
                        ($item->harga_beli * $item->jumlah_pcs);
                });

            $chartLabels[] = $dayLabel;
            $chartData[] = $dailyTotal;
        }

        return [
            'labels' => $chartLabels,
            'data' => $chartData
        ];
    }
}

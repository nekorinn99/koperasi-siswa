<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FinancialTransaction;


class DashboardController extends Controller
{
    public function index()
    {
        // Contoh data dummy, nanti bisa kamu sesuaikan
        $totalKeuntungan = FinancialTransaction::where('tipe', 'pemasukan')->sum('jumlah') 
                          - FinancialTransaction::where('tipe', 'pengeluaran')->sum('jumlah');

        $kategoriTerlaris = Product::withCount('purchaseItems')
                                ->orderByDesc('purchase_items_count')
                                ->take(5)
                                ->get();

        return view('dashboard', [
            'totalKeuntungan' => $totalKeuntungan,
            'kategoriTerlaris' => $kategoriTerlaris,
        ]);
    }
}


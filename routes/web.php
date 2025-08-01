<?php

use Illuminate\Support\Facades\Route;
use App\Models\FinancialTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/preview-financial-transactions', function (\Illuminate\Http\Request $request) {
    $transactions = FinancialTransaction::whereBetween('tanggal', [
        $request->start,
        $request->end,
    ])->get();

    $pdf = Pdf::loadView('exports.financial-transactions', [
        'transactions' => $transactions,
        'start' => $request->start,
        'end' => $request->end,
    ]);

    return $pdf->stream('preview.pdf');
})->name('preview.financial-transactions');
<?php

namespace App\Filament\Resources\FinancialTransactionResource\Pages;

use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\FinancialTransactionResource;
use App\Filament\Widgets\FinancialStats;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FinancialTransaction;

class ListFinancialTransactions extends ListRecords
{
    protected static string $resource = FinancialTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('export_pdf')
                ->label('Export PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->form([
                    Forms\Components\DatePicker::make('start_date')
                        ->label('Tanggal Mulai')
                        ->required(),
                    Forms\Components\DatePicker::make('end_date')
                        ->label('Tanggal Selesai')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $transactions = FinancialTransaction::whereBetween('tanggal', [
                        $data['start_date'],
                        $data['end_date'],
                    ])->get();

                    $pdf = Pdf::loadView('exports.financial-transactions', [
                        'transactions' => $transactions,
                        'start' => $data['start_date'],
                        'end' => $data['end_date'],
                    ]);

                    return response()->streamDownload(
                        fn () => print($pdf->output()),
                        'financial-transactions.pdf'
                    );
                }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            FinancialStats::class,
        ];
    }
}

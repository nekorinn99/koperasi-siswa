<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FinancialTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class FinancialTransactionExportPreview extends Component
{
    public $start_date;
    public $end_date;
    public $previewUrl;

    public function updated($field)
    {
        if ($this->start_date && $this->end_date) {
            $this->generatePreview();
        }
    }

    public function generatePreview()
    {
        $transactions = FinancialTransaction::whereBetween('tanggal', [
            $this->start_date,
            $this->end_date,
        ])->get();

        $pdf = Pdf::loadView('exports.financial-transactions', [
            'transactions' => $transactions,
            'start' => $this->start_date,
            'end' => $this->end_date,
        ]);

        $fileName = 'preview-' . now()->timestamp . '.pdf';
        Storage::disk('public')->put('pdf-previews/'.$fileName, $pdf->output());
        $this->previewUrl = Storage::url('pdf-previews/'.$fileName);
    }

    public function downloadPdf()
    {
        return response()->streamDownload(
            fn () => print(file_get_contents(storage_path('app/public/' . str_replace('/storage/', '', $this->previewUrl)))),
            'financial-transactions.pdf'
        );
    }

    public function render()
    {
        return view('livewire.financial-transaction-export-preview');
    }
}

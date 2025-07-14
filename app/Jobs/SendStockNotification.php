<?php
namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\StockAlertNotification;

use App\Models\User;

class SendStockNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $products = Product::all();
        foreach ($products as $product) {
            $stock = $product->purchaseItems()->sum('jumlah_pack') * $product->isi_per_pack
                   - $product->stockOuts()->sum('jumlah_pack') * $product->isi_per_pack;

            if ($stock < 10) {
                $level = $stock < 1 ? 'habis' : 'hampir habis';
                $message = "Stok produk {$product->nama} $level! Sisa $stock pcs.";

                // Kirim notifikasi ke admin
                Notification::send(User::where('is_admin', true)->get(), new StockAlertNotification($message));
            }
        }
    }
}


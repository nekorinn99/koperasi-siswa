<?php
namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Product;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\StockResource\Pages;
use App\Filament\Resources\StockResource\Pages\ViewStock;

class StockResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Stok Terkini';
    protected static ?string $navigationGroup = 'Manajemen Stok';
    protected static ?string $slug = 'stok-terkini';
    protected static ?int $navigationSort = 3; 
    public static function shouldRegisterNavigation(): bool
{
    return true;
}

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        // Form tetap disediakan, meskipun tidak digunakan (tidak akan dipanggil)
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('nama')
                ->label('Nama Produk')
                ->searchable(),

            Tables\Columns\TextColumn::make('kategori')
                ->label('Kategori')
                ->sortable()
                ->formatStateUsing(fn (string $state) => Product::$kategoriOptions[$state] ?? $state),

            Tables\Columns\TextColumn::make('stok_tersedia')
                ->label('Stok')
                ->getStateUsing(function ($record) {
                    $masuk = $record->purchaseItems()->sum(DB::raw('jumlah_pack * jumlah_pcs'));
                    $keluar = $record->stockOuts()->sum(DB::raw('jumlah_pack * jumlah_pcs'));
                    return $masuk - $keluar;
                }),

            Tables\Columns\TextColumn::make('satuan_pack')
                ->label('Satuan'),
        ])
        ->filters([
            SelectFilter::make('kategori')
                ->label('Filter Kategori')
                ->options([
                    'makanan_ringan' => 'Makanan Ringan',
                    'minuman' => 'Minuman',
                    'alat_tulis' => 'Alat Tulis',
                    'buku' => 'Buku',
                    'seragam' => 'Seragam Sekolah',
                    'kebersihan' => 'Alat Kebersihan',
                    'aksesoris' => 'Aksesoris Sekolah',
                    'makanan_berat' => 'Makanan Berat',
                ]),
                
        ])    
        
        ->actions([]) // tidak perlu edit
        ->bulkActions([]);
}

    public static function getPages(): array
    {
        return [
            'index' => ViewStock::route('/'),
           
        ];
    }
}

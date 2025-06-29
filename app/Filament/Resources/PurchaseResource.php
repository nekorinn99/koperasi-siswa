<?php
namespace App\Filament\Resources;

use App\Models\Purchase;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use App\Models\Vendor;
use App\Models\Product;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\PurchaseResource\Pages;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationLabel = 'Purchases';
    protected static ?string $navigationGroup = 'Inventory';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('vendor_id')
                    ->label('Vendor')
                    ->relationship('vendor', 'nama_vendor')
                    ->searchable()
                    ->required(),

                DatePicker::make('tanggal')
                    ->label('Tanggal Pembelian')
                    ->required(),

                TextInput::make('no_faktur')
                    ->label('No Faktur')
                    ->required()
                    ->unique(ignoreRecord: true),

                Repeater::make('items')
                    ->label('Daftar Produk')
                    ->relationship()
                    ->schema([
                        Select::make('product_id')
                            ->label('Produk')
                            ->relationship('product', 'nama')
                            ->searchable()
                            ->required(),

                        TextInput::make('jumlah_pack')
                            ->label('Jumlah Pack')
                            ->numeric()
                            ->required(),

                        TextInput::make('jumlah_pcs')
                            ->label('Jumlah PCS')
                            ->numeric()
                            ->required(),

                        TextInput::make('harga_beli')
                            ->label('Harga Beli')
                            ->numeric()
                            ->required(),
                    ])
                    ->minItems(1)
                    ->columns(4)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vendor.nama_vendor')
                    ->label('Vendor'),

                Tables\Columns\TextColumn::make('tanggal')
                    ->date(),

                Tables\Columns\TextColumn::make('no_faktur'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Input')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}

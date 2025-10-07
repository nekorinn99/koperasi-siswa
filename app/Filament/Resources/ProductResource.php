<?php

namespace App\Filament\Resources;

use Filament\Forms;
use TextInput\Mask;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Produk';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required(),
                
                Forms\Components\Select::make('kategori')
                    ->options(Product::$kategoriOptions)
                    ->required()
                    ->label('Kategori'),
                Forms\Components\TextInput::make('isi_per_pack')
                    ->required()
                    ->numeric(),
                Select::make('satuan_pack') # option pada satuan pack akan mengarah ke model product yang nantinya akan memudahkan dalam menambahkan satuan pack tanpa mengubah migration 
                    ->label('Satuan Pack')
                    ->options(Product::$satuanPackOptions)
                    ->required(),
                #Forms\Components\TextInput::make('harga_beli')
                #    ->label('Harga Beli per Pack')
                #    ->required()
                #    ->numeric(),
                #Forms\Components\TextInput::make('harga_jual')
                #    ->label('Harga Jual per Pack')
                #    ->required()
                #    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->formatStateUsing(fn ($state) => Product::$kategoriOptions[$state] ?? $state)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('satuan_pack')
                    ->formatStateUsing(fn ($state) => Product::$satuanPackOptions[$state] ?? $state)
                    ->searchable(),
                Tables\Columns\TextColumn::make('isi_per_pack')
                    ->numeric()
                    ->sortable(),    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options(Product::$kategoriOptions)
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

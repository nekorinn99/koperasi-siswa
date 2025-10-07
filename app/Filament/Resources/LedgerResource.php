<?php

namespace App\Filament\Resources;

use App\Models\Ledger;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use App\Filament\Resources\LedgerResource\Pages;

class LedgerResource extends Resource
{
    protected static ?string $model = Ledger::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $navigationLabel = 'Pembukuan';
    protected static ?int $navigationSort = 7;

    // FORM PEMASUKAN
    public static function formPemasukan(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipe')
                    ->label('Tipe Transaksi')
                    ->options([
                        'pemasukan' => 'Pemasukan',
                    ])
                    ->default('pemasukan')
                    ->disabled()
                    ->required(),

                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required(),

                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),

                Forms\Components\Textarea::make('catatan')
                    ->label('Catatan')
                    ->nullable(),
            ]);
    }

    // FORM PENGELUARAN
    public static function formPengeluaran(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipe')
                    ->label('Tipe Transaksi')
                    ->options([
                        'pengeluaran' => 'Pengeluaran',
                    ])
                    ->default('pengeluaran')
                    ->disabled()
                    ->required(),

                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required(),

                Forms\Components\TextInput::make('nama_vendor')
                    ->label('Nama Vendor')
                    ->required(),

                Forms\Components\Select::make('no_faktur')
                    ->label('Nomor Faktur')
                    ->relationship('purchase', 'no_faktur')
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),

                Forms\Components\Textarea::make('catatan')
                    ->label('Catatan')
                    ->nullable(),
            ]);
    }

    // DEFAULT FORM (misalnya untuk Edit)
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipe')
                    ->label('Tipe Transaksi')
                    ->options([
                        'pemasukan' => 'Pemasukan',
                        'pengeluaran' => 'Pengeluaran',
                    ])
                    ->required(),

                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required(),

                Forms\Components\TextInput::make('nama_vendor')
                    ->label('Nama Vendor')
                    ->visible(fn (Forms\Get $get) => $get('tipe') === 'pengeluaran'),

                Forms\Components\Select::make('no_faktur')
                    ->label('Nomor Faktur')
                    ->relationship('purchase', 'no_faktur')
                    ->searchable()
                    ->preload()
                    #->visible(fn (Forms\Get $get) => $get('tipe') === 'pengeluaran')
                    ,

                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),

                Forms\Components\Textarea::make('catatan')
                    ->label('Catatan')
                    ->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')->date(),
                Tables\Columns\TextColumn::make('tipe')->badge(),
                Tables\Columns\TextColumn::make('jumlah')->money('IDR'),
                Tables\Columns\TextColumn::make('nama_vendor')->searchable(),
                Tables\Columns\TextColumn::make('no_faktur')->searchable(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLedgers::route('/'),
        ];
    }
}
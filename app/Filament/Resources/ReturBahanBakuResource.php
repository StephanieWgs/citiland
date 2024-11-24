<?php

namespace App\Filament\Resources;


use App\Models\supplier;

use App\Filament\Resources\ReturBahanBakuResource\Pages;
use App\Filament\Resources\ReturBahanBakuResource\RelationManagers;
use App\Models\pembelianBahanBaku;
use App\Models\ReturBahanBaku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\stokBahanBaku;

class ReturBahanBakuResource extends Resource
{
    protected static ?string $model = ReturBahanBaku::class;

    protected static ?string $navigationGroup = 'Pembelian';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Retur Bahan Baku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggalRetur')
                    ->label('Tanggal Retur')
                    ->required(),

                Forms\Components\Select::make('referensi')
                    ->label('Referensi Invoice')
                    ->options(pembelianBahanBaku::all()->mapWithKeys(function ($item) {
                        return [$item->noInv => $item->noInv];
                    }))
                    ->required()
                    ->searchable(),

                Forms\Components\Select::make('kodeBahanBaku')
                    ->label('Kode Bahan Baku')
                    ->options(function ($get) {
                        $referensi = $get('referensi');
                        if ($referensi) {
                            return pembelianBahanBaku::where('noInv', $referensi)
                                ->with('bahanBaku')
                                ->get()
                                ->mapWithKeys(function ($item) {
                                    return [
                                        $item->kodeBahanBaku => $item->kodeBahanBaku . ' - ' . ($item->bahanBaku ? $item->bahanBaku->namaBahanBaku : 'Unknown Bahan Baku')
                                    ];
                                });
                        }
                        return [];
                    })
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('jumlahRetur')
                    ->label('Jumlah Retur')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->afterStateUpdated(function (callable $set, $state, $get) {
                        $kodeBahanBaku = $get('kodeBahanBaku');
                        $pembelian = pembelianBahanBaku::where('kodeBahanBaku', $kodeBahanBaku)->first();

                        if ($pembelian) {
                            $totalRetur = returBahanBaku::where('kodeBahanBaku', $kodeBahanBaku)
                                ->sum('jumlahRetur');
                            $maksRetur = $pembelian->jumlahPembelian - $totalRetur;

                            if ($state > $maksRetur) {
                                $set('jumlahRetur', $maksRetur);
                            }
                        }
                    })
                    ->reactive(),

                Forms\Components\TextInput::make('alasan')
                    ->label('Alasan Retur')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggalRetur')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('referensi')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kodeBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlahRetur')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('alasan')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListReturBahanBakus::route('/'),
            'create' => Pages\CreateReturBahanBaku::route('/create'),
            'edit' => Pages\EditReturBahanBaku::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemakaianBahanBakuResource\Pages;
use App\Filament\Resources\PemakaianBahanBakuResource\RelationManagers;
use App\Models\PemakaianBahanBaku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\stokBahanBaku;

class PemakaianBahanBakuResource extends Resource
{
    protected static ?string $model = PemakaianBahanBaku::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kodeBahanBaku')
                    ->label('Kode Bahan Baku')
                    ->options(stokBahanBaku::all()->mapWithKeys(function ($item) {
                        return [$item->kodeBahanBaku => $item->kodeBahanBaku . ' - ' . $item->namaBahanBaku];
                    }))
                    ->searchable(),

                Forms\Components\TextInput::make('namaBahanBaku')
                    ->label('Nama Bahan Baku')
                    ->maxLength(100)
                    ->required(),

                Forms\Components\TextInput::make('jumlahPemakaian')
                    ->label('Jumlah Pemakaian')
                    ->maxLength(20)
                    ->required(),

                Forms\Components\TextInput::make('unitBB')
                    ->label('Unit Bahan Baku')
                    ->maxLength(10)
                    ->required(),

                Forms\Components\DatePicker::make('tanggalPemakaian')
                    ->label('Tanggal Pemakaian')
                    ->required(),

                Forms\Components\TextInput::make('jenisBahanBaku')
                    ->label('Jenis Bahan Baku')
                    ->maxLength(5)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kodeBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('namaBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlahPemakaian')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('unitBB')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tanggalPemakaian')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jenisBahanBaku')->sortable()->searchable()
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
            'index' => Pages\ListPemakaianBahanBakus::route('/'),
            'create' => Pages\CreatePemakaianBahanBaku::route('/create'),
            'edit' => Pages\EditPemakaianBahanBaku::route('/{record}/edit'),
        ];
    }
}

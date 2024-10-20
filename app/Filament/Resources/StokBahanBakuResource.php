<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokBahanBakuResource\Pages;
use App\Filament\Resources\StokBahanBakuResource\RelationManagers;
use App\Models\StokBahanBaku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\jenisBahanBaku;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StokBahanBakuResource extends Resource
{
    protected static ?string $model = StokBahanBaku::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kodeBahanBaku')
                    ->label('Kode Bahan Baku')
                    ->maxLength(10)
                    ->required(),
                Forms\Components\TextInput::make('namaBahanBaku')
                    ->label('Nama Bahan Baku')
                    ->maxLength(100)
                    ->required(),
                Forms\Components\Select::make('jenisBahanBaku')
                    ->label('Jenis Bahan Baku')
                    ->options(jenisBahanBaku::all()->pluck('jenisBahanBaku', 'jenisBahanBaku'))
                    ->searchable(),
                Forms\Components\TextInput::make('jumlahBahanBaku')
                    ->label('Jumlah Bahan Baku')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('unitBahanBaku')
                    ->label('Unit Bahan Baku')
                    ->maxLength(5)
                    ->required(),
                Forms\Components\TextInput::make('hargaBBperunit')
                    ->label('Harga BB Per Unit')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('maxLeadTime')
                    ->label('Waktu Rata-Rata yang diperlukan BB Masuk (Hari)')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('ratarataLeadTime')
                    ->label('Waktu Maksimum yang diperlukan BB Masuk (Hari)')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('maxBBKeluar')
                    ->label('Maksimum BB Keluar Harian')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('ratarataPemakaian')
                    ->label('Rata-rata Pemakaian Harian')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kodeBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('namaBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jenisBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlahBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('unitBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('hargaBBperunit')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('safetyStock')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->sortable()->searchable(),
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
            'index' => Pages\ListStokBahanBakus::route('/'),
            'create' => Pages\CreateStokBahanBaku::route('/create'),
            'edit' => Pages\EditStokBahanBaku::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReturBahanBakuResource\Pages;
use App\Filament\Resources\ReturBahanBakuResource\RelationManagers;
use App\Models\ReturBahanBaku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReturBahanBakuResource extends Resource
{
    protected static ?string $model = ReturBahanBaku::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('namaSupplier')
                ->label('Nama Supplier')
                ->required()
                ->maxLength(40),

                Forms\Components\TextInput::make('kodeBahanBaku')
                ->label('Kode Bahan Baku')
                ->required()
                ->maxLength(10),

                Forms\Components\TextInput::make('namaBahanBaku')
                ->label('Kode Bahan Baku')
                ->required()
                ->maxLength(100),

                Forms\Components\TextInput::make('jumlahBahanBaku')
                ->label('Kode Bahan Baku')
                ->numeric()
                ->required()
                ->maxLength(15),

                Forms\Components\TextInput::make('hargaRetur')
                ->label('Harga Retur')
                ->numeric()
                ->required()
                ->maxLength(50),

                Forms\Components\TextInput::make('satuanBahanBaku')
                ->label('Satuan Bahan Baku')
                ->numeric()
                ->required()
                ->maxLength(50),

                Forms\Components\DatePicker::make('tanggalRetur')
                ->label('Tanggal Retur')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('namaSupplier')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kodeBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('namaBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlahBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('hargaRetur')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('satuanBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tanggalRetur')->sortable()->searchable(),
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

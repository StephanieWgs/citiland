<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisBahanBakuResource\Pages;
use App\Filament\Resources\JenisBahanBakuResource\RelationManagers;
use App\Models\JenisBahanBaku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\stokBahanBaku;

class JenisBahanBakuResource extends Resource
{
    protected static ?string $model = JenisBahanBaku::class;

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

                Forms\Components\Select::make('jenisBahanBaku')
                    ->label('Jenis Bahan Baku')
                    ->options([
                        'Kayu' => 'Kayu',
                        'Logam' => 'Logam',
                        'Kain' => 'Kain',
                        'Kaca' => 'Kaca',
                        'Batu' => 'Batu',
                        'Cat' => 'Cat',
                        'Acc' => 'Acc',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kodeBahanBaku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jenisBahanBaku')->sortable()->searchable(),

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
            'index' => Pages\ListJenisBahanBakus::route('/'),
            'create' => Pages\CreateJenisBahanBaku::route('/create'),
            'edit' => Pages\EditJenisBahanBaku::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisBahanBakuResource\Pages;
use App\Filament\Resources\JenisBahanBakuResource\RelationManagers;
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

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Bahan Baku';
    protected static ?string $navigationLabel = 'Jenis BB';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('jenisBahanBaku')
                    ->label('Nama Jenis Bahan Baku')
                    ->maxLength(100)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kodesupplier')
                ->label('Kode Supplier')
                ->required()
                ->maxLength(10),

                Forms\Components\TextInput::make('namasupplier')
                ->label('Nama Supplier')
                ->required()
                ->maxLength(40),

                Forms\Components\TextInput::make('nomorHPsupplier')
                ->label('Nomor HP Supplier')
                ->numeric()
                ->required()
                ->maxLength(12),

                Forms\Components\TextArea::make('alamatsupplier')
                ->label('Alamat Supplier')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kodesupplier')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('namasupplier')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nomorHPsupplier')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('alamatsupplier')->sortable()->searchable(),
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}

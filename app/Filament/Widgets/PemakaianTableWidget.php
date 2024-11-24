<?php

namespace App\Filament\Widgets;

use App\Models\pemakaianBahanBaku;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PemakaianTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Riwayat Pemakaian BB';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                pemakaianBahanBaku::query()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('tanggalPemakaian')
                    ->label('Tgl')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kodeBahanBaku')
                    ->label('Kode BB')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlahPemakaian')
                    ->label('Qty')
                    ->searchable(),
            ]);
    }
}
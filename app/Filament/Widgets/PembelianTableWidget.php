<?php

namespace App\Filament\Widgets;

use App\Models\pembelianBahanBaku;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PembelianTableWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                pembelianBahanBaku::query()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('tanggalPembelian')
                    ->label('Tgl Pembelian')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kodeBahanBaku')
                    ->label('Kode BB')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlahPembelian')
                    ->label('Qty')
                    ->searchable(),
            ]);
    }
}

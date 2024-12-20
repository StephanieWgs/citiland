<?php

namespace App\Filament\Widgets;

use App\Models\pembelianBahanBaku;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PembelianTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Riwayat Pembelian BB';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                pembelianBahanBaku::query()
                    ->orderBy('tanggalPembelian', 'desc')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('tanggalPembelian')
                    ->label('Tgl')
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

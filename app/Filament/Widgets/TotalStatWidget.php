<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Illuminate\Support\Facades\DB;
use App\Models\Produksi;
use App\Models\stokBahanBaku;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPegawai = DB::table('produksis')->count();
        $totalStokNeedRestock = stokBahanBaku::where('status', stokBahanBaku::STATUS_NEED_RESTOCK)->count();
        $totalOutOfStock = stokBahanBaku::where('status', stokBahanBaku::STATUS_OUT_OF_STOCK)->count();
        return [
            Card::make('Total Produksi Saat Ini', $totalPegawai)
                ->description('Produksi')
                ->descriptionIcon('heroicon-o-clipboard-document')
                ->color('success'),
            Card::make('Status: Need Restock', $totalStokNeedRestock)
                ->description('Bahan Baku')
                ->descriptionIcon('heroicon-o-inbox-stack')
                ->color('danger'),
            Card::make('Status: Out of Stock', $totalOutOfStock)
                ->description('Bahan Baku')
                ->descriptionIcon('heroicon-o-inbox-stack')
                ->color('danger'),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Illuminate\Support\Facades\DB;
use App\Models\Produksi;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalProduksiStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPegawai = DB::table('produksis')->count();
        return [
            Card::make('Total Produksi', $totalPegawai)
                ->description('Total Produksi Saat Ini')
                ->descriptionIcon('heroicon-o-clipboard-document')
                ->color('success'),
        ];
    }
}

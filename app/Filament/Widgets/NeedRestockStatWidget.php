<?php

namespace App\Filament\Widgets;

use App\Models\stokBahanBaku;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Card;

class NeedRestockStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalStokYgPerluRestock = stokBahanBaku::where('status', stokBahanBaku::STATUS_NEED_RESTOCK)->count();
        return [
            Card::make('Total yang Perlu Restock', $totalStokYgPerluRestock)
                ->description('Total BB yang Perlu Restock')
                ->descriptionIcon('heroicon-o-inbox-stack')
                ->color('danger'),
        ];
    }
}

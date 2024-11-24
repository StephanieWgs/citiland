<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\pemakaianBahanBaku;
use App\Models\stokBahanBaku;

use Illuminate\Support\Facades\DB;

class PemakaianChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Pemakaian Bahan Baku Terbanyak';

    protected function getData(): array
    {
        // Ambil data pemakaian bahan baku terbanyak
        $pemakaianBB = pemakaianBahanBaku::query()
            ->select('kodeBahanBaku', DB::raw('SUM(jumlahPemakaian) as totalPemakaian'))
            ->groupBy('kodeBahanBaku')
            ->orderByDesc('totalPemakaian')
            ->limit(5)
            ->get();

        // Ambil nama bahan baku berdasarkan kodeBahanBaku
        $labels = $pemakaianBB->map(function ($item) {
            return stokBahanBaku::where('kodeBahanBaku', $item->kodeBahanBaku)->value('namaBahanBaku') ?? $item->kodeBahanBaku;
        });

        $data = $pemakaianBB->pluck('totalPemakaian');

        return [
            'datasets' => [
                [
                    'label' => 'Total Pemakaian',
                    'data' => $data,
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; 
    }
}

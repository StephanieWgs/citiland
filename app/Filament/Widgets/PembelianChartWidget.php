<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\pembelianBahanBaku;
use App\Models\stokBahanBaku;

use Illuminate\Support\Facades\DB;

class PembelianChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Pembelian Bahan Baku Terbanyak';

    protected function getData(): array
    {
        // Ambil data pemakaian bahan baku terbanyak
        $pembelianBB = pembelianBahanBaku::query()
            ->select('kodeBahanBaku', DB::raw('SUM(jumlahPembelian) as totalPembelian'))
            ->groupBy('kodeBahanBaku')
            ->orderByDesc('totalPembelian')
            ->limit(5)
            ->get();

        // Ambil nama bahan baku berdasarkan kodeBahanBaku
        $labels = $pembelianBB->map(function ($item) {
            return stokBahanBaku::where('kodeBahanBaku', $item->kodeBahanBaku)->value('namaBahanBaku') ?? $item->kodeBahanBaku;
        });

        $data = $pembelianBB->pluck('totalPembelian');

        return [
            'datasets' => [
                [
                    'label' => 'Total Pembelian',
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

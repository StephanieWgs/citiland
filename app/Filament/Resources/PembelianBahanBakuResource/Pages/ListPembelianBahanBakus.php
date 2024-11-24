<?php

namespace App\Filament\Resources\PembelianBahanBakuResource\Pages;

use App\Filament\Resources\PembelianBahanBakuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\PembelianBahanBaku;


class ListPembelianBahanBakus extends ListRecords
{
    protected static string $resource = PembelianBahanBakuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('cetak_laporan')
                ->label('Cetak Laporan')
                ->icon('heroicon-o-printer')
                ->action(fn() => static::cetakLaporan())
                ->requiresConfirmation()
                ->modalHeading('Rekapan Pembelian & Retur')
                ->modalSubheading('Apakah Anda ingin mencetak rekapan pembelian dan retur?'),
        ];
    }

    public static function cetakLaporan()
    {
        $data = \App\Models\pembelianBahanBaku::all();
        $pdf = \PDF::loadView('Laporan.cetak_pembelian', ['data' => $data])->setPaper('a4', 'landscape');
        return response()->streamDownload(fn() => print($pdf->output()), 'rekap-pembelian&retur.pdf');
    }
}

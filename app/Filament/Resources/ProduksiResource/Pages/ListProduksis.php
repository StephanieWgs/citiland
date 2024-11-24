<?php

namespace App\Filament\Resources\ProduksiResource\Pages;

use App\Filament\Resources\ProduksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\produksi;

class ListProduksis extends ListRecords
{
    protected static string $resource = ProduksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('cetak_laporan')
                ->label('Cetak Laporan')
                ->icon('heroicon-o-printer')
                ->action(fn() => static::cetakLaporan())
                ->requiresConfirmation()
                ->modalHeading('Rekapan Produksi')
                ->modalSubheading('Apakah Anda ingin mencetak rekapan produksi?'),
        ];
    }

    public static function cetakLaporan()
    {
        $data = \App\Models\produksi::all();
        $pdf = \PDF::loadView('Laporan.cetak_produksi', ['data' => $data])->setPaper('a4', 'landscape');
        return response()->streamDownload(fn() => print($pdf->output()), 'rekap-produksi.pdf');
    }
}

<?php

namespace App\Filament\Resources\StokBahanBakuResource\Pages;

use App\Filament\Resources\StokBahanBakuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStokBahanBakus extends ListRecords
{
    protected static string $resource = StokBahanBakuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('cetak_laporan')
                ->label('Cetak Laporan')
                ->icon('heroicon-o-printer')
                ->action(fn() => static::cetakLaporan())
                ->requiresConfirmation()
                ->modalHeading('Laporan Stok Bahan Baku')
                ->modalSubheading('Apakah Anda ingin mencetak laporan stok?'),
        ];
    }

    public static function cetakLaporan()
    {
        $data = \App\Models\StokBahanBaku::all();
        $pdf = \PDF::loadView('Laporan.cetak_stok', ['data' => $data]);
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan-stok.pdf');
    }
}

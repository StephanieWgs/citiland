<?php

namespace App\Filament\Resources\GudangResource\Pages;

use App\Filament\Resources\GudangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Gudang;

class ListGudangs extends ListRecords
{
    protected static string $resource = GudangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('cetak_laporan')
                ->label('Cetak Laporan')
                ->icon('heroicon-o-printer')
                ->action(fn() => static::cetakLaporan())
                ->requiresConfirmation()
                ->modalHeading('Laporan Staff Gudang')
                ->modalSubheading('Apakah Anda ingin mencetak laporan staff gudang?'),
        ];
    }

    public static function cetakLaporan()
    {
        $data = \App\Models\Gudang::all();
        $pdf = \PDF::loadView('Laporan.cetak_gudang', ['data' => $data]);
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan-gudang.pdf');
    }
}

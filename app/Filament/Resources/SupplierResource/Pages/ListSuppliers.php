<?php

namespace App\Filament\Resources\SupplierResource\Pages;

use App\Filament\Resources\SupplierResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Supplier;

class ListSuppliers extends ListRecords
{
    protected static string $resource = SupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('cetak_laporan')
                ->label('Cetak Laporan')
                ->icon('heroicon-o-printer')
                ->action(fn() => static::cetakLaporan())
                ->requiresConfirmation()
                ->modalHeading('Laporan Supplier')
                ->modalSubheading('Apakah Anda ingin mencetak laporan supplier?'),
        ];
    }

    public static function cetakLaporan()
    {
        $data = \App\Models\Supplier::all();
        $pdf = \PDF::loadView('Laporan.cetak_supplier', ['data' => $data]);
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan-supplier.pdf');
    }
}

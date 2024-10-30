<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Admin;

class ListAdmins extends ListRecords
{
    protected static string $resource = AdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('cetak_laporan')
                ->label('Cetak Laporan')
                ->icon('heroicon-o-printer')
                ->action(fn() => static::cetakLaporan())
                ->requiresConfirmation()
                ->modalHeading('Laporan Staff Admin')
                ->modalSubheading('Apakah Anda ingin mencetak laporan staff admin?'),
        ];
    }

    public static function cetakLaporan()
    {
        $data = \App\Models\Admin::all();
        $pdf = \PDF::loadView('Laporan.cetak_admin', ['data' => $data]);
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan-admin.pdf');
    }
}

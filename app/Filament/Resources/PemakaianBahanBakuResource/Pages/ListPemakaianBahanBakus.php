<?php

namespace App\Filament\Resources\PemakaianBahanBakuResource\Pages;

use App\Filament\Resources\PemakaianBahanBakuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemakaianBahanBakus extends ListRecords
{
    protected static string $resource = PemakaianBahanBakuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

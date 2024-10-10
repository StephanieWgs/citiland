<?php

namespace App\Filament\Resources\ReturBahanBakuResource\Pages;

use App\Filament\Resources\ReturBahanBakuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReturBahanBakus extends ListRecords
{
    protected static string $resource = ReturBahanBakuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

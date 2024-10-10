<?php

namespace App\Filament\Resources\JenisBahanBakuResource\Pages;

use App\Filament\Resources\JenisBahanBakuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisBahanBakus extends ListRecords
{
    protected static string $resource = JenisBahanBakuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

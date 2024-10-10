<?php

namespace App\Filament\Resources\PemakaianBahanBakuResource\Pages;

use App\Filament\Resources\PemakaianBahanBakuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemakaianBahanBaku extends EditRecord
{
    protected static string $resource = PemakaianBahanBakuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

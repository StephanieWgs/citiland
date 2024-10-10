<?php

namespace App\Filament\Resources\ReturBahanBakuResource\Pages;

use App\Filament\Resources\ReturBahanBakuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReturBahanBaku extends EditRecord
{
    protected static string $resource = ReturBahanBakuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

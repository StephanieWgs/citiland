<?php

namespace App\Filament\Resources\JenisBahanBakuResource\Pages;

use App\Filament\Resources\JenisBahanBakuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisBahanBaku extends EditRecord
{
    protected static string $resource = JenisBahanBakuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

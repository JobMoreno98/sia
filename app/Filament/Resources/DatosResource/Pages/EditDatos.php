<?php

namespace App\Filament\Resources\DatosResource\Pages;

use App\Filament\Resources\DatosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDatos extends EditRecord
{
    protected static string $resource = DatosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

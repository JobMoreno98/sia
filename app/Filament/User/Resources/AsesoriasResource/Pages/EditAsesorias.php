<?php

namespace App\Filament\User\Resources\AsesoriasResource\Pages;

use App\Filament\User\Resources\AsesoriasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsesorias extends EditRecord
{
    protected static string $resource = AsesoriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

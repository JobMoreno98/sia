<?php

namespace App\Filament\User\Resources\AsesoriasResource\Pages;

use App\Filament\User\Resources\AsesoriasResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAsesorias extends ViewRecord
{
    protected static string $resource = AsesoriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

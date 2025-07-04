<?php

namespace App\Filament\User\Resources\AsesoriasResource\Pages;

use App\Filament\User\Resources\AsesoriasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAsesorias extends ListRecords
{
    protected static string $resource = AsesoriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Agregar'),
        ];
    }
}

<?php

namespace App\Filament\Resources\DivisionesResource\Pages;

use App\Filament\Resources\DivisionesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDivisiones extends ListRecords
{
    protected static string $resource = DivisionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Agregar'),
        ];
    }
}

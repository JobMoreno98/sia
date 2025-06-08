<?php

namespace App\Filament\User\Resources\TitulacionResource\Pages;

use App\Filament\User\Resources\TitulacionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListTitulacions extends ListRecords
{
    protected static string $resource = TitulacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Agregar'),
        ];
    }
    public function getTitle(): string|Htmlable
    {
        return 'Titulación  / Asesoria';
    }
}

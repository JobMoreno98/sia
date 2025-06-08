<?php

namespace App\Filament\Resources\ProgramaEducativoResource\Pages;

use App\Filament\Resources\ProgramaEducativoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramaEducativos extends ListRecords
{
    protected static string $resource = ProgramaEducativoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

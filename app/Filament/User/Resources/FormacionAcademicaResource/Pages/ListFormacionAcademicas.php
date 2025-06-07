<?php

namespace App\Filament\User\Resources\FormacionAcademicaResource\Pages;

use App\Filament\User\Resources\FormacionAcademicaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormacionAcademicas extends ListRecords
{
    protected static string $resource = FormacionAcademicaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

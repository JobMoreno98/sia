<?php

namespace App\Filament\User\Resources\FormacionAcademicaResource\Pages;

use App\Filament\User\Resources\FormacionAcademicaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListFormacionAcademicas extends ListRecords
{
    protected static string $resource = FormacionAcademicaResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Formación Académica';
    }

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()->label('Agregar')];
    }
}

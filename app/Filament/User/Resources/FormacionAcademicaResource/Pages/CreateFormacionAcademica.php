<?php

namespace App\Filament\User\Resources\FormacionAcademicaResource\Pages;

use App\Filament\User\Resources\FormacionAcademicaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateFormacionAcademica extends CreateRecord
{
    protected static string $resource = FormacionAcademicaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
    
    public function getTitle(): string|Htmlable
    {
        return 'Crear Formación Académica';
    }
}

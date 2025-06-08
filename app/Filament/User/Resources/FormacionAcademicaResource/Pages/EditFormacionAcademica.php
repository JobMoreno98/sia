<?php

namespace App\Filament\User\Resources\FormacionAcademicaResource\Pages;

use App\Filament\User\Resources\FormacionAcademicaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditFormacionAcademica extends EditRecord
{
    protected static string $resource = FormacionAcademicaResource::class;
    
    public function getTitle(): string|Htmlable
    {
        return 'Editar Formación Académica';
    }
    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}

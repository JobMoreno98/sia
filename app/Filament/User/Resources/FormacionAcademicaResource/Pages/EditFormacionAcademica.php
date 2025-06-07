<?php

namespace App\Filament\User\Resources\FormacionAcademicaResource\Pages;

use App\Filament\User\Resources\FormacionAcademicaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormacionAcademica extends EditRecord
{
    protected static string $resource = FormacionAcademicaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

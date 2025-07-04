<?php

namespace App\Filament\Resources\DisciplinasResource\Pages;

use App\Filament\Resources\DisciplinasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDisciplinas extends EditRecord
{
    protected static string $resource = DisciplinasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

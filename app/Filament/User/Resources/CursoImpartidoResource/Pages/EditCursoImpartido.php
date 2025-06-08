<?php

namespace App\Filament\User\Resources\CursoImpartidoResource\Pages;

use App\Filament\User\Resources\CursoImpartidoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCursoImpartido extends EditRecord
{
    protected static string $resource = CursoImpartidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

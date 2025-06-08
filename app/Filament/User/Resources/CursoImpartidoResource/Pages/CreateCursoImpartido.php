<?php

namespace App\Filament\User\Resources\CursoImpartidoResource\Pages;

use App\Filament\User\Resources\CursoImpartidoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCursoImpartido extends CreateRecord
{
    protected static string $resource = CursoImpartidoResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}

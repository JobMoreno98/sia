<?php

namespace App\Filament\User\Resources\AsesoriasResource\Pages;

use App\Filament\User\Resources\AsesoriasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAsesorias extends CreateRecord
{
    protected static string $resource = AsesoriasResource::class;
        protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}

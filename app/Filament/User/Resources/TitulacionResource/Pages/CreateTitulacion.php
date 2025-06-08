<?php

namespace App\Filament\User\Resources\TitulacionResource\Pages;

use App\Filament\User\Resources\TitulacionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTitulacion extends CreateRecord
{
    protected static string $resource = TitulacionResource::class;
        protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
        public function getTitle(): string|Htmlable
    {
        return 'Crear Titulación  / Asesoria';
    }
}

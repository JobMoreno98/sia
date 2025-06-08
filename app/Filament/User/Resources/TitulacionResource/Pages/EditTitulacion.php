<?php

namespace App\Filament\User\Resources\TitulacionResource\Pages;

use App\Filament\User\Resources\TitulacionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditTitulacion extends EditRecord
{
    protected static string $resource = TitulacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
        public function getTitle(): string|Htmlable
    {
        return 'Editar Titulación  / Asesoria';
    }
}

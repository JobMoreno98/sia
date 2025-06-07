<?php

namespace App\Filament\Resources\DivisionesResource\Pages;

use App\Filament\Resources\DivisionesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDivisiones extends EditRecord
{
    protected static string $resource = DivisionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

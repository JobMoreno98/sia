<?php

namespace App\Filament\Resources\ProgramaEducativoResource\Pages;

use App\Filament\Resources\ProgramaEducativoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramaEducativo extends EditRecord
{
    protected static string $resource = ProgramaEducativoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

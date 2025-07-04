<?php

namespace App\Filament\User\Resources\PlanEstudiosResource\Pages;

use App\Filament\User\Resources\PlanEstudiosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlanEstudios extends EditRecord
{
    protected static string $resource = PlanEstudiosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

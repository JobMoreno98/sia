<?php

namespace App\Filament\User\Resources\PlanEstudiosResource\Pages;

use App\Filament\User\Resources\PlanEstudiosResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPlanEstudios extends ViewRecord
{
    protected static string $resource = PlanEstudiosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

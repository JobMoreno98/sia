<?php

namespace App\Filament\User\Resources\PlanEstudiosResource\Pages;

use App\Filament\User\Resources\PlanEstudiosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlanEstudios extends CreateRecord
{
    protected static string $resource = PlanEstudiosResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}

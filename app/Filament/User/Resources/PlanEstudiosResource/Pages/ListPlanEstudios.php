<?php

namespace App\Filament\User\Resources\PlanEstudiosResource\Pages;

use App\Filament\User\Resources\PlanEstudiosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListPlanEstudios extends ListRecords
{
    protected static string $resource = PlanEstudiosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Agregar'),
        ];
    }
    public function getTitle(): string|Htmlable
    {
        return 'Plan de Estudios';
    }
}

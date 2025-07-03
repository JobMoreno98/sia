<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteBulkAction;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Agregar'),
        ];
    }
    public function getTitle(): string
    {
        return 'Listado de Usuarios';
    }
        public function getTableBulkActions(): array
    {
        return [
            DeleteBulkAction::make(),
        ];
    }
}

<?php

namespace App\Filament\User\Resources\CursoImpartidoResource\Pages;

use App\Filament\User\Resources\CursoImpartidoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCursoImpartidos extends ListRecords
{
    protected static string $resource = CursoImpartidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Agregar'),
        ];
    }
    
    // Que la tabla use todo el ancho disponible
    protected function getTableWrapperWidth(): ?string
    {
        return 'full';
    }

    // Aseguramos que el contenedor del header sea ancho completo
    protected function getHeaderWrapper(): string
    {
        return 'w-full max-w-full';
    }

    // Aseguramos que el contenedor de la tabla sea ancho completo
    protected function getTableWrapper(): string
    {
        return 'w-full max-w-full';
    }

    // Añadimos atributos html para forzar ancho en la tabla
    protected function getTableWrapperHtmlAttributes(): array
    {
        return [
            'class' => 'w-full max-w-full',
            'style' => 'width: 100% !important;',
        ];
    }
}

<?php

namespace App\Filament\User\Pages;

use App\Models\Informacion;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;

class DatosLaboralesPage extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?array $data = [];

    protected static ?string $title = 'Mis Datos Laborales';
    protected static ?string $navigationLabel = 'Datos Laborales';
    protected static string $view = 'filament.user.pages.datos-laborales-page';

    public function mount(): void
    {
        $user = Auth::user();
        $informacion = $user->informacion;

        $this->form->fill($informacion ? $informacion->toArray() : [
            'correo' => Auth::user()?->email,
            'nombre' => Auth::user()?->name,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('departamento')->label('Departamento')->required(),

                TextInput::make('nombramiento')->label('Nombramiento')->required(),

                TextInput::make('tipo')->label('Tipo')->required(),
                TextInput::make('antiguedad')->label('Antiguedad')->required()->numeric()->minValue(0),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $user = Auth::user();
        $user->informacion()->updateOrCreate([], $this->form->getState());

        $this->notify('success', 'Información actualizada correctamente.');
    }
}

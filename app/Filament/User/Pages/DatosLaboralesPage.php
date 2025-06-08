<?php

namespace App\Filament\User\Pages;

use App\Models\Departamentos;
use App\Models\Divisiones;
use App\Models\Informacion;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;

class DatosLaboralesPage extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?array $data = [];
    protected static ?int $navigationSort = 2;
    protected static ?string $title = 'Mis Datos Laborales';
    protected static ?string $navigationGroup = 'Mi Perfil';
    protected static ?string $navigationLabel = 'Datos Laborales';
    protected static string $view = 'filament.user.pages.datos-laborales-page';

    public function mount(): void
    {
        $user = Auth::user();
        $informacion = $user->informacion;

        $this->form->fill(
            $informacion
                ? $informacion->toArray()
                : [
                    'departamento_id' => Auth::user()?->email,
                    'nombre' => Auth::user()?->name,
                ],
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('division_id')
                    ->label('Division')
                    ->options(Divisiones::all()->pluck('nombre', 'id'))
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('departamento_id', null)),

                Select::make('departamento_id')
                    ->label('Departamento')
                    ->options(function (callable $get) {
                        $division_id = $get('division_id');
                        if (!$division_id) {
                            return [];
                        }
                        return Departamentos::where('division_id', $division_id)->pluck('nombre', 'id');
                    })
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('departamento_id', null)),

                TextInput::make('nombramiento')->label('Nombramiento')->required(),

                TextInput::make('tipo')->label('Tipo')->required(),
                TextInput::make('antiguedad')->label('Antiguedad')->required()->numeric()->minValue(0),
            ])
            ->columns()
            ->statePath('data');
    }

    public function save(): void
    {
        $user = Auth::user();
        $user->informacion()->updateOrCreate([], $this->form->getState());

        $this->notify('success', 'Información actualizada correctamente.');
    }
}

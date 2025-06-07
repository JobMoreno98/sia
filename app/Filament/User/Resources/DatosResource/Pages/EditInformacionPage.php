<?php

namespace App\Filament\User\Pages;

use App\Models\Informacion;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Filament\Notifications\Notification;
use Illuminate\Validation\Rule;

class EditInformacionPage extends Page implements Forms\Contracts\HasForms
{
    use InteractsWithForms;


    public array $data = [];

    protected static ?string $navigationLabel = 'Mi Información';
    protected static string $view = 'filament.user.pages.edit-informacion-page';

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
                TextInput::make('codigo')->label('Código')->numeric()->required()->rules([
                    Rule::unique('datos', 'codigo')->ignore(Auth::user()->informacion?->id)
                ]),

                TextInput::make('nombre')->label('Nombre')->required()->rules([
                    Rule::unique('datos', 'codigo')->ignore(Auth::user()->informacion?->id)
                ])->readOnly(),

                Select::make('sexo')
                    ->label('Sexo')
                    ->options([
                        'Masculino' => 'Masculino',
                        'Femenino' => 'Femenino',
                    ])
                    ->required(),

                TextInput::make('domicilio')->label('Domicilio')->required(),

                TextInput::make('telefono')->label('Teléfono')->required(),

                TextInput::make('CRUP')->label('CRUP')->required()->rules([
                    Rule::unique('datos', 'codigo')->ignore(Auth::user()->informacion?->id)
                ]),

                TextInput::make('RFC')->label('RFC')->required()->rules([
                    Rule::unique('datos', 'codigo')->ignore(Auth::user()->informacion?->id)
                ]),

                Select::make('grado')
                    ->label('Grado')
                    ->options([
                        'Dr.' => 'Dr.',
                        'Dra.' => 'Dra.',
                        'Mtro.' => 'Mtro.',
                        'Mtra' => 'Mtra',
                        'Lic.' => 'Lic.',
                    ])
                    ->required(),

                TextInput::make('disciplina')->label('Disciplina')->required(),

                TextInput::make('correo')->label('Correo')->email()->required()->readOnly(),

                TextInput::make('correo_alternativo')->label('Correo Alternativo')->email()->nullable(),

                Section::make('Distribución del Tiempo de Dedicación')->schema([
                    TextInput::make('docencia')
                        ->label('Docencia (%)')
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->maxValue(100)
                        ->reactive(),

                    TextInput::make('asesorias')
                        ->label('Asesorías (%)')
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->maxValue(100)
                        ->reactive(),

                    TextInput::make('gestion')
                        ->label('Gestión (%)')
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->maxValue(100)
                        ->reactive(),

                    TextInput::make('investigacion')
                        ->label('Investigación (%)')
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->maxValue(100)
                        ->reactive(),

                    TextInput::make('extension_difusion')
                        ->label('Extensión y Difusión (%)')
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->maxValue(100)
                        ->reactive(),

                    Placeholder::make('total_placeholder')
                        ->label('Suma Total')
                        ->content(function ($get) {
                            $campos = ['docencia', 'asesorias', 'gestion', 'investigacion', 'extension_difusion'];
                            $valores = [];
                            foreach ($campos as $campo) {
                                $valores[$campo] = $get($campo);
                            }
                            \Log::info('Valores de los campos:', $valores);

                            $total = self::calcularTotal($get);
                            $color = $total === 100 ? 'green' : 'red';
                            return new HtmlString("<span style='color: {$color}; font-weight: bold;'>{$total}% del 100%</span>");
                        })
                        ->reactive(),
                ])->reactive()->columns(5),
            ])
            ->columns(3)->statePath('data');
    }
    public function save(): void
    {
        $this->form->validate();
        $user = Auth::user();

        // Ojo: actualizar o crear el registro relacionado usando updateOrCreate.
        // El primer parámetro es el criterio para buscar el registro (vacío porque es one-to-one).
        // El segundo parámetro es el arreglo con los datos del formulario.
        $user->informacion()->updateOrCreate(
            ['user_id' => $user->id], // criterio para buscar el registro existente
            $this->form->getState()   // datos del formulario
        );

        Notification::make()
            ->title('Información actualizada correctamente.')
            ->success()
            ->send();
    }

    public static function calcularTotal($get): int
    {
        $campos = ['docencia', 'asesorias', 'gestion', 'investigacion', 'extension_difusion'];

        $total = 0;

        foreach ($campos as $campo) {
            $valor = $get($campo);

            $total += (is_numeric($valor) && $valor !== null) ? (int)$valor : 0;
        }

        return $total;
    }

    protected static function validarSuma($get, $livewire): void
    {
        $total = self::calcularTotal($get);

        if ($total !== 100.0) {
            $livewire->addError('docencia', 'La suma total debe ser exactamente 100%. Actualmente es: ' . $total . '%.');
        } else {
            $livewire->resetErrorBag('docencia');
        }
    }
}

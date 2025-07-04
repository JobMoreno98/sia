<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\AsesoriasResource\Pages;
use App\Filament\User\Resources\AsesoriasResource\RelationManagers;
use App\Models\Asesoria;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AsesoriasResource extends Resource
{
    protected static ?string $model = Asesoria::class;

    protected static ?string $navigationGroup = 'Docencia';
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::id());
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')->string(255)->required()->columnSpanFull(),
                Select::make('programa_id')
                    ->label('Programa Educatuvo')
                    ->relationship(
                        name: 'programa',
                        titleAttribute: 'nombre',
                    )->native(true)
                    ->required()->placeholder('- Ninguno -')->searchable()->preload(),
                Select::make('tipo_tutoria')
                    ->label('Tipo de tutoría')->placeholder('- Ninguno -')
                    ->options([
                        'Asesoría de tesis' => 'Asesoría de tesis',
                        'Asesoría disciplinar para alumnos rezagados' => 'Asesoría disciplinar para alumnos rezagados',
                        'Dirección de Titulación' => 'Dirección de Titulación',
                        'Lector de tesis' => 'Lector de tesis',
                        'Participación en los programas de orientación educativa' => 'Participación en los programas de orientación educativa',
                        'Preparación de alumnos para competencias académicas' => 'Preparación de alumnos para competencias académicas',
                        'Preparación de alumnos para exámenes generales' => 'Preparación de alumnos para exámenes generales',
                        'Preparación de alumnos para olimpiadas' => 'Preparación de alumnos para olimpiadas',
                        'Sinodal en exámenes de titulación' => 'Sinodal en exámenes de titulación',
                        'Tutor de alumnos para Prácticas profesionales' => 'Tutor de alumnos para Prácticas profesionales',
                        'Tutor de alumnos para Servicio social' => 'Tutor de alumnos para Servicio social',
                        'Tutor de estudiantes indígenas' => 'Tutor de estudiantes indígenas',
                        'Tutoría académica grupal' => 'Tutoría académica grupal',
                        'Tutoría académica individual' => 'Tutoría académica individual',
                        'Tutorías en el nivel medio superior' => 'Tutorías en el nivel medio superior',
                    ])->required()->searchable()->preload(),

                Select::make('nivel')->label('Nivel Académico')->placeholder('- Ninguno -')
                    ->options([
                        'Licenciatura' => 'Licenciatura',
                        'Maestria' => 'Maestría',
                        'Doctorado' =>  'Doctorado'
                    ])->required()->searchable()->preload(),
                Select::make('estatus')->label('Estatus')->placeholder('- Ninguno -')
                    ->options([
                        'Terminado' => 'Terminado',
                        'En proceso' => 'En proceso',
                    ])->required(),
                TextInput::make('institucion')->required(),
                Select::make('anio')
                    ->label('Año')
                    ->options(array_combine(
                        range(date('Y'), 2020), // Desde este año hasta 2020
                        range(date('Y'), 2020)
                    ))
                    ->searchable()
                    ->required(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAsesorias::route('/'),
            'create' => Pages\CreateAsesorias::route('/create'),
            'view' => Pages\ViewAsesorias::route('/{record}'),
            'edit' => Pages\EditAsesorias::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\FormacionAcademicaResource\Pages;
use App\Filament\User\Resources\FormacionAcademicaResource\RelationManagers;
use App\Models\FormacionAcademica;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class FormacionAcademicaResource extends Resource
{
    protected static ?string $model = FormacionAcademica::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Mi Perfil';
    protected static ?string $navigationLabel = 'Formación Académica';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::id());
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nombre')->label('Nombre')->required(),

            Select::make('grado')
                ->label('Grado')
                ->options([
                    'Licenciatura' => 'Licenciatura',
                    'Maestria' => 'Maestria',
                    'Doctorado' => 'Doctorado',
                    'Postdoctorado' => 'Postdoctorado',
                    'Especializacion' => 'Especializacion',
                    'Actualizacion' => 'Actualizacion',
                    'Estudios' => 'Estudios',
                ])
                ->required(),

            Select::make('conocimiento_id')
                ->label('Área de Conocimiento')->searchable()->preload()
                ->relationship(name: 'conocimiento', titleAttribute: 'nombre', modifyQueryUsing: fn($query) => $query->where('tipo', 'Área de Conocimiento'))
                ->required()
                ->native(false),

            Select::make('disciplina_id')
                ->label('Disciplina')->searchable()->preload()
                ->relationship(name: 'disciplina', titleAttribute: 'nombre', modifyQueryUsing: fn($query) => $query->where('tipo', 'Disciplina'))
                ->required()
                ->native(false),

            TextInput::make('institucion')->label('Institución')->required(),

            TextInput::make('pais')->label('País')->required(),

            Select::make('anio')
                ->label('Año')
                ->options(array_combine(
                    range(date('Y'), 2020), // Desde este año hasta 2020
                    range(date('Y'), 2020)
                ))
                ->searchable()
                ->required(),
            ToggleButtons::make('curso')->label('En curso')->boolean()->grouped(),
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
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
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
            'index' => Pages\ListFormacionAcademicas::route('/'),
            'create' => Pages\CreateFormacionAcademica::route('/create'),
            'edit' => Pages\EditFormacionAcademica::route('/{record}/edit'),
        ];
    }
}

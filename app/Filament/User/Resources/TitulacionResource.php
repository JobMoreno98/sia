<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\TitulacionResource\Pages;
use App\Filament\User\Resources\TitulacionResource\RelationManagers;
use App\Models\Titulacion;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TitulacionResource extends Resource
{
    protected static ?string $model = Titulacion::class;
    protected static ?string $navigationLabel = 'Titulación  / Asesoria';
    protected static ?string $navigationGroup = 'Docencia';
    protected static ?string $title = 'Titulación / Asesoria';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Detalles del Trabajo Académico')->schema([
                    Select::make('tipo')
                        ->label('Tipo')->placeholder('- Ninguno -')
                        ->options([
                            'asesoria' => 'Asesoria',
                            'titulacion' => 'Titulación',
                        ])->reactive()
                        ->required(),
                    TextInput::make('nombre_alumno')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('trabajo')->hint('En caso de ser Titulación llenar este campo')
                        ->required()->reactive()
                        ->maxLength(255)
                        ->visible(fn($get) => $get('tipo') === 'titulacion')
                        ->required(fn($get) => $get('tipo') === 'titulacion')->columnSpanFull(),

                ])->columnSpanFull()->columns(2),
                Section::make()->schema([
                    Select::make('programa_id')
                        ->label('Programa Educativo')
                        ->relationship(
                            name: 'programa',
                            titleAttribute: 'nombre',
                        )->native(true)
                        ->required(),
                    Select::make('nivel')
                        ->options(Titulacion::niveles()),
                    Select::make('participacion')
                        ->options(Titulacion::participaciones()),
                    Select::make('tipo_tutoria')->label('Tipo de tutoria')
                        ->options(Titulacion::tiposTutoria())
                        ->placeholder('- Ninguno -') // Opcional
                        ->searchable() // Opcional, útil si hay muchas opciones
                        ->native(false) // Opcional, para un select estilizado en vez del nativo
                        ->required(),
                    TextInput::make('modalidad')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('nombre_institucion')
                        ->required()
                        ->maxLength(255),

                    ToggleButtons::make('estatus')
                        ->label('Estatus')
                        ->options([
                            'En proceso' => 'En proceso',
                            'Terminado' => 'Terminado',
                        ])
                        ->inline() // o ->stacked() si prefieres vertical
                        ->required()
                        ->colors([
                            'En proceso' => 'info',
                            'Terminado' => 'success',
                        ]),
                    Select::make('anio')
                        ->label('Año')
                        ->options(array_combine(
                            range(date('Y'), 2020), // Desde este año hasta 2020
                            range(date('Y'), 2020)
                        ))
                        ->searchable()
                        ->required(),
                ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('trabajo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_alumno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('programa.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nivel'),
                Tables\Columns\TextColumn::make('participacion'),
                Tables\Columns\TextColumn::make('tipo_tutoria'),
                Tables\Columns\TextColumn::make('modalidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_institucion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estatus'),
                Tables\Columns\TextColumn::make('anio'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListTitulacions::route('/'),
            'create' => Pages\CreateTitulacion::route('/create'),
            'edit' => Pages\EditTitulacion::route('/{record}/edit'),
        ];
    }
}

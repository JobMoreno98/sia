<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\CursoImpartidoResource\Pages;
use App\Filament\User\Resources\CursoImpartidoResource\RelationManagers;
use App\Models\CursoImpartido;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CursoImpartidoResource extends Resource
{
    protected static ?string $model = CursoImpartido::class;
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
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Select::make('programa_id')
                    ->label('Programa Educatuvo')
                    ->relationship(
                        name: 'programa',
                        titleAttribute: 'nombre',
                    )->native(true)
                    ->required()->placeholder('- Ninguno -')->searchable()->preload(),
                Select::make('tipo')->options([
                    'Curso' => 'Curso',
                    'Curso en Linea' => 'Curso en Linea',
                    'Seminario' => 'Seminario',
                    'Taller' => 'Taller',
                    'Mixto' => 'Mixto',
                    'Semi-Prescencial' => 'Semi-Prescencial',
                ])->required()->placeholder('- Ninguno -'),
                Select::make('nivel')->options([
                    'Licenciatura' => 'Licenciatura',
                    'Maestía' => 'Maestía',
                    'Doctorado' => 'Doctorado',
                ])->required()->placeholder('- Ninguno -'),
                Forms\Components\TextInput::make('ciclo')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('horas')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('num_alumnos')->label('Núm. Alumnos')
                    ->required()
                    ->numeric(),
                Select::make('cargo')->options([
                    'Con cargo' => 'Con cargo',
                    'Asigantura' => 'Asigantura',
                ])->required()->placeholder('- Ninguno -'),
                Select::make('anio')
                    ->label('Año')
                    ->options(array_combine(
                        range(date('Y'), 2020), // Desde este año hasta 2020
                        range(date('Y'), 2020)
                    ))
                    ->searchable()
                    ->required(),
                Textarea::make('tecnologias')->label('Tecnologías utilizadas')
                    ->required()
                    ->maxLength(400)->autosize()->columnSpanFull(),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('programa.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('nivel'),
                Tables\Columns\TextColumn::make('ciclo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('horas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('num_alumnos')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cargo'),
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
            'index' => Pages\ListCursoImpartidos::route('/'),
            'create' => Pages\CreateCursoImpartido::route('/create'),
            'edit' => Pages\EditCursoImpartido::route('/{record}/edit'),
        ];
    }
}

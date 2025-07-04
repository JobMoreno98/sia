<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\PlanEstudiosResource\Pages;
use App\Filament\User\Resources\PlanEstudiosResource\RelationManagers;
use App\Models\PlanEstudios;
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

class PlanEstudiosResource extends Resource
{
    protected static ?string $model = PlanEstudios::class;
    protected static ?string $navigationGroup = 'Docencia';
    protected static ?string $navigationLabel = 'Plan de Estudios';

    public static function getSlug(): string
    {
        return 'plan-de-estudios'; // Aquí defines el slug personalizado
    }
    public function getBreadcrumbs(): string
    {
        return 'Plan de Estudios'; // Aquí pones el nuevo nombre
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required()->columnSpanFull(),
                Select::make('grado')
                    ->label('Grado')
                    ->options([
                        'Doctorado' => 'Doctorado',
                        'Especialidad' => 'Especialidad',
                        'Licenciatura' => 'Licenciatura',
                        'Maestria' => 'Maestria',
                        'Postdoctorado' => 'Postdoctorado',
                    ])
                    ->required(),
                Select::make('anio')
                    ->label('Año')
                    ->options(array_combine(
                        range(date('Y'), 2020), // Desde este año hasta 2020
                        range(date('Y'), 2020)
                    ))
                    ->searchable()
                    ->required(),
                Textarea::make('descripcion')
                    ->required()->columnSpanFull()->autosize(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('grado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('anio')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListPlanEstudios::route('/'),
            'create' => Pages\CreatePlanEstudios::route('/create'),
            'view' => Pages\ViewPlanEstudios::route('/{record}'),
            'edit' => Pages\EditPlanEstudios::route('/{record}/edit'),
        ];
    }
}

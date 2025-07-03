<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramaEducativoResource\Pages;
use App\Filament\Resources\ProgramaEducativoResource\RelationManagers;
use App\Models\ProgramaEducativo;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramaEducativoResource extends Resource
{
    protected static ?string $model = ProgramaEducativo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Estructura';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Select::make('departamento_id')
                    ->label('Departamento')
                    ->relationship(
                        name: 'departamento',
                        titleAttribute: 'nombre',
                    )->native(true)->searchable()->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departamento.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('departamento.division.nombre')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListProgramaEducativos::route('/'),
            'create' => Pages\CreateProgramaEducativo::route('/create'),
            'edit' => Pages\EditProgramaEducativo::route('/{record}/edit'),
        ];
    }
        public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}

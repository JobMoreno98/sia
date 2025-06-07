<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DisciplinasResource\Pages;
use App\Filament\Resources\DisciplinasResource\RelationManagers;
use App\Models\Disciplinas;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DisciplinasResource extends Resource
{
    protected static ?string $model = Disciplinas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')->unique(),
                Select::make('tipo')->options([
                    'Área de Conocimiento' => 'Área de Conocimiento',
                    'Disciplina' => 'Disciplina'
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->sortable()->searchable(),
                TextColumn::make('tipo')->sortable()->searchable(),
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
            'index' => Pages\ListDisciplinas::route('/'),
            'create' => Pages\CreateDisciplinas::route('/create'),
            'edit' => Pages\EditDisciplinas::route('/{record}/edit'),
        ];
    }
}

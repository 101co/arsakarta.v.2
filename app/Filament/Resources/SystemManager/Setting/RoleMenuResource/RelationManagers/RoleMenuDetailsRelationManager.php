<?php

namespace App\Filament\Resources\SystemManager\Setting\RoleMenuResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleMenuDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'roleMenuDetails';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('menu_id')
                    ->relationship('menu', 'code', ignoreRecord: true)
                    ->searchable()
                    ->unique()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('menu.code')
            ->columns([
                Tables\Columns\TextColumn::make('menu.code'),
                Tables\Columns\TextColumn::make('menu.description'),
                Tables\Columns\TextColumn::make('menu.application.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing((function (array $data): array {
                        $data['created_by'] = auth()->user()->name;
                        $data['updated_by'] = auth()->user()->name;
                        return $data;
                    })),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

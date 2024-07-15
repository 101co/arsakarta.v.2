<?php

namespace App\Filament\Resources\SystemManager\Setting\RoleMenuResource\RelationManagers;

use App\Enums\Icons;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use App\Models\SystemManager\Master\Menu;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Resources\RelationManagers\RelationManager;

class RoleMenuDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'roleMenuDetails';
    protected static ?string $title = 'Menu';
    protected static ?string $icon = 'heroicon-o-user-group';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('menu_id')
                    ->relationship('menu', 'code')
                    ->getOptionLabelFromRecordUsing(fn (Menu $record) => "{$record->code} - {$record->description}")
                    ->searchable()
                    ->preload()
                    ->unique('role_menu_details',null,null,true)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('menu_id')
            ->columns([
                TextColumn::make('menu.code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('menu.description')
                    ->searchable(),
                TextColumn::make('menu.application.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing((function (array $data): array {
                        $data['created_by'] = auth()->user()->name;
                        $data['updated_by'] = auth()->user()->name;
                        return $data;
                    }))
                    ->label('Add')
                    ->icon(Icons::ADD->value),
            ])
            ->actions([
                EditAction::make()
                    ->tooltip('edit')
                    ->hiddenLabel()
                    ->icon(Icons::EDIT->value)
                    ->modalHeading('Choose Menu'),
                DeleteAction::make()
                    ->tooltip('delete')
                    ->hiddenLabel(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                DeleteBulkAction::make()
            ])
            ->striped();
    }
}

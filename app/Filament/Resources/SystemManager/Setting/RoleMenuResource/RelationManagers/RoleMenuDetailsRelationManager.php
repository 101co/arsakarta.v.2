<?php

namespace App\Filament\Resources\SystemManager\Setting\RoleMenuResource\RelationManagers;

use App\Enums\ActionType;
use App\Enums\Icons;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use App\Models\SystemManager\Master\Menu;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\IconSize;

class RoleMenuDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'roleMenuDetails';
    protected static ?string $title = 'Menu';
    protected static ?string $icon = 'heroicon-m-list-bullet';

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
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('menu_id')
            ->columns([
                TextColumn::make('menu.code')
                    ->label('Menu Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('menu.description')
                    ->label('Description')
                    ->searchable(),
                TextColumn::make('menu.application.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Choose Menu', Icons::ADD, false, false)
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Choose Menu', Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Menu', null, null, null)
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null)
            ])
            ->striped();
    }
}

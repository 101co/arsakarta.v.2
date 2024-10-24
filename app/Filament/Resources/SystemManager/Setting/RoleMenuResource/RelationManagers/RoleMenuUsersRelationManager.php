<?php

namespace App\Filament\Resources\SystemManager\Setting\RoleMenuResource\RelationManagers;

use App\Enums\Icons;
use App\Models\User;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Resources\RelationManagers\RelationManager;

class RoleMenuUsersRelationManager extends RelationManager
{
    protected static string $relationship = 'roleMenuUsers';
    protected static ?string $title = 'User';
    protected static ?string $icon = 'heroicon-o-user-group';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->searchable()
                    ->relationship('user', 'name')
                    ->getOptionLabelFromRecordUsing(fn (User $record) => "{$record->name}")
                    ->preload()
                    ->live()
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
            ->columns([
                ImageColumn::make('user.avatar')
                    ->circular()
                    ->defaultImageUrl(url('images/placeholder.png'))
                    ->label(''),
                TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Choose User', Icons::ADD, false, false, true)
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Choose User', Icons::EDIT, null, false, true),
                getCustomTableAction(ActionType::DELETE, null, 'Delete User', null, null, null, true)
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null, true)
            ])
            ->striped();
    }
}

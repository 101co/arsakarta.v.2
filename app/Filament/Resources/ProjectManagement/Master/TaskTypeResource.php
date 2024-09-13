<?php

namespace App\Filament\Resources\ProjectManagement\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Enums\ActionsPosition;
use App\Models\ProjectManagement\Master\TaskType;
use App\Filament\Clusters\ProjectManagement\Master;
use App\Filament\Resources\ProjectManagement\Master\TaskTypeResource\Pages;

class TaskTypeResource extends Resource
{
    protected static ?string $model = TaskType::class;
    
    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'task-type';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 2;
    
    public static function canViewAny(): bool
    {
        $menuCode = 'PRMGM002';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Task Type')
                    ->required()
                    ->maxLength('50')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Task Type')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', null, Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Task Type', null, null, null)
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false)
            ])
            ->heading('Project')
            ->deferLoading()
            ->defaultPaginationPageOption(10)
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTaskTypes::route('/'),
        ];
    }
}

<?php

namespace App\Filament\Resources\ProjectManagement\Master;

use App\Enums\Icons;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Enums\ActionsPosition;
use App\Models\ProjectManagement\Master\Project;
use App\Filament\Clusters\ProjectManagement\Master;
use App\Filament\Resources\ProjectManagement\Master\ProjectResource\Pages;
use App\Filament\Resources\ProjectManagement\Master\ProjectResource\RelationManagers\ProjectMembersRelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Stack;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    
    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'project';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;
    
    public static function canViewAny(): bool
    {
        $menuCode = 'PRMGM001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                            TextInput::make('name')
                                ->label('Project Name')
                                ->required()
                                ->maxLength('100'),
                            Split::make([
                                DatePicker::make('start_date')
                                    ->label('Start Date'),
                                DatePicker::make('end_date')
                                    ->label('End Date'),
                            ]),
                            TextInput::make('client_name')
                                ->label('Client Name')
                                ->required()
                                ->maxLength('100'),
                            Select::make('status')
                                ->label('Project Status')
                                ->required()
                                ->options([
                                    'open'          => 'Open',
                                    'inprogress'    => 'In Progress',
                                    'complete'      => 'Complete'
                                ])
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    TextColumn::make('name')
                        ->label('Project Name')
                        ->searchable()
                        ->weight(FontWeight::SemiBold)
                        ->sortable(),
                    TextColumn::make('client_name')
                        ->searchable()
                        ->badge()
                        ->color('info')
                        ->searchable()
                        ->sortable()
                ])
                ->space(2)
            ])
            ->filters([
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', null, Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Project', null, null, null)
            ])
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

    public static function getRelations(): array
    {
        return [
            ProjectMembersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}

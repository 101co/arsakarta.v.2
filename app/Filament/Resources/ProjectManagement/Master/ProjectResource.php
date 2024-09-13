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
use App\Models\ProjectManagement\Master\Project;
use App\Filament\Clusters\ProjectManagement\Master;
use App\Filament\Resources\ProjectManagement\Master\ProjectResource\Pages;
use App\Filament\Resources\ProjectManagement\Master\ProjectResource\RelationManagers\ProjectMembersRelationManager;

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
                TextColumn::make('name')
                    ->label('Project Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client_name')
                    ->label('Client Name'),
                TextColumn::make('status')
                    ->label('Project Status')
                    ->badge(),
                TextColumn::make('start_date')
                    ->label('Project Start'),
                TextColumn::make('end_date')
                    ->label('Project End')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Add Event Type', Icons::ADD, false, false)
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
